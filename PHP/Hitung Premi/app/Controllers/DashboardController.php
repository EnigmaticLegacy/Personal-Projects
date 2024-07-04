<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\NasabahModel;

class DashboardController extends BaseController
{

    public function index()
    {
        
        if (is_null(session()->get('isLoggedIn')))
        {
            return redirect()->to('/login')->with('error','Please Login');
        }
        $data['title'] = 'Dashboard';
        $nasabah = new NasabahModel();
        return view('dashboard',$data);
        
    }

    public function submit_nasabah()
    {
        if (is_null(session()->get('isLoggedIn')))
        {
            return redirect()->to('/login')->with('error','Please Login');
        }
        $rules = [
            'nama_nasabah' => ['rules' => 'required|max_length[255]'],
            'periode_dari' => ['rules' => 'required'],
            'periode_sampai' => ['rules' => 'required'],
            'pertanggungan' => ['rules' => 'required|max_length[255]'],
            'harga_pertanggungan'  => [ 'rules' => 'required'],
            'jenis_pertanggungan'  => [ 'rules' => 'required'],
        ];

        

        if($this->validate($rules)){
            $nasabah = new NasabahModel();
            $request = $this->request->getPost();
            $startDate = strtotime($request['periode_dari']);
            $endDate = strtotime($request['periode_sampai']);
        
            if ($endDate >= $startDate){
                $request['jenis_pertanggungan'] = (int)$request['jenis_pertanggungan'];
                $request['harga_pertanggungan'] = (float)$request['harga_pertanggungan'];
                $dateDiff = ceil(((($endDate - $startDate)/3600)/24)/365);
                if($request['jenis_pertanggungan'] == 1){
                    $request['premi_kendaraan'] = (float)$request['harga_pertanggungan']* 0.0015 * $dateDiff;
                    if(isset($request['risiko_pertanggungan_banjir'])){
                        $request['risiko_pertanggungan_banjir'] = TRUE;
                        $request['premi_banjir'] = (float)$request['harga_pertanggungan']* 0.0005 * $dateDiff;
                    }else{
                        $request['risiko_pertanggungan_banjir'] = FALSE;
                        $request['premi_banjir'] = 0;
                    }
                    if(isset($request['risiko_pertanggungan_gempa'])){
                        $request['risiko_pertanggungan_gempa'] = TRUE;
                        $request['premi_gempa'] = (float)$request['harga_pertanggungan']* 0.0002 * $dateDiff;
                    }else{
                        $request['risiko_pertanggungan_gempa'] = FALSE;
                        $request['premi_gempa'] = 0;
                    }
                }else{
                    $request['premi_kendaraan'] = (float)$request['harga_pertanggungan']* 0.005 * $dateDiff;
                    $request['premi_banjir'] = 0;
                    $request['premi_gempa'] = 0;
                }
                $request['periode_tanggungan'] = $dateDiff;
                $request['total_premi'] = $request['premi_kendaraan'] + $request['premi_banjir'] + $request['premi_gempa'];
                $request['agen'] = session()->get('email');
                $nasabah->save($request);
                return redirect()->back()->with('message','Data telah berhasil disimpan');
            }
            else {
                return redirect()->back()->withInput()->with('error', 'Periode Pertanggungan Sampai Harus lebih besar dari Periode Pertanggungan Awal.');
            }
            
        }else{
            $data['validation'] = $this->validator;
            $data['title'] = 'Dashboard';
            return view('dashboard',$data);

        }
    }

    public function history()
    {
        if (is_null(session()->get('isLoggedIn')))
        {
            return redirect()->to('/login')->with('error','Please Login');
        }
        $nasabah = new NasabahModel();
        $data['nasabahs'] = $nasabah->where('agen',session()->get('email'))->findAll();
        $data['title'] = 'History';
        
        return view('history',$data);
    }

    public function print_out(){
        
        $request = $this->request->getPost();
        $nasabah = new NasabahModel();
        $data['nasabah'] = $nasabah->where('id',$request['id_nasabah'])->first();
        if (session()->get('email') != $data['nasabah']['agen'])
        {
            return redirect()->back('')->with('error',"You don't have authority to access this page");
        }
        $data['title'] = "Printout Nasabah " . $data['nasabah']['nama_nasabah']; 
        return view('printout',$data);
    }
}
