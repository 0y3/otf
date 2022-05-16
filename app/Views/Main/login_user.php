<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="OTF food delivery near me App ">
    <meta name="author" content="TrovoLink Solutions">
    <title><?= esc($title) ?></title>
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
                                        <input type="email" name="email" id="Email" class="form-control" placeholder="Email address" required value="<?= set_value("email")?>">
                                        <label for="Email">Email address</label>
                                        <?php if(isset($validation)): ?><small class="help-block text-danger"><?=display_error($validation,'email');?></small><?php endif ?>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" name="password" id="Password" class="form-control" placeholder="Password" required value="<?= set_value("password")?>">
                                        <label for="Password">Password</label>
                                        <?php if(isset($validation)): ?><small class="help-block text-danger"><?=display_error($validation,'password');?></small><?php endif ?>
                                    </div>
                                    <button type="submit" value="Submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign In</button>
                                    <div class="text-center pt-3">Don’t have an account? <a class="font-weight-bold" href="<?= site_url('signup') ?>">Sign Up</a></div>
                                </form>
                                <hr class="my_4">
                                <p class="text-center">LOGIN WITH</p>
                                <div class="row">
                                    <div class="col pr-2">
                                        <button class="btn pl-1 pr-1 btn-lg btn-google font-weight-normal text-white btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Google</button>
                                    </div>
                                    <div class="col pl-2">
                                        <button class="btn pl-1 pr-1 btn-lg btn-facebook font-weight-normal text-white btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Facebook</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.3.1.slim.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/select2/js/select2.min.js"></script>

    <script src="js/custom.js"></script>
</body>

</html>