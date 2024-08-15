<!-- app/Views/home.php -->



<?= $this->extend('layouts/master') ?>
<!--<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>-->
<?= $this->section('content') ?>
<style>
   .user-img{
   }
   .user-img:hover{
   opacity: 50%;
   cursor: pointer;
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
                     <li class="breadcrumb-item"><a href="<?= base_url('department')?>">Departamentos</a></li>
                     <li class="breadcrumb-item active">Ver</li>
                  </ol>
               </div>
               <h4 class="page-title">Detalhes do departamento</h4>
            </div>
         </div>
      </div>
      <?php if(session()->has('alert')): ?>
      <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         <?= session('alert') ?>
      </div>
      <?php endif; ?>
      <!-- end page title --> 
      <div class="row">
         <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
               <div class="card-body">
                  <h4 class="mb-0 mt-2"><?= esc($department['description']) ?></h4>
                  <p class="font-14">Gestor: <?= esc($department['manager_name']) ?></p>
                  <!--<button type="button" class="btn btn-success btn-sm mb-2">Follow</button>
                     <button type="button" class="btn btn-danger btn-sm mb-2">Message</button>-->
                  <div class="text-start mt-3">
                     <!--<h4 class="font-13 text-uppercase">Informações:</h4>
                     <p class="text-muted mb-2 font-13"><strong>Celular :</strong><span class="ms-2"></span></p>
                     <p class="text-muted mb-2 font-13"><strong>Email Interno :</strong> <span class="ms-2 "></span></p>
                     <p class="text-muted mb-2 font-13"><strong>Email Pessoal :</strong> <span class="ms-2 "></span></p>
                     <p class="text-muted mb-1 font-13"><strong>Admitido em :</strong> <span class="ms-2"></span></p>-->
                  </div>
                  <!--
                     <ul class="social-list list-inline mt-3 mb-0">
                         <li class="list-inline-item">
                             <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                     class="mdi mdi-facebook"></i></a>
                         </li>
                         <li class="list-inline-item">
                             <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                     class="mdi mdi-google"></i></a>
                         </li>
                         <li class="list-inline-item">
                             <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                     class="mdi mdi-twitter"></i></a>
                         </li>
                         <li class="list-inline-item">
                             <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                     class="mdi mdi-github"></i></a>
                         </li>
                     </ul>-->
               </div>
               <!-- end card-body -->
            </div>
            <!-- end card -->
         </div>
         <!-- end col-->
         <div class="col-xl-8 col-lg-7">
            <div class="card">
               <div class="card-body">
                  <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">

                     <!--<li class="nav-item">
                        <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 ">
                        Timeline
                        </a>
                        </li>-->
                     <li class="nav-item">
                        <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                        Detalhes do Departamento
                        </a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <!-- end tab-pane -->

                     <!-- end tab-pane -->
                     <!-- end about me section content -->
                    

                     <div class="tab-pane show active" id="settings">
                        <form action="" method="POST">

                           <div class="row">
                              <div class="col-md-6">
                                 <div class="mb-3">
                                 <input hidden  type="text" id="id_department" name="id_department" class="form-control" value="<?= esc($department['id_department']) ?>">
                                 <input hidden type="text" id="reference" name="reference" class="form-control" value="<?= esc($department['reference']) ?>">
                                    <label for="description" class="form-label">Nome do Departamento</label>
                                    <input required type="text" id="description" name="description" class="form-control" value="<?= esc($department['description']) ?>">
                                 </div>
                              </div>
                              
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="lastname" class="form-label">Gestor</label>


                                   <select class="form-control select2" data-toggle="select2" name="gestor">
                                    <option value="<?= $department['manager_id'] ?>"><?= $department['manager_name'] ?></option>
                                       <option></option>
                                       <?php foreach ($persons as $person): ?>
                                       <option value="<?= $person['id_person'] ?>"><?= $person['name'] ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>

                              
                           </div>
                  


                           <!-- end row -->
                           <div class="text-end">
                              <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Salvar Informações</button>
                           </div>
                        </form>
                     </div>
                     <!-- end settings content-->
                  </div>
                  <!-- end tab-content -->
               </div>
               <!-- end card body -->
            </div>
            <!-- end card -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row-->
   </div>
   <!-- container -->
</div>
<!-- content -->
<!-- Footer Start -->
<footer class="footer">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-6">
            <script>document.write(new Date().getFullYear())</script> © Hyper - Coderthemes.com
         </div>
         <div class="col-md-6">
            <div class="text-md-end footer-links d-none d-md-block">
               <a href="javascript: void(0);">About</a>
               <a href="javascript: void(0);">Support</a>
               <a href="javascript: void(0);">Contact Us</a>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- end Footer -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- Right Sidebar -->
<div class="end-bar">
   <div class="rightbar-title">
      <a href="javascript:void(0);" class="end-bar-toggle float-end">
      <i class="dripicons-cross noti-icon"></i>
      </a>
      <h5 class="m-0">Settings</h5>
   </div>
   <div class="rightbar-content h-100" data-simplebar>
      <div class="p-3">
         <div class="alert alert-warning" role="alert">
            <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
         </div>
         <!-- Settings -->
         <h5 class="mt-3">Color Scheme</h5>
         <hr class="mt-1" />
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light" id="light-mode-check" checked>
            <label class="form-check-label" for="light-mode-check">Light Mode</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check">
            <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
         </div>
         <!-- Width -->
         <h5 class="mt-4">Width</h5>
         <hr class="mt-1" />
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check" checked>
            <label class="form-check-label" for="fluid-check">Fluid</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
            <label class="form-check-label" for="boxed-check">Boxed</label>
         </div>
         <!-- Left Sidebar-->
         <h5 class="mt-4">Left Sidebar</h5>
         <hr class="mt-1" />
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
            <label class="form-check-label" for="default-check">Default</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked>
            <label class="form-check-label" for="light-check">Light</label>
         </div>
         <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
            <label class="form-check-label" for="dark-check">Dark</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check" checked>
            <label class="form-check-label" for="fixed-check">Fixed</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
            <label class="form-check-label" for="condensed-check">Condensed</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
            <label class="form-check-label" for="scrollable-check">Scrollable</label>
         </div>
         <div class="d-grid mt-4">
            <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
            <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/"
               class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
         </div>
      </div>
      <!-- end padding-->
   </div>
</div>
<div class="rightbar-overlay"></div>
<!-- Image Modal -->
<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="standard-modalLabel">Alterar Imagem de Perfil</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
         </div>
         <div class="modal-body">
            <p class="text-muted font-14">Recomendamos imagens 1:1 (quadradas)</p>
            <form action="<?= base_url('employee/imageupdt') ?>" method="post" enctype="multipart/form-data">
               <input type="file" name="userfile" size="20">
               <br><br>
               <!-- Adicione a pré-visualização da imagem aqui -->
               <img id="preview" src="#" alt="Image Preview" style="display: none; max-width: 300px; max-height: 300px;">
               <input hidden name="reference" id="reference" value="">
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
         <button type="submit" class="btn btn-primary">Salvar Alteração</button>
         </form>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /End-bar -->

<?= $this->endSection() ?>