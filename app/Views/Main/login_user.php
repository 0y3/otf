<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="OTF food delivery near me App ">
    <meta name="author" content="TrovoLink Solutions">
    <title>
        <?= esc($title) ?>
    </title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="img/favicon.png">
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

    <script>var base_url = '<?=base_url()?>';</script>
    <script>var current_url = '<?=current_url()?>';</script>
    <script>var previous_url = '<?=previous_url()?>';</script>
    <script>var main_url = '<?=site_url(uri_string())?>';</script>

</head>

<body class="bg-white">
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                                <h3 class="login-heading mb-4">Welcome back!</h3>
                                <!-- alerts -->
                                <?= $this->include('errors/html/alerts') ?>
                                <!-- /alerts -->
                                <form method="POST" action="<?= site_url('login') ?>">
                                    <?php //csrf_field(); 
                                    ?>
                                    <div class="form-label-group">
                                        <input type="email" name="email" id="Email" class="form-control"
                                            placeholder="Email address" required value="<?= set_value("email") ?>">
                                        <label for="Email">Email address</label>
                                        <?php if (isset($validation)): ?><small class="help-block text-danger"><?= display_error($validation, 'email'); ?></small>
                                            <?php endif ?>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" name="password" id="Password" class="form-control"
                                            placeholder="Password" required value="<?= set_value("password") ?>">
                                        <label for="Password">Password</label>
                                        <?php if (isset($validation)): ?><small class="help-block text-danger"><?= display_error($validation, 'password'); ?></small>
                                            <?php endif ?>
                                    </div>
                                    <button type="submit" value="Submit"
                                        class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign
                                        In</button>
                                    <span><a class="font-weight-bold" href="#" data-toggle="modal"
                                            data-target="#forgotpasswordModal">Forgot Password?</a></span>
                                    <div class="text-center pt-3">Don’t have an account? <a class="font-weight-bold"
                                            href="<?= site_url('signup') ?>">Sign Up</a></div>
                                </form>
                                <hr class="my_4">
                                <p class="text-center">LOGIN WITH</p>
                                <div class="row">
                                    <div class="col pr-2">
                                        <button
                                            class="btn pl-1 pr-1 btn-lg btn-google font-weight-normal text-white btn-block text-uppercase"
                                            type="submit"><i class="fab fa-google mr-2"></i> Google</button>
                                    </div>
                                    <div class="col pl-2">
                                        <button
                                            class="btn pl-1 pr-1 btn-lg btn-facebook font-weight-normal text-white btn-block text-uppercase"
                                            type="submit"><i class="fab fa-facebook-f mr-2"></i> Facebook</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="forgotpasswordModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="forgotpasswordModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable dropdown-menu-right shadow-sm border-0">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Reset Your Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="homepage-search-form">
                        <form class="form-noborder">
                            <div class="form-row justify-content-center">
                                <div id="forgotpasswordalert"></div>
                                <div class="col-lg-10 col-md-10 col-sm-12 form-group">
                                    <input type="email" placeholder="Enter your Email Address" name="forgotemail" class="form-control form-control-lg" requied>
                                    <a id="resetpwd" class="locate-me font-weight-bold btn-danger" href="javascript:void('');"><i class="fas fa-paper-plane"></i> Send Reset Email</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


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

    <script src="js/custom.js"></script>
</body>

</html>