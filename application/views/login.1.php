<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Sistem Pakar Diagnosa Penyakit Leukemia</title>

        <meta name="description" content="Sistem pakar Diagnosa Penyakit Leukemia">
        <meta name="author" content="Kodeva Media">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo base_url();?>template/img/favicon.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?php echo base_url();?>template/css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?php echo base_url();?>template/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?php echo base_url();?>template/css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="<?php echo base_url();?>template/css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="<?php echo base_url();?>template/js/vendor/modernizr-3.3.1.min.js"></script>
    </head>
    <body>
        <!-- Login Container -->
        <div id="login-container">
            <!-- Login Header -->
            <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
               <strong>Sistem pakar Diagnosa Penyakit Leukemia</strong>
            </h1>
            <!-- END Login Header -->

            <!-- Login Block -->
            <div class="block animation-fadeInQuickInv">

                <!-- Login Title -->
                <div class="block-title">
                    <h2>Silahkan Login</h2>
                    <div class="block-options pull-right">
                        <a href="<?php echo site_url('register') ?>" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Buat Akun Baru"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <!-- END Login Title -->
                <div  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
                <!-- Login Form  -->
                <form id="form-login" action="<?php echo site_url('login/aksi_login') ?>" method="post" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" id="login-username" name="login-username" class="form-control" placeholder="Username anda..">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="password" id="login-password" name="login-password" class="form-control" placeholder="Password anda..">
                        </div>
                    </div>
                    <div class="form-group form-actions">

                        <div class="col-xs-12 text-right">
                            <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Login</button>
                        </div>
                    </div>
                </form>
                <!-- END Login Form -->
            </div>
            <!-- END Login Block -->

            <!-- Footer -->
            <footer class="text-muted text-center animation-pullUp">
                <small><span id="year-copy"></span> &copy; <a href="www.kodevamedia.com" target="_blank">Kodeva Media</a></small>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Login Container -->

        <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
        <script src="<?php echo base_url();?>template/js/vendor/jquery-2.2.4.min.js"></script>
        <script src="<?php echo base_url();?>template/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>template/js/plugins.js"></script>
        <script src="<?php echo base_url();?>template/js/app.js"></script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="<?php echo base_url();?>template/js/pages/readyLogin.js"></script>
        <script>$(function(){ ReadyLogin.init(); });</script>
        <script type="text/javascript">
        $(".alert-dismissable").fadeTo(3000, 500).slideUp(500, function() {
            $(this).alert('close');
        });
        </script>
    </body>
</html>
