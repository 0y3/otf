<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="OTF food delivery near me App ">
      <meta name="author" content="TrovoLink Solutions">
      <title><?= esc($title) ?></title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="/favicon.png">
      <!-- Bootstrap core CSS-->
      <link href="/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="/vendor/icofont/icofont.min.css" rel="stylesheet">
      <!-- Select2 CSS-->
      <link href="/vendor/select2/css/select2.min.css" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="/css/style.css" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="/vendor/owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="/vendor/owl-carousel/owl.theme.css">
      <script>var base_url = '<?=base_url()?>';</script>
      <script>var current_url = '<?=current_url()?>';</script>
      <script>var previous_url = '<?=previous_url()?>';</script>
      <script>var main_url = '<?=site_url(uri_string())?>';</script>
   </head>
   <body>
       <!-- Header with logos -->
      <?= $this->include('main/header') ?>
       <!-- /header with logos -->

        <!-- ============================================================== -->
        <!-- content - style you can find in   -->
        <!-- ============================================================== -->
        <?= $this->renderSection('content') ?>
        <!-- ============================================================== -->
        <!-- End content - style you can find in  -->
        <!-- == -->

      <!-- Footer -->
      <?= $this->include('main/footer') ?>
      <!-- /footer -->

      <!-- jQuery -->
      <script src="/vendor/jquery/jquery-3.3.1.slim.min.js"></script>
      <!-- Bootstrap core JavaScript-->
      <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>
      <!-- Select2 JavaScript-->
      <script src="/vendor/select2/js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="/vendor/owl-carousel/owl.carousel.js"></script>
      <!-- axios -->
      <script src="/vendor/axios/axios.min.js"></script>
      <!-- lodash -->
      <script src="/vendor/lodash/lodash.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="/js/custom.js"></script>
   </body>
</html>