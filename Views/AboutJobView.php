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
                     <li class="breadcrumb-item"><a href="<?= base_url('jobroles')?>">Cargos</a></li>
                     <li class="breadcrumb-item active">Ver</li>
                  </ol>
               </div>
               <h4 class="page-title">Detalhes do Cargo</h4>
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
                  <h4 class="mb-0 mt-2"><?= esc($job['description']) ?></h4>
                  <p class="text-muted font-14"><?= esc($job['department_description']) ?></p>
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
                     <li class="nav-item">
                        <a href="#profile" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                        Perfil Comportamental
                        </a>
                     </li>
                     
                     <!--<li class="nav-item">
                        <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 ">
                        Timeline
                        </a>
                        </li>-->
                     <li class="nav-item">
                        <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                        Editar Cargo
                        </a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <!-- end tab-pane -->
                     <div class="tab-pane show active" id="profile">
                        <h5 class="text-uppercase">Perfil Comportamental</h5>
                        <div class="row">
                        <a href="<?= base_url('jobroles/questionarie/' . $job['reference']) ?>"><button type="button" class="btn btn-primary btn-sm">Refazer Teste</button></a>
                           <div id="atributes" class="apex-charts"></div>
                        </div>
                        <div class="row">
                           <div id="skills" class="apex-charts"></div>
                        </div>
                        <div class="card">
                        </div>
                     </div>
                     <!-- end tab-pane -->
                     <!-- end about me section content -->
                    

                     <div class="tab-pane" id="settings">
                        <form action="" method="POST">

                           <div class="row">
                              <div class="col-md-4">
                                 <div class="mb-3">
                                 <input hidden type="text" id="id_job" name="id_job" class="form-control" value="<?= esc($job['id_job']) ?>">
                                 <input hidden type="text" id="reference" name="reference" class="form-control" value="<?= esc($job['reference']) ?>">
                                    <label for="firstname" class="form-label">Nome do Cargo</label>
                                    <input required type="text" id="description" name="description" class="form-control" value="<?= esc($job['description']) ?>">
                                 </div>
                              </div>
                              
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="lastname" class="form-label">Departamento</label>
                                    <select required class="form-select" id="department" name="department">
                                    <option value="<?= $job['id_department'] ?>"><?= $job['department_description'] ?></option>
                                       <option></option>
                                       <?php foreach ($departments as $department): ?>
                                       <option value="<?= $department['id_department'] ?>"><?= $department['description'] ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>

                              <div class="col-md-4">
                              <label for="seniority" class="form-label">Senioridade</label>
                              <select required class="form-select" id="senioridade" name="senioridade">
    <option value="<?= $job['seniority']; ?>"><?= $job['seniority']; ?></option>
    <?php
    $seniority_options = ['Trainee', 'Estagiário', 'Júnior', 'Pleno', 'Sênior', 'Especialista'];
    foreach ($seniority_options as $option) {
        if ($option !== $job['seniority']) {
            echo "<option value=\"$option\">$option</option>";
        }
    }
    ?>
</select>

                           </div>
                  
<div class="row">

<div class="col-md-12">
                                 <div class="mb-3">
                                    <label for="lastname" class="form-label">Descrição</label>
                                    <textarea required type="text" id="long_description" name="long_description" class="form-control"value="<?= esc($job['long_description']) ?>"> <?= esc($job['long_description']) ?></textarea>
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

<script src="<?= base_url('assets/js/vendor/apexcharts.min.js') ?>"></script>
<!-- third party end -->
<!--  chart skills-->
<script>
   var options = {
           series: [{
           name: '',
           data: <?= $skillsvalue ?>,
         }],
           chart: {
           height: 500,
           type: 'radar',
         },
         yaxis: {
            max: 100 // Define o valor máximo do eixo y como 100
        },
         xaxis: {
             "categories": [
         "Foco em resultado",
         "Estrategista",
         "Automotivação",
         "Intraempreendedorismo",
         "Proatividade",
         "Otimismo",
         "Influência",
         "Criatividade",
         "Adaptabilidade",
         "Sociabilidade",
         "Diplomacia",
         "Empatia",
         "Harmonia",
         "Colaboração",
         "Autocontrole",
         "Disciplina",
         "Concentração",
         "Organização e planejamento",
         "Precisão",
         "Análise"
     ]
         }
         };
   
         var chart = new ApexCharts(document.querySelector("#skills"), options);
         chart.render();
    
         
</script>
<script>
   var dados_absolutos = [
       <?= esc($attributes['decision']) ?>,
       <?= esc($attributes['detail']) ?>,
       <?= esc($attributes['enthusiasm']) ?>,
       <?= esc($attributes['relational']) ?>
   ];
   
   
   
   var options = {
   series: [{
     data: dados_absolutos // Usando os dados em porcentagem
   }],
   chart: {
     type: 'bar',
     height: 200
   },
   plotOptions: {
     bar: {
       borderRadius: 4,
       horizontal: true,
     },
     legend: {
     show: false // Remover a legenda
   }
   },
   dataLabels: {
     enabled: true,
     formatter: function(val) {
       return val + '%'; // Adicionar '%' aos rótulos
     }
   },
   grid: {
   },
   
   xaxis: {
       min: 0,
     max: 100, // Definir o intervalo do eixo Y de 0 a 100
     categories: ['Decisão', 'Detalhismo', 'Entusiasmo', 'Relacional'],
     labels: {
       formatter: function(val) {
         return ''; // Adicionar '%' aos rótulos do eixo X
       }
     }
   }
   
   };
   
   var chart = new ApexCharts(document.querySelector("#atributes"), options);
   chart.render();
</script>

</script>
<!-- demo end -->
<script>
   document.addEventListener('DOMContentLoaded', function() {
       const inputImage = document.getElementById('userfile');
       const preview = document.getElementById('preview');
   
       inputImage.addEventListener('change', function() {
           const file = this.files[0];
   
           if (file) {
               const reader = new FileReader();
   
               reader.onload = function(e) {
                   preview.src = e.target.result;
                   preview.style.display = 'block';
               };
   
               reader.readAsDataURL(file);
           } else {
               preview.src = '#';
               preview.style.display = 'none';
           }
       });
   });
</script><?= $this->endSection() ?>