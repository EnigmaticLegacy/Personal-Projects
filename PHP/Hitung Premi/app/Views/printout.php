<?=$this->extend("template")?>
  
<?=$this->section("content")?>

<img src="assets/logo.jpeg" style="width:20%">
<table>
    <tbody>
        <tr>
            <td><strong>General Information</strong></td>
        </tr>
        <tr>
            <td>Nama Tertanggung</td>
            <td>: <?=$nasabah['nama_nasabah'] ?></td>
        </tr>
        <tr>
            <td>Periode Pertanggungan</td>
            <td>: <?=$nasabah['periode_dari'] ?> - <?=$nasabah['periode_sampai'] ?></td>
        </tr>
        <tr>
            <td>Pertanggungan / Kendaraan</td>
            <td>: <?=$nasabah['pertanggungan'] ?></td>
        </tr>
        <tr>
            <td>Harga Pertanggungan</td>
            <td>: <?=number_format($nasabah['harga_pertanggungan'],2,".",",") ?></td>
        </tr>
        <tr>
            <td><strong>Coverage Information</strong></td>
        </tr>
        <tr>
            <td>Jenis Pertanggungan</td>
            <td>: <?php echo (($nasabah['jenis_pertanggungan'] == 1)? "Comprehensive":"Total Loss Only")  ?></td>
        </tr>
        <tr>
            <td>Risiko Pertanggungan</td>
            <td>: <?php echo (($nasabah['risiko_pertanggungan_banjir'])? "Banjir" : "") ?>;<?php echo(($nasabah['risiko_pertanggungan_gempa'])? "Gempa" : "") ?></td>
        </tr>
        <tr>
            <td><strong>Premium Calculation</strong></td>
        </tr>
        <tr>
            <td>Periode Pertanggungan</td>
            <td>: <?=$nasabah['periode_dari'] ?> - <?=$nasabah['periode_sampai'] ?></td>
        </tr>
        <tr>
            <td>Premi Kendaraan</td>
            <td>: <?=number_format($nasabah['premi_kendaraan'],2,".",",") ?></td>
            <td><?=number_format($nasabah['harga_pertanggungan'],2,".",",") ?> x <?php echo (($nasabah['jenis_pertanggungan']==1)? "0,0015" : "0,005")?> x <?=$nasabah['periode_tanggungan']?> </td>
        </tr>
        <tr>
            <td>Banjir</td>
            <td>: <?=number_format($nasabah['premi_banjir'],2,".",",") ?></td>
            <td><?=number_format($nasabah['harga_pertanggungan'],2,".",",") ?> x <?php echo (($nasabah['jenis_pertanggungan']==1)? (($nasabah["risiko_pertanggungan_banjir"])? "0,0005" : "0") : "0")?> x <?=$nasabah['periode_tanggungan'] ?></td>
        </tr>
        <tr>
            <td>Gempa</td>
            <td>: <?=number_format($nasabah['premi_gempa'],2,".",",") ?></td>
            <td><?=number_format($nasabah['harga_pertanggungan'],2,".",",") ?> x <?php echo (($nasabah['jenis_pertanggungan']==1)? (($nasabah["risiko_pertanggungan_gempa"])? "0,0002" : "0") : "0")?> x <?=$nasabah['periode_tanggungan'] ?></td>
        </tr>
        <tr>
            <td><strong>Total Premi</strong></td>
            <td>: <?=number_format($nasabah['total_premi'],2,".",",") ?></td>
        </tr>
    </tbody>
</table>
<?=$this->endSection()?>