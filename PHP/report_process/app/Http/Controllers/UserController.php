<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Page;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Uploads;
use Response;
use Session;
use File;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class UserController extends Controller
{
    public function upload(Request $request)
    {

        $request->validate([
            'csvitm'=> 'required',
            'csvrpt'=> 'required',
            'csvrpta'=> 'required'
        ]);

        $fileModel = new Uploads;

        // Handle file Upload
        if($request->hasFile('csvitm') and $request->hasFile('csvrpt') and $request->hasFile('csvrpta')){
            $extension = "csv";
            // Set Time
            $timezone = time() + (3600 * 7);
            // Filename to store
            $fileNameToStore = gmdate("d-m-Y_H-i-s",$timezone)."_(1)".'.'.$extension;
            $fullpath = "./".$fileNameToStore;
            // Merge Files
            $this->joinFiles($request->csvitm,$fileNameToStore);
            file_put_contents($fullpath,str_replace('="','"',file_get_contents($fullpath)));
            UserController::migrateCSVFile($fileNameToStore,"1");
            unlink($fullpath);


            // Set Time
            $timezone = time() + (3600 * 7);
            // Filename to store
            $fileNameToStore = gmdate("d-m-Y_H-i-s",$timezone)."_(2)".'.'.$extension;
            $fullpath = "./".$fileNameToStore;
            // Merge Files and Move
            $this->joinFiles($request->csvrpt,$fileNameToStore);
            file_put_contents($fullpath,str_replace('="','"',file_get_contents($fullpath)));
            UserController::migrateCSVFile($fileNameToStore,"2");
            unlink($fullpath);

            // Set Time
            $timezone = time() + (3600 * 7);
            // Filename to store
            $fileNameToStore = gmdate("d-m-Y_H-i-s",$timezone)."_(3)".'.'.$extension;
            $fullpath = "./".$fileNameToStore;
            // Merge Files and Move
            $this->joinFiles($request->csvrpta,$fileNameToStore);
            file_put_contents($fullpath,str_replace('="','"',file_get_contents($fullpath)));
            UserController::migrateCSVFile($fileNameToStore,"3");
            unlink($fullpath);

            $temp = redirect()->back()->with('success','Data Imported Successfully');
            return $temp;
        }
        else{
            return redirect()->back()->withErrors();
        }
    }


    public function migrateCSVFile($file_name,$char)
    {
        $table_name = 'temp_table'.$char;
        $array = $this -> csvToArray($file_name);
        Schema::dropIfExists($table_name);
        Schema::create($table_name, function (Blueprint $table) use($array){
            $n = 0;
            while($n < count($array[0])-1){
                if(is_numeric($array[1][$n])){
                    if(is_int($array[1][$n])){
                        $table->integer($this->slugify($array[0][$n]))->nullable();
                    }
                    elseif(is_string($array[1][$n])){
                        $table->string($this->slugify($array[0][$n]))->nullable();
                    }
                    else{
                        $table->float($this->slugify($array[0][$n]))->nullable();
                    }
                }
                else{
                    $table->string($this->slugify($array[0][$n]))->nullable();
                }
                $n++;
            }
        });
        $query ="SET GLOBAL local_infile=1;
        LOAD DATA LOCAL INFILE './".$file_name."'
        INTO TABLE `".$table_name."`
        FIELDS TERMINATED BY ','
        OPTIONALLY ENCLOSED BY '\"'
        LINES TERMINATED BY '\n'
        IGNORE 1 LINES
        ";
        DB::connection()->getpdo()->exec($query);

    }

    public function csvToArray($file_name)
    {

        if (($open = fopen("./".$file_name, "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $array[] = $data;
            }

            fclose($open);

        }
        return $array;
    }

    public function export($sqldata ,$option) {

        if($option == "download"){
            $timezone = time() + (3600 * 7);
            $hash = hash('sha256', $timezone);
            $fileName = "Output_" . gmdate("d-m-Y_H-i-s", $timezone) . "_" . $hash . '.csv';
            $file = fopen("./" . $fileName, "w");
            fputcsv($file, array_keys(get_object_vars($sqldata[0])));
            foreach ($sqldata as $line) {
                fputcsv($file, get_object_vars($line));
            }
            fclose($file);
            $file = public_path() . "/" . $fileName;
            $headers = [
                'Content-Type' => 'application/csv',
            ];
            $download = Response::download($file, $fileName, $headers);
            return $download->deleteFileAfterSend(true);
        }

        elseif($option == "array"){
            $temp = redirect()->back()->with('success','Data Array Printed')->with( 'array_export',json_encode($sqldata, JSON_PRETTY_PRINT ));
            return $temp;
        }

        // xlsx
    }

    public function downloadFiles(Request $request)
    {
        $request->validate([
            'total_harga'=> 'required|numeric',
            'total_saldo'=> 'required|numeric',
            'total_qty'=> 'required|numeric'
        ]);
        $total_harga = $request->input('total_harga');
        $total_saldo = $request->input('total_saldo');
        $total_qty = $request->input('total_qty');
        $option = $request -> input('export_option');
        Schema::dropIfExists("output");
        /*$temp_query = "CREATE TABLE output SELECT aa.user_name, aa.total_harga, aa.total_saldo, bb.total_qty, user_id
                    FROM (SELECT *
                          FROM (SELECT user_name, count(user_name) AS total_harga, sum(amount) AS total_saldo, user_id
                                FROM temp_table1 WHERE remark LIKE '%success%' AND remark LIKE '%by%'
                                GROUP BY user_name, user_id) temporary
                          WHERE total_harga >= ".$total_harga."
                            AND total_saldo >= ".$total_saldo."
                          ORDER BY user_name ASC) aa
                             JOIN (SELECT user_name, sum(buy) as total_qty FROM temp_table2 group by user_name) bb
                                  ON aa.user_name = bb.user_name
                    WHERE total_qty >= ".$total_qty."
                    order by lower(aa.user_name) ASC;";*/
        $query = "CREATE TABLE output SELECT dd.usr_name, cc.*  FROM temp_table3 dd JOIN (
                    SELECT aa.user_name, aa.total_harga, aa.total_saldo, bb.total_qty, user_id
                    FROM (SELECT *
                          FROM (SELECT user_name, count(user_name) AS total_harga, sum(amount) AS total_saldo, user_id
                                FROM temp_table1 WHERE remark LIKE '%success%' AND remark LIKE '%by%'
                                GROUP BY user_name, user_id) temporary
                          WHERE total_harga >= ".$total_harga."
                            AND total_saldo >= ".$total_saldo."
                          ORDER BY user_name ASC) aa
                             JOIN (SELECT user_name, sum(buy) as total_qty FROM temp_table2 group by user_name) bb
                                  ON aa.user_name = bb.user_name
                    WHERE total_qty >= ".$total_qty.") cc ON cc.user_id = dd.play_id
                    order by lower(cc.user_name) ASC;";

        DB::connection()->getpdo()->exec($query);
        $sqldata = DB::table('output')->get();
        if(count($sqldata) == 0){
            return redirect()->back()->with('no_download','Output is Empty, no output is printed');
        }
        else {
            return $this->export($sqldata ,$option);
        }
    }

    public function slugify($text){
        $divider = '_';
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
    function joinFiles(array $files, $result) {
        if(!is_array($files)) {
            throw new Exception('`$files` must be an array');
        }
        $fileCount = 1;
        $wH = fopen($result, "w+");

        foreach($files as $file) {
            $fh = fopen($file, "r");
            if($fileCount != 1){
                fgets($fh);
            }
            while(!feof($fh)) {
                fwrite($wH, fgets($fh));
            }
            fclose($fh);
            unset($fh);
            $fileCount += 1;
        }
        fclose($wH);
        unset($wH);
    }
}



