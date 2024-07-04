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

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Sign up now</h2>
          <form action="<?= base_url('register');?>" method="POST">
            
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" id="name" name="name" class="form-control" />
              <label class="form-label" for="name">Name</label>
              <?php if(isset($validation)):?>
                <small class="text-danger"><?= $validation->getError('name') ?></small>
              <?php endif;?>
            </div>

            
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control" />
              <label class="form-label" for="email">Email address</label>
              <?php if(isset($validation)):?>
                <small class="text-danger"><?= $validation->getError('email') ?></small>
              <?php endif;?>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" id="phone" name="phone" class="form-control" />
              <label class="form-label" for="phone">Phone Number</label>
              <?php if(isset($validation)):?>
                <small class="text-danger"><?= $validation->getError('phone') ?></small>
              <?php endif;?>
            </div>

            
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="password" name="password" class="form-control" />
              <label class="form-label" for="password">Password</label>
              <?php if(isset($validation)):?>
                <small class="text-danger"><?= $validation->getError('password') ?></small>
              <?php endif;?>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="password2" name="password2" class="form-control" />
              <label class="form-label" for="password2">Confirm Password</label>
              <?php if(isset($validation)):?>
                <small class="text-danger"><?= $validation->getError('password2') ?></small>
              <?php endif;?>
            </div>

            
            <div class="form-check d-flex justify-content-center mb-4">
              <input class="form-check-input me-2" type="checkbox" value="" id="newsletter" name="newsletter" checked />
              <label class="form-check-label" for="newsletter">
                Subscribe to our newsletter
              </label>
            </div>

            
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
              Sign up
            </button>
          </form>
          <div class="text-center">
          <p>Already have an existing account? <a href="<?= base_url('login');?>">Login</a></p>
          </button>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>


  
<?=$this->endSection()?>