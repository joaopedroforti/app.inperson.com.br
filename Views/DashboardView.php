<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                            <li class="breadcrumb-item active">Starter</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Starter</h4>

                                    <h2>Home</h2>
<?php if(session()->has('user')): ?>
    <p>Olá, <?=session()->get('user')->name?></p>
    <a href="<?php echo url_to('login.destroy')?>">logout</a>

    <pre><?php //var_dump(session()->get('user'))?></pre>
<?php endif ?>

                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 
                        
                    </div> <!-- container -->

                </div> <!-- content -->

<?= $this->endSection() ?>
