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
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendors/font-awesome/css/font-awesome.min.css') ?>" />
    <link rel="stylesheet" href="<?=base_url('assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>">
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
      <?php /* <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-3">
              <div class="d-flex align-items-center justify-content-between">
                <!-- <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/" target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a> -->
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <!-- <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white mr-0"></i>
              </button> -->
            </div>
          </div>
        </div>
      </div> */ ?>
      <!-- partial:partials/_navbar.html -->
      <?=$this->include("admin/_layouts/navbar")?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?=$this->include("admin/_layouts/sidebar")?>
        <!-- partial -->
        <div class="main-panel">
          
        <?= $this->renderSection("content"); ?>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?=date('Y')?> <a href="https://webpanelsolutions.com/" target="_blank">WebPanelSolutions</a>. All rights reserved.</span>
              <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span> -->
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?=base_url('assets/admin/vendors/js/vendor.bundle.base.js') ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?=base_url('assets/admin/vendors/chart.js/chart.umd.js') ?>"></script>
    <script src="<?=base_url('assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?=base_url('assets/admin/js/off-canvas.js') ?>"></script>
    <script src="<?=base_url('assets/admin/js/misc.js') ?>"></script>
    <script src="<?=base_url('assets/admin/js/settings.js') ?>"></script>
    <script src="<?=base_url('assets/admin/js/todolist.js') ?>"></script>
    <script src="<?=base_url('assets/admin/js/jquery.cookie.js') ?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?=base_url('assets/admin/js/dashboard.js') ?>"></script>
    <!-- End custom js for this page -->
  </body>
</html>