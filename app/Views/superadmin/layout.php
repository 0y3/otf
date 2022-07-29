<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="OTF food delivery near me App ">
      <meta name="author" content="TrovoLink Solutions">
      <meta name="keywords" content="TrovoLink, Solutions,OTF,Food,Delivery" />

      <meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?= $title ? esc($title) : "OTF | Food Delivery" ?>" />
		<meta property="og:url" content="<?=current_url()?>" />
		<meta property="og:site_name" content="OTF | Food Vendors" />
		<link rel="shortcut icon" href="/favicon/favicon.ico" />

      <title><?= $title ? esc($title) : "OTF | Food Delivery" ?></title>

      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="<?=base_url('')?>/favicon/favicon.ico">
      <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('')?>/favicon/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('')?>/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('')?>/favicon/favicon-16x16.png">
      <link rel="manifest" href="<?=base_url('')?>/favicon/site.webmanifest">
      <link rel="mask-icon" href="<?=base_url('')?>/favicon/safari-pinned-tab.svg" color="#ae0bce">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="theme-color" content="#ffffff">
      <!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="<?=base_url('')?>/admin/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?=base_url('')?>/admin/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('')?>/admin/css/style.bundle.css" rel="stylesheet" type="text/css" />
      <?= $this->renderSection("styles"); ?>
      
      <script>var base_url = '<?=base_url()?>';</script>
      <script>var current_url = '<?=current_url()?>';</script>
      <script>var previous_url = '<?=previous_url()?>';</script>
      <script>var main_url = '<?=site_url(uri_string())?>';</script>
   </head>
   <body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">

   <!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
            
				<!--begin::Aside-->
				<?= $this->include('superadmin/sidebar') ?>
				<!--end::Aside-->

            <!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

					<!--begin::Header-->
					<?= $this->include('superadmin/header') ?>
					<!--end::Header-->

               <!--begin::Content-->
               
               <!--end::Content-->
               <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<?= $this->renderSection('content') ?>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
               <!--end::Content-->

					<!--begin::Footer-->
               <?= $this->include('superadmin/footer') ?>
               <!--end::Footer-->

            </div>
            <!--end::Wrapper-->

         </div>
         <!--end::Page-->
      </div>
      <!--end::Root-->



      <!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?=base_url('')?>/admin/plugins/global/plugins.bundle.js"></script>
		<script src="<?=base_url('')?>/admin/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="<?=base_url('')?>/admin/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
		<script src="<?=base_url('')?>/admin/plugins/custom/typedjs/typedjs.bundle.js"></script>
		<!-- <script src="../../../../cdn.amcharts.com/lib/5/index.js"></script>
		<script src="../../../../cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="../../../../cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="../../../../cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="../../../../cdn.amcharts.com/lib/5/themes/Animated.js"></script> -->
		<script src="<?=base_url('')?>/admin/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Page Vendors Javascript-->

      
      <!-- axios -->
      <script src="<?=base_url('')?>/vendor/axios/axios.min.js"></script>
      <!-- lodash -->
      <script src="<?=base_url('')?>/vendor/lodash/lodash.js"></script>
	  
	  <!-- Encrypt and Decrypt -->
	  <script src="<?=base_url('vendor/crypto/crypto-js.min.js')?>"></script>
      
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?=base_url('')?>/admin/js/widgets.bundle.js"></script>
		<script src="<?=base_url('')?>/admin/js/custom/widgets.js"></script>
		<script src="<?=base_url('')?>/admin/js/custom/apps/chat/chat.js"></script>
		<script src="<?=base_url('')?>/admin/js/custom/intro.js"></script>
		<!--end::Page Custom Javascript-->
      <!-- <script src="/admin/js/custom/datatable/vendor.js"></script> -->
		<!--end::Javascript-->

      <?= $this->renderSection("scripts"); ?>
   </body>
</html>