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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Departamentos</a></li>
                  <li class="breadcrumb-item active">Listar</li>
               </ol>
            </div>
            <h4 class="page-title">Departamentos</h4>
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
                     <a href="<?= base_url('/department/new') ?>"> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cademployee">Adicionar Departamento</button></a>
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
               <?php if (!empty($departments)) : ?>
               <table class="table table-striped table-centered mb-0">
                  <thead>
                     <tr>
                        <th>Descrição</th>
                        <th>Responsável</th>
                        <th></th>
                  </thead>
                  <tbody>


                  <?php foreach ($departments as $department) : ?>
    <tr>
        <td><p><?= esc($department['description']) ?></p></td>

        <td><?= esc($department['manager_name']) ?></td>
        <td><a href="<?= base_url('department/view/' . $department['reference']) ?>"><i class="mdi mdi-account-eye" style="font-size: 35px"></i></a></td>

    </tr>
<?php endforeach; ?>


















<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyLinkButtons = document.querySelectorAll('.copy-link');
        copyLinkButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const inputId = this.getAttribute('data-input-id');
                const input = document.getElementById(inputId);
                input.select();
                document.execCommand('copy');
                $('#copyLinkModal').modal('show'); // Exibe o modal ao copiar o link
            });
        });
    });
</script>
<!-- Success Alert Modal -->
<div id="copyLinkModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-success">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-checkmark h1"></i>
                    <h4 class="mt-2">Link Copiado!</h4>
                    <p class="mt-3">Para compartilhar a vaga, basta enviar o link que você acabou de copiar!</p>
                    <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continuar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>





                  </tbody>
               </table>
               <?php else : ?>
               <p>Nenhum resultado encontrado.</p>
               <?php endif; ?>
               <br>
               <?= $pager->links('departament', 'custom_pagination'); ?>
               <br>
               <br>
               <small>Exibindo <?= esc($perpage) ?> Resultados, de <?= esc($totalRows) ?> Encontrados</small>
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