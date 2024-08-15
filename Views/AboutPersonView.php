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

   .img-darken {
    position: relative;
}

.img-darken:hover::after {
    content: 'X';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 2em;
    background-color: rgba(0, 0, 0, 0.7); /* escurece a imagem */
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.subitem{
   font-size: 14px;
}

</style>
<meta charset="UTF-8">

<div class="content">
   <!-- Start Content-->
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="<?= base_url('employees') ?>">Pessoas</a></li>
                     <li class="breadcrumb-item active">Ver</li>
                  </ol>
               </div>
               <h4 class="page-title">Perfil de <?= esc(explode(' ', $person['name'])[0]) ?></h4>
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
               <?php if ($person['avatar'] == 1): ?>
    <img src="<?= base_url('assets/images/userimages/' . $person['reference'] . '.jpg') ?>" class="user-img rounded-circle avatar-lg img-thumbnail img-darken" alt="profile-image" data-bs-toggle="modal" data-bs-target="#standard-modal">
<?php else: ?>
    <img src="<?= base_url('assets/images/userimages/default.jpg') ?>" class="user-img  rounded-circle avatar-lg img-thumbnail img-darken" alt="profile-image" data-bs-toggle="modal" data-bs-target="#standard-modal">
<?php endif; ?>

                  <h4 class="mb-0 mt-2"><?= esc($person['name']) ?></h4>
                  <?php if (!empty($person['job_title'])): ?>
                  <p class="text-muted font-14 mb-0">Cargo: <?= esc($person['job_title']) ?></p>
                  <?php endif; ?>
                  <?php if (!empty($person['department_description'])): ?>
                  <p class="text-muted font-14 mb-0">Departamento: <?= esc($person['department_description']) ?></p>
                  <?php endif; ?>
                  <?php if (!empty($manager['name'])): ?>
    <p class="text-muted font-14">Gestor: <?= esc($manager['name']) ?></p>
<?php endif; ?>

<p class="text-muted mb-1 font-13"><?php if ($person['active'] == 1): ?>
    <span class="badge bg-success">Ativo</span>
<?php else: ?>
    <span class="badge bg-light text-dark">Inativo</span>
<?php endif; ?>
</span></p>


                  <!--<button type="button" class="btn btn-success btn-sm mb-2">Follow</button>
                     <button type="button" class="btn btn-danger btn-sm mb-2">Message</button>-->
                  <div class="text-start mt-3">
                     <h4 class="font-13 text-uppercase">Informações:</h4>
                     <p class="text-muted mb-2 font-13"><strong>Celular :</strong><span class="ms-2"><?= esc($person['personal_phone']) ?></span></p>
                     <p class="text-muted mb-2 font-13"><strong>Email Corporativo :</strong> <span class="ms-2 "><?= esc($person['internal_email']) ?></span></p>
                     <p class="text-muted mb-2 font-13"><strong>Email Pessoal :</strong> <span class="ms-2 "><?= esc($person['personal_email']) ?></span></p>
                     <!--<p class="text-muted mb-1 font-13"><strong>Admitido em :</strong> <span class="ms-2"><?= date('d/m/Y', strtotime($person['admission_date'])) ?></span></p>
--><p class="text-muted mb-1 font-13"><strong>Tipo de Contrato :</strong> <span class="ms-2"> <?= $person['contract_type'] ?></span></p>
                    
                     <p class="text-muted mb-1 font-13"><?php if ($person['active'] == 1): ?>
                        <a href="<?= base_url('person/status/?reference=' . esc($person['reference']) . '&action=0') ?>"><button type="button" class="btn btn-danger btn-sm">Inativar</button></a>

<?php else: ?>
   <a href="<?= base_url('person/status/?reference=' . esc($person['reference']) . '&action=1') ?>"><button type="button" class="btn btn-success btn-sm">Ativar</button></a>

<?php endif; ?>
</span></p>

<p class="text-muted mb-1 font-13"><?php if ($person['id_person_type'] == 2): ?>

<a href="<?= base_url('person/type/?reference=' . esc($person['reference']) . '&action=1') ?>"><button type="button" class="btn btn-primary btn-sm">Efetivar Candidado</button></a>
<?php endif; ?>
</span></p>



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


                     <?php
if (isset($calculation_results)) {
    ?>
    <a href="#anexos" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
        Anexos
    </a>
<?php
} else {
    ?>
    <a href="#anexos" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
        Anexos
    </a>
<?php
}
?>
</li>


<?php
if (isset($vacancies)) {
?>
 <li class="nav-item">
                        <a href="#vagas" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
                        Vagas
                        </a>
                     </li><?php } ?>

                     <?php

if (isset($calculation_results)) {
?>
                     <li class="nav-item">
                        <a href="#profile" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                        Perfil Comportamental
                        </a>
                     </li><?php }?>
                     <!--<li class="nav-item">
                        <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 ">
                        Timeline
                        </a>
                        </li>-->
                     <li class="nav-item">
                        <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                        Editar
                        </a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane show active" id="anexos" >
                        <h5 class="text-uppercase">Anexos</h5>
                        <h5 class="mb-3 mt-4 text-uppercase"><i class="mdi mdi-book-account-outline me-1"></i>
                           Relatorios
                        </h5>
                        <div class="table-responsive">
                           <table class="table table-borderless table-nowrap mb-0">
                              <thead class="table-light">
                                 <tr>
                                    <th>Titulo</th>
                                    <th>Perfil Comportamental</th>
                                    <th>Data</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php if (!empty($calculation_results)) : ?>
                                 <?php foreach ($calculation_results as $calc) : ?>
                                 <tr>
                                    <td class="align-middle"><img src="<?= base_url('assets/images/icons/pdf.png') ?>" alt="pdf_icon" class="me-2" height="24"> Relatório Completo</td>
                                    <td class="align-middle"><?= esc($calc['result_name']) ?></td>
                                    <td class="align-middle"><?= esc($calc['formatted_calculed_at']) ?></td>
                                    <td class="align-middle"><a href="<?= base_url('/reports/complete/' . $calc['reference']) ?>"><button type="button" class="btn btn-primary btn-sm">Baixar</button></a></td>
                                 </tr>
                                 <tr>
                                    <td class="align-middle"><img src="<?= base_url('assets/images/icons/pdf.png') ?>" alt="pdf_icon" class="me-2" height="24"> Relatório Simplificado</td>
                                    <td class="align-middle"><?= esc($calc['result_name']) ?></td>
                                    <td class="align-middle"><?= esc($calc['formatted_calculed_at']) ?></td>
                                    <td class="align-middle"><a href="<?= base_url('/reports/simplify/' . $calc['reference']) ?>"><button type="button" class="btn btn-primary btn-sm">Baixar</button></a></td>
                                 </tr>
                                 <?php endforeach; ?>
                                 <?php else : ?>
                                 <?php endif; ?>
                              </tbody>
                           </table>
                        </div>
                     </div>








                     <?php


if (isset($vacancies)) {
?>
                     <div class="tab-pane" id="vagas">
                     <!--<h4 class="text-uppercase">Curriculo</h5>-->

                    
                     <div class="accordion" id="accordionExample">
    <?php if (!empty($vacancies)) : ?>


<?php
// Função para exibir cada seção
function displaySection($sectionTitle, $sectionContent, $id_recruitment) {
    echo "<h2 id='section-" . htmlspecialchars($id_recruitment) . "-" . htmlspecialchars($sectionTitle) . "'>" . htmlspecialchars($sectionTitle) . "</h2>";
    
    if (is_array($sectionContent)) {
        foreach ($sectionContent as $key => $value) {
            if (is_array($value)) {
                echo "<h3>" . htmlspecialchars($key) . "</h3>";
                echo "<ul>";
                foreach ($value as $subKey => $subValue) {
                    if (is_array($subValue)) {
                        foreach ($subValue as $item) {
                            echo "<li>" . htmlspecialchars($subKey) . ": " . htmlspecialchars($item) . "</li>";
                        }
                    } else {
                        echo "<li>" . htmlspecialchars($subKey) . ": " . htmlspecialchars($subValue) . "</li>";
                    }
                }
                echo "</ul>";
            } else {
                echo "<p>" . htmlspecialchars($key) . ": " . htmlspecialchars($value) . "</p>";
            }
        }
    } else {
        echo "<p>" . htmlspecialchars($sectionContent) . "</p>";
    }
    
    echo "<hr>";
}

// Função para exibir o currículo
function displayCurriculum($curriculo_json, $id_recruitment) {
    // Decodifica a string JSON em um array associativo
    $curriculo = json_decode($curriculo_json, true);
    
    // Verifica se a decodificação JSON foi bem-sucedida
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Erro ao decodificar JSON: " . json_last_error_msg();
        return;
    }

    // Exibe cada seção do currículo
    foreach ($curriculo as $sectionTitle => $sectionContent) {
        displaySection($sectionTitle, $sectionContent, $id_recruitment);
    }
}
?>














        <?php foreach ($vacancies as $vacancy) : ?>
  
            <div class="card mb-0">
                <div class="card-header" id="heading<?= $vacancy['id_recruitment'] ?>">
                    <h5 class="m-0">
                        <a class="custom-accordion-title d-block pt-2 pb-2"
                            data-bs-toggle="collapse" href="#re<?= $vacancy['id_recruitment'] ?>"
                            aria-expanded="false" aria-controls="re<?= $vacancy['id_recruitment'] ?>">
                            <?= $vacancy['descricao_vaga']?> - <?= date('d/m/Y', strtotime($vacancy['creation_date'])) ?>
                        </a>
                    </h5>
                </div>

                <div id="re<?= $vacancy['id_recruitment'] ?>" class="collapse"
                    aria-labelledby="heading<?= $vacancy['id_recruitment'] ?>" data-bs-parent="#accordionExample">
                    <div class="card-body">
                        
                    
                    <?php 
                        $questions = json_decode($vacancy['questions'], true);
                        if (!empty($questions)) {
?>
                           <h2 mb-3>Questionário</h2>
<?php
                            foreach ($questions as $question) {?>
                               <p><b><?= htmlspecialchars($question['question'])?>: </b><?= htmlspecialchars($question['response']) ?></p>
                               

                                <?php
                            }
                        }
                        ?>
                    
                    <?php
    // Supondo que $vacancy['curriculum'] contenha a string JSON
    $curriculo_json = $vacancy['curriculum'];
    ?>


                    <h2>Curriculo</h2>
    <br>
    <?php displayCurriculum($curriculo_json, $vacancy['id_recruitment']); ?>

                    
                    
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Nenhuma vaga encontrada.</p>
    <?php endif; ?>
</div>

    


                   
                     </div>
                     <!-- end tab-pane -->
                     <?php
}


?>
   

                     <?php
if (isset($calculation_results)) {
    ?>
                     <div class="tab-pane" id="profile">
                        <h5 class="text-uppercase">Perfil Comportamental</h5>
                        <div class="row">
                           <div id="atributes" class="apex-charts"></div>
                        </div>
                        <div class="row">
                           <div id="skills" class="apex-charts"></div>
                        </div>
                        <div class="card">
                        </div>
                     </div>
                     <?php }?>
                     <!-- end tab-pane -->
                     <!-- end about me section content -->
                     <div class="tab-pane" id="timeline">
                        <!-- comment box -->
                        <div class="border rounded mt-2 mb-3">
                           <form action="#" class="comment-area-box">
                              <textarea rows="3" class="form-control border-0 resize-none" placeholder="Write something...."></textarea>
                              <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                 <div>
                                    <a href="#" class="btn btn-sm px-2 font-16 btn-light"><i class="mdi mdi-account-circle"></i></a>
                                    <a href="#" class="btn btn-sm px-2 font-16 btn-light"><i class="mdi mdi-map-marker"></i></a>
                                    <a href="#" class="btn btn-sm px-2 font-16 btn-light"><i class="mdi mdi-camera"></i></a>
                                    <a href="#" class="btn btn-sm px-2 font-16 btn-light"><i class="mdi mdi-emoticon-outline"></i></a>
                                 </div>
                                 <button type="submit" class="btn btn-sm btn-dark waves-effect">Post</button>
                              </div>
                           </form>
                        </div>
                        <!-- end .border-->
                        <!-- end comment box -->
                        <!-- Story Box-->
                        <div class="border border-light rounded p-2 mb-3">
                           <div class="d-flex">
                              <img class="me-2 rounded-circle" src="assets/images/users/avatar-3.jpg"
                                 alt="Generic placeholder image" height="32">
                              <div>
                                 <h5 class="m-0">Jeremy Tomlinson</h5>
                                 <p class="text-muted"><small>about 2 minuts ago</small></p>
                              </div>
                           </div>
                           <p>Story based around the idea of time lapse, animation to post soon!</p>
                           <img src="assets/images/small/small-1.jpg" alt="post-img" class="rounded me-1"
                              height="60" />
                           <img src="assets/images/small/small-2.jpg" alt="post-img" class="rounded me-1"
                              height="60" />
                           <img src="assets/images/small/small-3.jpg" alt="post-img" class="rounded"
                              height="60" />
                           <div class="mt-2">
                              <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i
                                 class="mdi mdi-reply"></i> Reply</a>
                              <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i
                                 class="mdi mdi-heart-outline"></i> Like</a>
                              <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i
                                 class="mdi mdi-share-variant"></i> Share</a>
                           </div>
                        </div>
                        <!-- Story Box-->
                        <div class="border border-light rounded p-2 mb-3">
                           <div class="d-flex">
                              <img class="me-2 rounded-circle" src="assets/images/users/avatar-4.jpg"
                                 alt="Generic placeholder image" height="32">
                              <div>
                                 <h5 class="m-0">Thelma Fridley</h5>
                                 <p class="text-muted"><small>about 1 hour ago</small></p>
                              </div>
                           </div>
                           <div class="font-16 text-center fst-italic text-dark">
                              <i class="mdi mdi-format-quote-open font-20"></i> Cras sit amet nibh libero, in
                              gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                              purus odio, vestibulum in vulputate at, tempus viverra turpis. Duis
                              sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper
                              porta. Mauris massa.
                           </div>
                           <div class="mx-n2 p-2 mt-3 bg-light">
                              <div class="d-flex">
                                 <img class="me-2 rounded-circle" src="assets/images/users/avatar-3.jpg"
                                    alt="Generic placeholder image" height="32">
                                 <div>
                                    <h5 class="mt-0">Jeremy Tomlinson <small class="text-muted">3 hours ago</small></h5>
                                    Nice work, makes me think of The Money Pit.
                                    <br/>
                                    <a href="javascript: void(0);" class="text-muted font-13 d-inline-block mt-2"><i
                                       class="mdi mdi-reply"></i> Reply</a>
                                    <div class="d-flex mt-3">
                                       <a class="pe-2" href="#">
                                       <img src="assets/images/users/avatar-4.jpg" class="rounded-circle"
                                          alt="Generic placeholder image" height="32">
                                       </a>
                                       <div>
                                          <h5 class="mt-0">Thelma Fridley <small class="text-muted">5 hours ago</small></h5>
                                          i'm in the middle of a timelapse animation myself! (Very different though.) Awesome stuff.
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex mt-2">
                                 <a class="pe-2" href="#">
                                 <img src="assets/images/users/avatar-1.jpg" class="rounded-circle"
                                    alt="Generic placeholder image" height="32">
                                 </a>
                                 <div class="w-100">
                                    <input type="text" id="simpleinput" class="form-control border-0 form-control-sm" placeholder="Add comment">
                                 </div>
                              </div>
                           </div>
                           <div class="mt-2">
                              <a href="javascript: void(0);" class="btn btn-sm btn-link text-danger"><i
                                 class="mdi mdi-heart"></i> Like (28)</a>
                              <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i
                                 class="mdi mdi-share-variant"></i> Share</a>
                           </div>
                        </div>
                        <!-- Story Box-->
                        <div class="border border-light p-2 mb-3">
                           <div class="d-flex">
                              <img class="me-2 rounded-circle" src="assets/images/users/avatar-6.jpg"
                                 alt="Generic placeholder image" height="32">
                              <div>
                                 <h5 class="m-0">Martin Williamson</h5>
                                 <p class="text-muted"><small>15 hours ago</small></p>
                              </div>
                           </div>
                           <p>The parallax is a little odd but O.o that house build is awesome!!</p>
                           <iframe src='https://player.vimeo.com/video/87993762' height='300' class="img-fluid border-0"></iframe>
                        </div>
                        <div class="text-center">
                           <a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-spin mdi-loading me-1"></i> Load more </a>
                        </div>
                     </div>
                     <!-- end timeline content-->
                     <div class="tab-pane" id="settings">
                        <form action="" method="POST">
                           <input hidden type="text" id="id_person" name="id_person" class="form-control" value="<?= esc($person['id_person']) ?>">
                           <input hidden type="text" id="reference" name="reference" class="form-control" value="<?= esc($person['reference']) ?>">
                           <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i>Informações Pessoais</h5>
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="firstname" class="form-label">Nome Completo</label>
                                    <input required type="text" id="name" name="name" class="form-control" value="<?= esc($person['name']) ?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="lastname" class="form-label">CPF</label>
                                    <input required type="text" id="document" name="document" class="form-control"  data-toggle="input-mask" data-mask-format="000.000.000-00" value="<?= esc($person['document_number']) ?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="lastname" class="form-label">Data de Nascimento</label>
                                    <input required type="date" class="form-control" id="birth" name="birth" value="<?= esc($person['nascimento']) ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-3">
                                 <div class="mb-3">
                                    <label class="form-label">Gênero</label>
                                    <select required class="form-select" id="gender" name="gender">
                                       <option value="<?= esc($person['gender_id'])?>"><?= esc($person['gender_description']) ?></option>
                                       <option></option>
                                       <?php foreach ($genders as $gender): ?>
                                       <option value="<?= $gender['id_gender'] ?>"><?= $gender['description'] ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="mb-3">
                                    <label class="form-label">Estado Civil</label>
                                    <select required class="form-select" id="marital" name="marital">
                                       <option value="<?= esc($person['marital_id'])?>"><?= esc($person['marital_description']) ?></option>
                                       <option></option>
                                       <?php foreach ($maritals as $marital): ?>
                                       <option value="<?= $marital['id_marital'] ?>"><?= $marital['description'] ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Contato</h5>
                           <div class="row">
                              <div class="col-sm-4">
                                 <div class="mb-3">
                                    <label for="mail" class="form-label">Email Corporativo</label>
                                    <input type="mail" id="mail" name="mail" class="form-control" value="<?= esc($person['internal_email']) ?>">
                                 </div>
                              </div>
                              <div class="col-sm-4">
                                 <div class="mb-3">
                                    <label for="personalmail" class="form-label">Email Pessoal</label>
                                    <input required type="mail" id="personalmail" name="personalmail" class="form-control" value="<?= esc($person['personal_email']) ?>">
                                 </div>
                              </div>
                              <div class="col-sm-4">
                                 <div class="mb-3">
                                    <label for="phone" class="form-label">Telefone Pessoal</label>
                                    <input  type="text" id="phone" name="phone" class="form-control" data-toggle="input-mask" data-mask-format="(00) 0000-0000"  value="<?= esc($person['personal_phone']) ?>">
                                 </div>
                              </div>
                           </div>
                           <!-- end row -->
                           <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i>Cargo e Formação</h5>
                           <div class="row">
                              <div class="col-sm-3">
                                 <div class="mb-3">
                                    <label for="mail" class="form-label">Area de Formação</label>
                                    <input type="text" id="course" name="course" class="form-control" value="<?= esc($person['formation_course']) ?>">
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="mb-3">
                                    <label for="example-select" class="form-label">Escolaridade</label>
                                    <select required class="form-select" id="education" name="education">
                                       <option value="<?= $person['education_level'] ?>"><?= $person['education_description'] ?></option>
                                       <option></option>
                                       <?php foreach ($educationLevels as $level): ?>
                                       <option value="<?= $level['id_education'] ?>"><?= $level['description'] ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                              <?php
// Array associativo para armazenar departamentos únicos
$uniqueDepartments = [];

// Filtra os departamentos para garantir que não sejam repetidos
foreach ($jobroles as $jobrole) {
    $departmentId = $jobrole['id_department'];
    if (!isset($uniqueDepartments[$departmentId])) {
        $uniqueDepartments[$departmentId] = $jobrole['department_description'];
    }
}
?>
<input hidden type="text" id="department_name" name="department_name" readonly value="<?= $person['department_id'] ?>">
<div class="col-sm-3">
    <div class="mb-3">
        <label for="department_select" class="form-label">Departamento</label>
        <select required class="form-select" id="department_select" name="department_select">
            <option value="<?= $person['department_id'] ?>"><?= $person['department_description'] ?></option>
            <option></option>
            <?php foreach ($uniqueDepartments as $departmentId => $departmentDescription): ?>
                <option value="<?= $departmentId ?>"><?= $departmentDescription ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="col-sm-3">
    <div class="mb-3">
        <label for="job" class="form-label">Cargo</label>
        <select required class="form-select" id="job" name="job">
        <option selected value=" <?= $person['job_title'] ?>"> <?= $person['job_title'] ?></option>
        <option></option>
        <option value="">Selecione uma função</option>
        </select>
    </div>
</div>

                           
                           </div>



<!-- Department Name Input -->





                              <script>
    // Seleciona os elementos HTML
    const departmentNameInput = document.getElementById('department_name');
    const departmentSelect = document.getElementById('department_select');
    const jobRoleSelect = document.getElementById('job');

    // Adiciona um listener para o evento change no departamento select
    departmentSelect.addEventListener('change', function () {
        // Limpa as opções do select de função
        jobRoleSelect.innerHTML = '<option value="">Selecione uma função</option>';

        // Obtém o valor selecionado do departamento
        const selectedDepartmentId = departmentSelect.value;

        // Preenche o campo de texto com o ID do departamento selecionado
        departmentNameInput.value = selectedDepartmentId;

        // Filtra as funções baseadas no departamento selecionado e adiciona as opções ao select de função
        <?php foreach ($jobroles as $jobrole): ?>
            if ('<?= $jobrole['id_department'] ?>' === selectedDepartmentId) {
                const option = document.createElement('option');
                option.value = '<?= $jobrole['id_job'] ?>';
                option.textContent = '<?= $jobrole['description'] ?>';
                jobRoleSelect.appendChild(option);
            }
        <?php endforeach; ?>
    });
</script>

                              <div class="row">
                             <!-- <div class="col-sm-3">
                                 <div class="mb-3">
                                    <label for="lastname" class="form-label">Data de Admissão</label>
                                    <input type="date" class="form-control" id="admission" name="admission" value="<?= esc($person['admission_date']) ?>">
                                 </div>
                              </div>-->

                              <div class="col-sm-3">
                                 <div class="mb-3">
                                    <label for="example-select" class="form-label">Tipo de Contrato</label>
                                    <select required class="form-select" id="contract_type" name="contract_type">
                                       <option value="<?= $person['job_id'] ?>"><?= $person['contract_type'] ?></option>
                                       <option></option>
                                       <option value="Efetivo CLT">Efetivo CLT</option>
    <option value="Tempo integral">Tempo integral</option>
    <option value="Estágio / Trainee">Estágio / Trainee</option>
    <option value="Temporário">Temporário</option>
    <option value="Meio período">Meio período</option>
    <option value="Autônomo / PJ">Autônomo / PJ</option>
    <option value="Aprendiz">Aprendiz</option>
    <option value="Intermitente (freelance)">Intermitente (freelance)</option>
                                    </select>
                                 </div>
                              </div>

                           </div>
                           <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i>Endereço</h5>
                           <div class="row">
                              <div class="col-sm-3">
                                 <div class="mb-1">
                                    <label for="phone" class="form-label">CEP</label>
                                    <input required type="text" id="adress_cep" name="adress_cep" class="form-control" value="<?= esc($person['adress_zip']) ?>">
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="mb-3">
                                    <label for="phone" class="form-label">Endereço</label>
                                    <input readonly type="text" id="adress" name="adress" class="form-control">
                                 </div>
                              </div>
                              <div class="col-sm-1">
                                 <div class="mb-3">
                                    <label for="phone" class="form-label">Numero</label>
                                    <input required type="text" id="adress_number" name="adress_number" class="form-control" value="<?= esc($person['adress_number']) ?>">
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="mb-3">
                                    <label for="phone" class="form-label">Bairro</label>
                                    <input readonly type="text" id="adress_district" name="adress_district" class="form-control">
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="mb-3">
                                    <label for="phone" class="form-label">Cidade</label>
                                    <input readonly type="text" id="adress_city" name="adress_city" class="form-control">
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
               <input hidden name="reference" id="reference" value="<?= esc($person['reference']) ?>">
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
<script src="<?= base_url('assets/js/vendor/apexcharts.min.js') ?>"></script>
<!-- third party end -->
<!--  chart skills-->
<script>
    var options = {
        series: [{
            name: '',
            data: <?= json_encode($values) ?>,
        }],
        chart: {
            height: 500,
            type: 'radar',
        },
        yaxis: {
            max: 100 // Define o valor máximo do eixo y como 100
        },
        xaxis: {
            categories: <?= json_encode($names) ?>
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