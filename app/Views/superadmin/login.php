<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	
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
      <!-- <link rel="icon" type="image/png" href="/favicon/favicon.ico"> -->
      <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
      <link rel="manifest" href="/favicon/site.webmanifest">
      <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#ae0bce">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="theme-color" content="#ffffff">
      <!--begin::Fonts-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
      <!--end::Fonts-->
      <!--begin::Global Stylesheets Bundle(used by all pages)-->
      <link href="/admin/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
      <link href="/admin/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="#" class="mb-12">
						<img alt="Logo" src="<?= base_url('img/logo.png')?>" class="h-40px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100" id="sign_in" action="<?= site_url('otfadmin/login') ?>" method="post">
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Sign In to Super Admin</h1>
								<!--end::Title-->
							</div>
                                <!-- alerts -->
                                <?= $this->include('errors/html/alerts') ?>
                                <!-- /alerts -->
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Email</label>
								<input class="form-control form-control-lg form-control-solid" required="required" type="text" name="email" autocomplete="off" />
                                <?php if(isset($validation)): ?><small class="help-block text-danger"><?=display_error($validation,'email');?></small><?php endif ?>
							</div>
							<div class="fv-row mb-10">
								<div class="d-flex flex-stack mb-2">
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
									<!-- <a href="password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a> -->
								</div>
								<input class="form-control form-control-lg form-control-solid" required="required" type="password" name="password" autocomplete="off" />
                                <?php if(isset($validation)): ?><small class="help-block text-danger"><?=display_error($validation,'password');?></small><?php endif ?>
							</div>
							<div class="text-center">
								<button type="submit" id="sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Continue</span>
									<span class="indicator-progress">Please wait... 
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="/admin/plugins/global/plugins.bundle.js"></script>
		<script src="/admin/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
        <script src="<?=base_url('admin/js/custom/authentication/general.js')?>"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo8/authentication/layouts/basic/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 May 2022 01:09:18 GMT -->
</html>