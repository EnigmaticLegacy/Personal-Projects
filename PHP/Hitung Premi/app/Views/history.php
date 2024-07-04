<?=$this->extend("template")?>
  
<?=$this->section("content")?>
<?=$this->include("header")?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="<?php echo (!is_null($nasabahs))?"dataTable" : "" ?>" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Nasabah</th>
                        <th>Periode</th>
                        <th>Pertanggungan</th>
                        <th>Harga Pertanggungan</th>
                        <th>Jenis Pertanggungan</th>
                        <th>Risiko Pertanggungan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama Nasabah</th>
                        <th>Periode</th>
                        <th>Pertanggungan</th>
                        <th>Harga Pertanggungan</th>
                        <th>Jenis Pertanggungan</th>
                        <th>Risiko Pertanggungan</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if(!is_null($nasabahs)){ 
                    foreach($nasabahs as $nasabah){?>
                    <tr>
                        <td><?= $nasabah['nama_nasabah'] ?></td>
                        <td><?= $nasabah['periode_dari'] ?> s/d <?= $nasabah['periode_sampai'] ?></td>
                        <td><?= $nasabah['pertanggungan'] ?></td>
                        <td><?= $nasabah['harga_pertanggungan'] ?></td>
                        <td><?php echo (($nasabah['jenis_pertanggungan'] == 1)? "Comprehensive":"Total Loss Only")  ?></td>
                        <td><?php echo (($nasabah['risiko_pertanggungan_banjir'])? "Banjir" : "") ?>;<?php echo(($nasabah['risiko_pertanggungan_gempa'])? "Gempa" : "") ?></td>
                        <td><form action="<?= base_url('printout');?>" method="POST">
                            <input type="text" id="id_nasabah" name="id_nasabah" class="form-control" value="<?= $nasabah['id'] ?>" hidden>
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-circle btn-sm">
                            <i class="fas fa-info-circle"></i>
                            </button>
                        </form>
                            </td>
                    </tr>
                    <?php }}?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?=$this->include("footer")?>
<?=$this->endSection()?>