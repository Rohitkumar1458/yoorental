<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendors/ti-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendors/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendors/font-awesome/css/font-awesome.min.css') ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?=base_url('assets/admin/css/style.css') ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?=base_url('assets/admin/images/favicon.png') ?>" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="<?=base_url('assets/admin/images/logo.svg') ?>">
                </div>
                <?php echo session()->getFlashdata('message'); ?>
                <!-- <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6> -->
                <form class="pt-3" action="<?=base_url('/admin')?>" method="post">
                  <?=csrf_field() ;?>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" name="email" value="<?=set_value('email')?>" id="email" placeholder="Username">
                    <span class="text-danger"><?=(isset($validation))?$validation->showError('email'):''?></span>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" value="<?=set_value('password')?>" id="password" placeholder="Password">
                    <span class="text-danger"><?=(isset($validation))?$validation->showError('password'):''?></span>
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?=base_url('assets/admin/vendors/js/vendor.bundle.base.js') ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?=base_url('assets/admin/js/off-canvas.js') ?>"></script>
    <script src="<?=base_url('assets/admin/js/misc.js') ?>"></script>
    <script src="<?=base_url('assets/admin/js/settings.js') ?>"></script>
    <script src="<?=base_url('assets/admin/js/todolist.js') ?>"></script>
    <script src="<?=base_url('assets/admin/js/jquery.cookie.js') ?>"></script>
    <!-- endinject -->
  </body>
</html>