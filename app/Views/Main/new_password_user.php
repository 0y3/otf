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
                                <h3 class="login-heading mb-4">Reset Password</h3>
                                <!-- alerts -->
                                <?= $this->include('errors/html/alerts') ?>
                                <!-- /alerts -->
                                <form method="POST" action="<?= site_url('newpassword') ?>">
                                    <?php //csrf_field(); 
                                    ?>
                                    <div class="form-label-group">
                                        <input type="email" id="Email" class="form-control-plaintext" placeholder="Email address" readonly disabled value="<?= $email?>">
                                        <label for="Email">Email address</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" name="password" id="Password" class="form-control" placeholder="Password" required value="<?= set_value("password")?>">
                                        <label for="Password">Password</label>
                                        <?php if(isset($validation)): ?><small class="help-block text-danger"><?=display_error($validation,'password');?></small><?php endif ?>
                                    </div>
                                    <input type="hidden" name="id" class="form-control" disable required value="<?= $activation_code ?>">
                                    <input type="hidden" name="email" class="form-control" disable required value="<?= $email ?>">
                                    <div class="form-label-group">
                                        <input type="password" name="passconf" id="ConfirmPassword" class="form-control" placeholder="Password" required value="<?= set_value("passconf")?>">
                                        <label for="ConfirmPassword">Confirm Password</label>
                                        <?php if(isset($validation)): ?><small class="help-block text-danger"><?=display_error($validation,'passconf');?></small><?php endif ?>
                                    </div>
                                    <button type="submit" value="Submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Reset Password</button>
                                    <!-- <div class="text-center pt-3"> Already have an Account? <a class="font-weight-bold" href="<?= site_url('login') ?>">Sign In</a></div> -->
                                </form>
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