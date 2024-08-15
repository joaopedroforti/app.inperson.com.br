<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<style>
   .daterangepicker {
   z-index: 90000;
   }
   .list-user-img{
   width: 50px;
   height: 50px;
   margin-right: 10px;
   }
</style>
<div class="content">
<!-- Start Content-->
<div class="container-fluid">
   <!-- start page title -->
   <div class="row">
      <div class="col-12">
         <div class="page-title-box">
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Cargos</a></li>
                  <li class="breadcrumb-item active">Listar</li>
               </ol>
            </div>
            <h4 class="page-title">Cargos</h4>
            <!-- Start Filter -->
            <br><br>
            <div class="row">
               <div class="col-3">
                  <!-- Conteúdo da primeira coluna alinhado à esquerda -->
                  <div class="app-search dropdown d-none d-lg-block">
                     <form method="GET">
                        <div class="input-group">
                           <input type="text" class="form-control dropdown-toggle" placeholder="Procurar..." id="top-search" name="search">
                           <span class="mdi mdi-magnify search-icon"></span>
                           <button class="input-group-text btn-primary" type="submit">Procurar</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col">
                  <!-- Conteúdo da segunda coluna alinhado à direita -->
                  <div class="text-end">
                     <!--<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Status <span class="caret"></span> </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Ativos</a>
                            <a class="dropdown-item" href="#">Inativos</a>
                            <a class="dropdown-item" href="#">Todos</a>
                        </div>
                        </div>-->
                     <a href="<?= base_url('/jobroles/new') ?>"> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cademployee">Criar Cargo</button></a>
                  </div>
               </div>
               <br><br><br><br>
               <!-- End Filter -->
               <?php if(session()->has('alert')): ?>
               <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <?= session('alert') ?>
               </div>
               <?php endif; ?>
               <?php if (!empty($jobs)) : ?>
               <table class="table table-striped table-centered mb-0 ">
                  <thead>
                     <tr>
                        <th>Cargo</th>
                        <th>Departamento</th>
                        <th>Perfil Comportamental</th>
                        <th></th>
                  </thead>
                  <tbody>
                     <?php foreach ($jobs as $job) : ?>
                     <tr>
                           <td><?= esc($job['description']) ?></td>
                           <td><?= esc($job['department_description']) ?></td>
                           <td>
                              
                           <?php if (isset($job['result_name'])): ?>
    <?= esc($job['result_name']) ?>
<?php else: ?>
   <a href="<?= base_url('jobroles/questionarie/' . $job['reference']) ?>"><button type="button" class="btn btn-primary btn-sm">Preencher Teste de Perfil</button></a>
<?php endif; ?>


                        
                        </td>
                           <td><a href="<?= base_url('jobroles/view/' . $job['reference']) ?>"><i class="mdi mdi-account-eye" style="font-size: 35px"></i></a></td>
                        
                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>

               <br>
<?= $registros ?> Cargos Cadastrados
               <br>
               <?php else : ?>
               <p>Nenhum resultado encontrado.</p>
               <?php endif; ?>
               <br>
               <?= $pager->links('job', 'custom_pagination'); ?>
               <br>
               <br>
            </div>
         </div>
      </div>
      <!-- end page title --> 
   </div>
   <!-- container -->
</div>
<!-- content -->
<!-- bundle -->
<?= $this->endSection() ?>