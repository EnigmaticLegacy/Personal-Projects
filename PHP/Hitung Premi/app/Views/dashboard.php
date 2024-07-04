<?=$this->extend("template")?>
  
<?=$this->section("content")?>
<?=$this->include("header")?>


    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            
        </div>
        <?php if(session()->getFlashdata('error')):?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif;?>
        <?php if(session()->getFlashdata('message')):?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif;?>
        <div class="row">

            <div class="col-xl-12 col-md-6 mb-4">
            <form action="<?= base_url('submit_nasabah');?>" method="POST">

                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="nama_nasabah">Nama Nasabah </label><span style="color:red;">*</span>
                    <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" required>
                    <?php if(isset($validation)):?>
                        <small class="text-danger"><?= $validation->getError('nama_nasabah') ?></small>
                    <?php endif;?>
                </div>

                
                <div data-mdb-input-init class="form-outline mb-4 row">
                    <div class="col-md-6">
                        <label class="form-label" for="periode_dari">Periode Pertanggungan</label><span style="color:red;">*</span>
                        <input type="date" id="periode_dari" name="periode_dari" class="form-control" required/>
                        <?php if(isset($validation)):?>
                            <small class="text-danger"><?= $validation->getError('periode_dari') ?></small>
                        <?php endif;?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="periode_sampai">Sampai</label>
                        <input type="date" id="periode_sampai" name="periode_sampai" class="form-control" required/>
                        <?php if(isset($validation)):?>
                            <small class="text-danger"><?= $validation->getError('periode_sampai') ?></small>
                        <?php endif;?>
                    </div>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="pertanggungan">Pertanggungan / Kendaraan</label><span style="color:red;">*</span>
                    <input type="text" id="pertanggungan" name="pertanggungan" class="form-control" required/>
                    <?php if(isset($validation)):?>
                        <small class="text-danger"><?= $validation->getError('pertanggungan') ?></small>
                    <?php endif;?>
                </div>

                
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="harga_pertanggungan">Harga Pertanggungan</label><span style="color:red;">*</span>
                    <input type="number" id="harga_pertanggungan" name="harga_pertanggungan" class="form-control" required/>
                    <?php if(isset($validation)):?>
                        <small class="text-danger"><?= $validation->getError('harga_pertanggungan') ?></small>
                    <?php endif;?>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="jenis_pertanggungan">Jenis Pertanggungan</label><span style="color:red;">*</span>
                    <select class="form-control" id="jenis_pertanggungan" name ="jenis_pertanggungan">
                        <option value='1'>1 Comprehensive</option>
                        <option value='2'>2 Total Loss Only</option>
                    </select>
                    <?php if(isset($validation)):?>
                        <small class="text-danger"><?= $validation->getError('jenis_pertanggungan') ?></small>
                    <?php endif;?>
                </div>

                
                <div class="form-group row">
                    <div class="col-sm-2">Risiko Pertanggungan</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="risiko_pertanggungan_banjir" name="risiko_pertanggungan_banjir">
                                <label class="form-check-label" for="risiko_pertanggungan_banjir">
                                Banjir
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="risiko_pertanggungan_gempa" name="risiko_pertanggungan_gempa">
                                <label class="form-check-label" for="risiko_pertanggungan_gempa">
                                Gempa
                                </label>
                            </div>
                    </div>
                </div>

                
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Submit
                </button>
            </form>
            </div>

        </div>

    </div>

</div>
            
<?=$this->include("footer")?>
<?=$this->endSection()?>