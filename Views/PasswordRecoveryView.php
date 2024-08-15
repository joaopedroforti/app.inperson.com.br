<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>InPerson Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico')?>">
        <link href="<?= base_url('assets/css/icons.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/app.min.css')?>" rel="stylesheet" type="text/css" id="app-style" />
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
                                    <span><img src="<?= base_url('assets/images/logo.png')?>" alt="" height="18"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-3 fw-bold">Recuperação de Senha</h4>
                                </div>
                                <?php if ($step == 1) : ?>
                                    <form method="post" action="<?= url_to('password.store'); ?>">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Email</label>
                                            <input class="form-control" type="text" required="" id="email" placeholder="Digite seu Email" name="email">
                                            <span class="text text-danger"><?= session()->getFlashdata('errors')['email'] ?? ''; ?></span>
                                        </div>
                                        <div class="mb-0 text-center"><br>
                                            <button class="btn btn-primary" type="submit">Prosseguir</button>
                                        </div>
                                    </form>
                                <?php endif; ?>

                                <?php if ($step == 'check-email') : ?>
                                    <div class="col-12 text-center">
                                        <p class="text-muted mb-4">Cheque seu e-mail, te encaminhamos um link para redefinir sua senha.</p>
                                        <a href="<?php echo url_to('login') ?>"><button class="btn btn-primary" type="submit">Retornar ao Login</button></a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($step == 'new') : ?>
                                    <form method="post" action="<?= url_to('newpassword.store'); ?>">
                                        <div class="mb-3">
                                            <br>
                                            <label for="password" class="form-label">Escolha uma Nova senha</label>
                                            <input class="form-control" type="password" required="" id="new_password" placeholder="senha" name="new_password">
                                            <input hidden class="form-control" type="text" required="" id="reference" placeholder="" name="reference" value="<?php echo $reference ?>">
                                            <span class="text text-danger"><?= session()->getFlashdata('errors')['email'] ?? ''; ?></span>
                                        </div>
                                        <div class="mb-0 text-center"><br>
                                            <button class="btn btn-primary" type="submit">Prosseguir</button>
                                        </div>
                                    </form>
                                <?php endif; ?>

                                <?php if ($step === 'error') : ?>
                                    <div class="col-12 text-center">
                                        <span>Esse email não possui cadastro em nosso sitema.<span><br><br>
                                                <a href="<?php echo url_to('login') ?>"><button class="btn btn-primary" type="submit">Retornar</button></a>
                                    </div>
                                <?php endif; ?>
                            </div> 
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">

                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer footer-alt">
            2018 - <script>
                document.write(new Date().getFullYear())
            </script> © Hyper - Coderthemes.com
        </footer>

        <script src="<?= base_url('assets/js/vendor.min.js')?>"></script>
        <script src="<?= base_url('assets/js/app.min.js')?>"></script>
    </body>
</html>