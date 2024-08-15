
<html lang="en">
    
<!-- Mirrored from coderthemes.com/hyper/saas/pages-lock-screen.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:21:16 GMT -->
<head>
        <meta charset="utf-8" />
        <title>InPerson Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>

    </head>

    <body class="loading authentication-bg" data-layout-config='{"darkMode":false}'>

        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">
                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <a href="index.html">
                                    <span><img src="assets/images/logo.png" alt="" height="18"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                
                                <div class="m-auto mb-3">
                                    <h2 class="text-dark-50 text-start mt-3 fw-bold">olá,</h2>
                                </div>

                                <form method="post" action="<?=url_to('login.store');?>">
                                <div class="mb-3">
                                        <label for="password" class="form-label">Email</label>
                                        <input class="form-control" type="text" required="" id="email" placeholder="Digite seu Email" name="email">
                                        <span class="text text-danger"><?=session()->getFlashdata('errors')['email'] ?? '';?></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Senha</label>
                                        <input class="form-control" type="password" required="" id="password" placeholder="Digite sua Senha" name="password">
                                        <span class="text text-danger"><?=session()->getFlashdata('errors')['password'] ?? '';?></span>
                                    </div>

                                    <div class="mb-0 text-center">
                                    <?php if(session()->has("error")): ?>
                            <p class="text text-danger mb-5"><?=session()->getFlashdata('error')?? '';?></p>
                        <?php endif?>
                        <br>
                                        <button class="btn btn-primary" type="submit">Log In</button>
                                    </div>
                                </form>
                                
                            </div> <!-- end card-body-->
                        </div>
                        <!-- end card-->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p><a href="<?php echo url_to('password.recovery')?>" class="text-muted ms-1"><b>Esqueci Minha senha</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->



        <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>

<!-- Mirrored from coderthemes.com/hyper/saas/pages-lock-screen.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:21:16 GMT -->
</html>
