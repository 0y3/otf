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
      <link rel="icon" type="image/png" href="<?=base_url('')?>/favicon/favicon.ico">
      <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('')?>/favicon/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('')?>/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('')?>/favicon/favicon-16x16.png">
      <link rel="manifest" href="<?=base_url('')?>/favicon/site.webmanifest">
      <link rel="mask-icon" href="<?=base_url('')?>/favicon/safari-pinned-tab.svg" color="#ae0bce">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="theme-color" content="#ffffff">
      
      <?= $this->renderSection("styles"); ?>
      <!-- Bootstrap core CSS-->
      <link href="<?=base_url('')?>/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="<?=base_url('')?>/vendor/fontawesome/css/all.min.css" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="<?=base_url('')?>/vendor/icofont/icofont.min.css" rel="stylesheet">
      <!-- Select2 CSS-->
      <link href="<?=base_url('')?>/vendor/select2/css/css/select2.min.css" rel="stylesheet">
      
      <!-- Custom styles for this template-->
      <link href="<?=base_url('')?>/css/style.css" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="<?=base_url('')?>/vendor/owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="<?=base_url('')?>/vendor/owl-carousel/owl.theme.css">

      <script>var base_url = '<?=base_url()?>';</script>
      <script>var current_url = '<?=current_url()?>';</script>
      <script>var previous_url = '<?=previous_url()?>';</script>
      <script>var main_url = '<?=site_url(uri_string())?>';</script>
      <style>
         .img-fluid-img {
            max-width: 100%;
            width: 350px;
            height: 120px;

         }
      </style>
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
      <script src="<?=base_url('')?>/vendor/jquery/jquery-3.3.1.slim.min.js"></script>
      <!-- Bootstrap core JavaScript-->
      <script src="<?=base_url('')?>/vendor/bootstrap/js/bootstrap.bundle.js"></script>
      <!-- Select2 JavaScript-->
      <script src="<?=base_url('')?>/vendor/select2/js/js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="<?=base_url('')?>/vendor/owl-carousel/owl.carousel.js"></script>
      <!-- axios -->
      <script src="<?=base_url('')?>/vendor/axios/axios.min.js"></script>
      <!-- lodash -->
      <script src="<?=base_url('')?>/vendor/lodash/lodash.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="<?=base_url('')?>/js/custom.js"></script>
      

      <?= $this->renderSection("scripts"); ?>
   </body>
</html>