<?=$this->extend("template")?>
  
<?=$this->section("content")?>
<div class="container">
<section class="text-center">
  
  <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
  

  <div class="card mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="
        margin-top: -100px;
        backdrop-filter: blur(30px);
        ">
    
    <div class="card-body py-5 px-md-5">
    <?php if(session()->getFlashdata('error')):?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif;?>
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Login</h2>
          <form action="<?= base_url('login');?>" method="POST">
            
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control" />
              <label class="form-label" for="email">Email address</label>
            </div>

            
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="password" name="password" class="form-control" />
              <label class="form-label" for="password">Password</label>
            </div>

            
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
              Login
            </button>
          </form>
          <div class="text-center">
    <p>Not a member? <a href="<?= base_url('register');?>">Register</a></p>
    </button>
  </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>


  
<?=$this->endSection()?>