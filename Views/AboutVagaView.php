<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/decoupled-document/ckeditor.js"></script>
<script src="<?= base_url('assets/js/vendor/apexcharts.min.js') ?>"></script>
<style>
   .linkedin-icon {
    color: #0077b5; /* Cor padrão do LinkedIn */
    font-size: 1em; /* Ajuste conforme necessário */
}

   .user-img{
   }
   .user-img:hover{
   opacity: 50%;
   cursor: pointer;
   }
   .editor{
   min-height{
   400px;
   }
   }
   .daterangepicker {
   z-index: 90000;
   }
   .nav-pills .nav-link {
   background: 0 0;
   border: 0;
   border-radius: .25rem;
   background-color: #efefef;
   margin-right: 10px;
   padding: 10px 100px;
   }
   .vaga-title{
   font-size: 30px;
   }
   .filters {
   align-items: end;
   }
   .classificacao {
   font-size: 24px; /* Ajuste o tamanho conforme necessário */
   color: #b9b900;
   }
   .etapas {
    display: flex;
margin-bottom: 10px;
}

.etapa {
    flex: 1;
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    position: relative;
    cursor: pointer; /* Adicionado para indicar que é clicável */
}

.etapa:not(:last-child) {
    border-right: none;
}

.etapa.active {
    background-color: #007bff;
    color: #fff;
}

.etapa:not(:last-child)::after {
    content: "";
    width: 0;
    height: 0;
    border-top: 20px solid transparent;
    border-bottom: 20px solid transparent;
    border-left: 20px solid #f9f9f9;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: -20px;
    z-index: 1;
}

.etapa.active:not(:last-child)::after {
    border-left-color: #007bff;
}

.etapa:not(:last-child)::before {
    content: "";
    width: 0;
    height: 0;
    border-top: 20px solid transparent;
    border-bottom: 20px solid transparent;
    border-left: 20px solid #ddd;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: -21px;
    z-index: 0;
}


</style>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="<?= base_url('/recrutamento')?>">Recrutamento</a></li>
                     <li class="breadcrumb-item active">Vizualização</li>
                  </ol>
               </div>
               <h4 class="vaga-title mb-0"><?= $vaga['description']?> <?= $vaga['seniority']?></h4>
               <p class="mb-3">Data da vaga: <?= $datacriacao ?> - <small> <?= $diascriacao ?> dias em aberto</small></p>
               <?php if(session()->has('alert')): ?>
      <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
         
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

         <?= session('alert') ?>
      </div>
      <?php endif; ?>
               <ul class="nav nav-pills " id="pills-tab" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#candidatos" role="tab" aria-controls="pills-home" aria-selected="true">Candidatos para a vaga</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#edit" role="tab" aria-controls="pills-profile" aria-selected="false">Informações da Vaga</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Roda de Competência</a>
                  </li>
               </ul>
               <form id="filter" action="<?= base_url('/vaga/filtered/' . esc($vaga['reference'])) ?>" method='POST'>
               <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="candidatos" role="tabpanel" aria-labelledby="pills-home-tab">
                     <div class="row mt-4 filters mt-2 mb-3">
                        <div class="col-sm-3">
                           <div class="app-search">
                              <div class="input-group">
                                 <input type="text" class="form-control dropdown-toggle" placeholder="Procurar..." id="ftext" name="ftext" value="<?= isset($_POST['ftext']) ? $_POST['ftext'] : ''?>">
                                 <span class="mdi mdi-magnify search-icon"></span>
                                 <input hidden type="text" class="form-control dropdown-toggle" id="ref" name="ref" value="<?= esc($vaga['reference']) ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <span>Filtrar por Status</span>
                           <div class="input-group">
                           <?php
// Verifica se o formulário foi enviado e captura o valor de ffavorite
$ffavorite = isset($_POST['ffavorite']) ? $_POST['ffavorite'] : '';

// Exibe o valor de $ffavorite para depuração
echo '<script>console.log("ffavorite: ' . htmlspecialchars($ffavorite) . '")</script>';

// Lista de opções com 'etapas' atrelado
$optionsFavoriteEtapas = [
    "" => "Exibindo Todos",
    "1" => "Somente Favoritos",
];
?>

<select id="ffavorite" name="ffavorite" class="form-select">
        <?php foreach ($optionsFavoriteEtapas as $valueFavoriteEtapas => $labelFavoriteEtapas): ?>
            <option value="<?php echo htmlspecialchars($valueFavoriteEtapas); ?>" <?php echo ($ffavorite == $valueFavoriteEtapas) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($labelFavoriteEtapas); ?>
            </option>
        <?php endforeach; ?>
    </select>

                           </div>
                        </div>
                        <div class="col-sm-2">
                           <span>Filtrar por Etapa</span>
                           <div class="input-group">
                           <?php
// Valor de fetapas obtido, pode ser passado através de POST ou GET
$fetapas = isset($_POST['fetapas']) ? $_POST['fetapas'] : '';

// Lista de opções com 'etapas' atrelado
$optionsEtapas = [
    "" => "Exibindo Todos",
    "Candidatos" => "Candidatos",
    "Análise Inicial" => "Análise Inicial",
    "Teste de Perfil" => "Teste de Perfil",
    "Entrevista" => "Entrevista",
    "Aprovado" => "Aprovado",
    "Documentação" => "Documentação",
];
?>

<select id="fetapas" name="fetapas" class="form-select">
    <?php foreach ($optionsEtapas as $valueEtapas => $labelEtapas): ?>
        <option value="<?php echo htmlspecialchars($valueEtapas); ?>" <?php echo ($fetapas === $valueEtapas) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($labelEtapas); ?>
        </option>
    <?php endforeach; ?>
</select>

                           </div>
                        </div>
                        <div class="col">
                           <button type="submit" form="filter" class="btn btn-primary"><i class="mdi mdi-filter"></i> Filtrar</button>
                        </div>
                     </div>
               </form>
                     <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                           <thead class="table-light">
                              <tr>
                                 <th style="width: 20px;">
                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="customCheck1">
                                       <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                 </th>
                                 <th>Candidato</th>
                                 <th>Classificação</th>
                                 <th>Adicionado em</th>
                                 <th>Resp. Questionario</th>
                                 <th>Perfil comportamental</th>
                                 <th>Entrevista agendada</th>
                                 <th>Etapa</th>
                                 <th style="width: 125px;">Ações</th>
                              </tr>
                           </thead>
                           <tbody>
                              <!-- Button trigger modal -->


<!-- Modal -->
<?php $totalCandidatos = count($candidatos); ?>


                              <?php foreach ($candidatos as $indiceAtual => $candidato) : 

                              ?>















<div class="modal fade" id="<?php echo $candidato['person_reference']; ?>modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
      

      <div class="row">
      <div class="col-auto">
        <div class="mb-0 mdi mdi-tag" id="star-<?php echo $candidato['person_reference']; ?>" data-reference="<?php echo $candidato['person_reference']; ?>" style="font-size: 1.5rem; color: <?php echo $candidato['favorite'] == 1 ? '#83DF83' : '#ACACAC'; ?>; cursor: pointer;"></div> 
                              </div>

                              <div class="col-auto">
        <h4 class="vaga-title mb-0"><?= $candidato['name']?></h4>
        </div>
        </div>


      <?php if (isset($candidato['interview'])):?>
    <?php endif; ?>
        <a href="<?= base_url('vaga/').$vaga["reference"] ?>"> <button type="button" class="btn-close"></button></a>
      </div>
      <div class="modal-body">

      <div class="d-flex justify-content-end">
    <!-- Ícone de avançar -->

<?php

$personReferenceAtual = $candidato['person_reference'];
    
// Obter o valor anterior
$indiceAnterior = $indiceAtual - 1;
$personReferenceAnterior = ($indiceAnterior >= 0) ? $candidatos[$indiceAnterior]['person_reference'] : null;

// Obter o valor posterior
$indicePosterior = $indiceAtual + 1;
$personReferencePosterior = ($indicePosterior < count($candidatos)) ? $candidatos[$indicePosterior]['person_reference'] : null;

?>

<div class="d-flex justify-content-end">

<div class="star-rating" data-person-reference="<?php echo htmlspecialchars($candidato['person_reference']); ?>" data-classification="<?php echo $candidato['classification']; ?>">
                <i class="classificacao mdi <?php echo ($candidato['classification'] >= 1) ? 'mdi-star' : 'mdi-star-outline'; ?>" onclick="updateClassification(this, 1)"></i>
                <i class="classificacao mdi <?php echo ($candidato['classification'] >= 2) ? 'mdi-star' : 'mdi-star-outline'; ?>" onclick="updateClassification(this, 2)"></i>
                <i class="classificacao mdi <?php echo ($candidato['classification'] >= 3) ? 'mdi-star' : 'mdi-star-outline'; ?>" onclick="updateClassification(this, 3)"></i>
            </div>


    <?php if (!is_null($personReferenceAnterior) && $personReferenceAnterior !== 'nh') { ?>
        <!-- Ícone de voltar -->
        <a href="#" class="action-icon" id="prevCandidate" data-bs-toggle="modal" data-bs-target="#<?php echo htmlspecialchars($personReferenceAnterior); ?>modal">
            <i class="mdi mdi-chevron-left icon-large" style="
    font-size: 25px;
"></i> <!-- Ícone de voltar -->
        </a>
    <?php } ?>

    <?php if (!is_null($personReferencePosterior) && $personReferencePosterior !== 'nh') { ?>
        <!-- Ícone de avançar -->
        <a href="#" class="action-icon ms-2" id="nextCandidate" data-bs-toggle="modal" data-bs-target="#<?php echo htmlspecialchars($personReferencePosterior); ?>modal">
            <i class="mdi mdi-chevron-right icon-large" style="
    font-size: 25px;
"></i> <!-- Ícone de avançar -->
        </a>
    <?php } ?>
</div>





</div>

<!-- modal etapa -->

<!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<form action="<?= base_url('new-interview')?>" method="POST" id="<?php echo $candidato['person_reference']; ?>">
  <div class="modal fade" id="modal_<?php echo $candidato['person_reference']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $candidato['name'] ?></h5>
          <div class="row">

</div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" value="<?= $candidato['id_recruitment'] ?>">
          <input type="hidden" name="vacancie" value="<?= $vaga['reference'] ?>">
          <div class="mb-3">
            <label for="datetime" class="form-label">Data e Hora da Entrevista</label>
            <input type="datetime-local" class="form-control" id="datetime" name="datetime">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Local</label>
            <input type="text" id="name" name="local" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </div>
  </div>
</form>





      <ul class="nav nav-pills " id="pills-tab" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#cinfo<?php echo $candidato['person_reference']; ?>" role="tab" aria-controls="pills-home" aria-selected="true">Informações</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#ccurriculo<?php echo $candidato['person_reference']; ?>" role="tab" aria-controls="pills-profile" aria-selected="false">Curriculo</a>
                  </li>
                  <?php if (!empty($candidato['skills'])) : ?>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#perfil<?php echo htmlspecialchars($candidato['person_reference']); ?>" role="tab" aria-controls="pills-profile" aria-selected="false">Perfil Comportamental</a>
    </li>
<?php endif; ?>
<li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#note<?php echo htmlspecialchars($candidato['person_reference']); ?>" role="tab" aria-controls="pills-profile" aria-selected="false">Anotações</a>
    </li>
               </ul>
<br>





<br>




               <div class="tab-content" id="pills-tabContent">
               <div class="tab-pane fade show active" id="cinfo<?php echo $candidato['person_reference']; ?>" role="tabpanel" aria-labelledby="pills-home-tab">

<div class="row">

<div class="etapas">
        <div class="etapa <?php echo ($candidato['step'] === 'Candidatos') ? 'active' : ''; ?>" onclick="mudaStep(this, '<?php echo htmlspecialchars($candidato['person_reference']); ?>')">Candidatos</div>
        <div class="etapa <?php echo ($candidato['step'] === 'Análise Inicial') ? 'active' : ''; ?>" onclick="mudaStep(this, '<?php echo htmlspecialchars($candidato['person_reference']); ?>')">Análise Inicial</div>
        <div class="etapa <?php echo ($candidato['step'] === 'Teste de Perfil') ? 'active' : ''; ?>" onclick="mudaStep(this, '<?php echo htmlspecialchars($candidato['person_reference']); ?>')">Teste de Perfil</div>
        <div 
    class="etapa <?php echo ($candidato['step'] === 'Entrevista') ? 'active' : ''; ?>" 
    onclick="mudaStep(this, '<?php echo htmlspecialchars($candidato['person_reference']); ?>')" 
    data-bs-target="#<?php echo htmlspecialchars($candidato['person_reference']); ?>modalentrevista"
>
    Entrevista
</div>
        <div class="etapa <?php echo ($candidato['step'] === 'Aprovado') ? 'active' : ''; ?>" onclick="mudaStep(this, '<?php echo htmlspecialchars($candidato['person_reference']); ?>')">Aprovado</div>
        <div class="etapa <?php echo ($candidato['step'] === 'Documentação') ? 'active' : ''; ?>" onclick="mudaStep(this, '<?php echo htmlspecialchars($candidato['person_reference']); ?>')">Documentação</div>
    </div>
<br>

                  </div>










                  <br>
               <div class="row">
    <?php if (!empty($candidato['personal_email'])): ?>
        <div class="col-md-4">
            <!-- Ícone e link de Email -->
            <div class="d-flex align-items-center">
                <i class="mdi mdi-email me-2"></i> <!-- Ícone de email -->
                <div>
                    <div><b>Email</b></div>
                    <a href="mailto:<?php echo htmlspecialchars($candidato['personal_email']); ?>" target="_blank">
                        <?php echo htmlspecialchars($candidato['personal_email']); ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($candidato['personal_phone'])): ?>
        <div class="col-md-4">
            <!-- Ícone e link de WhatsApp -->
            <div class="d-flex align-items-center">
                <i class="mdi mdi-whatsapp me-2"></i> <!-- Ícone de WhatsApp -->
                <div>
                    <div><b>WhatsApp</b></div>
                    <?php
                    $phoneNumber = preg_replace('/[^0-9]/', '', $candidato['personal_phone']);
                    ?>
                    <a href="https://wa.me/<?php echo htmlspecialchars($phoneNumber); ?>" target="_blank">
                        <?php echo htmlspecialchars($candidato['personal_phone']); ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($candidato['linkedin'])): ?>
        <div class="col-md-4">
            <!-- Ícone e link de LinkedIn -->
            <div class="d-flex align-items-center">
                <i class="mdi mdi-linkedin me-2 linkedin-icon"></i> <!-- Ícone de LinkedIn -->
                <div>
                    <div><b>LinkedIn</b></div>
                    <a href="<?php echo htmlspecialchars($candidato['linkedin']); ?>" target="_blank">
                        <?php echo htmlspecialchars($candidato['linkedin']); ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<br>

<br>


   <div class="row">
      <div class="col-md-4">
         <div class="mb-3">
            <label for="firstname" class="form-label">Nome Completo</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= esc($candidato['name']) ?>">
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label for="lastname" class="form-label">CPF</label>
            <input  type="text" id="document" name="document" class="form-control"  data-toggle="input-mask" data-mask-format="000.000.000-00" value="<?= esc($candidato['document_number']) ?>">
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label for="lastname" class="form-label">Data de Nascimento</label>
            <input  type="date" class="form-control" id="birth" name="birth" value="<?= esc($candidato['nascimento']) ?>">
         </div>
      </div>
   </div>

   <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Contato</h5>
   <div class="row">

      <div class="col-sm-4">
         <div class="mb-3">
            <label for="personalmail" class="form-label">Email Pessoal</label>
            <input  type="mail" id="personalmail" name="personalmail" class="form-control" value="<?= esc($candidato['personal_email']) ?>">
         </div>
      </div>
      <div class="col-sm-4">
         <div class="mb-3">
            <label for="phone" class="form-label">Telefone Pessoal</label>
            <input   type="text" id="phone" name="phone" class="form-control" data-toggle="input-mask" data-mask-format="(00) 0000-0000"  value="<?= esc($candidato['personal_phone']) ?>">
         </div>
      </div>
   </div>
   <!-- end row -->

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
      

      });
   </script>
   <div class="row">
      <!-- <div class="col-sm-3">
         <div class="mb-3">
            <label for="lastname" class="form-label">Data de Admissão</label>
            <input type="date" class="form-control" id="admission" name="admission" value="<?= esc($candidato['admission_date']) ?>">
         </div>
         </div>-->

   </div>
   <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i>Endereço</h5>
   <div class="row">
      <div class="col-sm-3">
         <div class="mb-1">
            <label for="phone" class="form-label">CEP</label>
            <input type="text" id="adress_cep" name="adress_cep" class="form-control" value="<?= esc($candidato['adress_zip']) ?>">
         </div>
      </div>
      <div class="col-sm-3">
         <div class="mb-3">
            <label for="phone" class="form-label">Endereço</label>
            <input type="text" id="adress" name="adress" class="form-control">
         </div>
      </div>
      <div class="col-sm-1">
         <div class="mb-3">
            <label for="phone" class="form-label">Numero</label>
            <input type="text" id="adress_number" name="adress_number" class="form-control" value="<?= esc($candidato['adress_number']) ?>">
         </div>
      </div>
      <div class="col-sm-2">
         <div class="mb-3">
            <label for="phone" class="form-label">Bairro</label>
            <input type="text" id="adress_district" name="adress_district" class="form-control">
         </div>
      </div>
      <div class="col-sm-3">
         <div class="mb-3">
            <label for="phone" class="form-label">Cidade</label>
            <input  type="text" id="adress_city" name="adress_city" class="form-control">
         </div>
      </div>
   </div>


   <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i>Entrevista</h5>
   <div class="row">
      <div class="col-sm-3">
         <div class="mb-1">
            <label for="phone" class="form-label">Entrevista</label>
            <input type="text" id="interview" name="interview" class="form-control" value="<?= esc($candidato['interview']) ?>">
         </div>
      </div>
    </div>
   <!-- end row -->










                              </div>


                              <div class="tab-pane fade show " id="ccurriculo<?php echo $candidato['person_reference']; ?>" role="tabpanel" aria-labelledby="pills-home-tab">







                              








                              <div style="overflow-y: auto; height: 500px;">
    <?php if (!empty($candidato['curriculum'])) : ?>
        <div style="margin-bottom: 20px;">
            <?php displayQuestions($candidato['questions']); ?>
            <h4>Curriculo</h4>
            <?php displayCurriculum($candidato['curriculum']); ?>
        </div>
    <?php else : ?>
        <p>Nenhum candidato encontrado.</p>
    <?php endif; ?>
</div>




















                              







                              </div>



                              <div class="tab-pane fade show " id="perfil<?php echo $candidato['person_reference']; ?>" role="tabpanel" aria-labelledby="pills-home-tab">


                              <div class="row">
                                 <div class="col-lg-8">
                        <div id="atributes-<?= $candidato['id_person'] ?>" class="apex-charts"></div>
                        </div>
                        <div class="col-md-4">
                        <p><a href="<?= base_url('/reports/complete/' . $candidato['calculation_reference']) ?>" target="_blank"><img src="<?= base_url('assets/images/icons/pdf.png') ?>" alt="pdf_icon" class="me-2" height="24"> Relatório Completo</a></p>
<p><a href="<?= base_url('/reports/simplify/' . $candidato['calculation_reference']) ?>" target="_blank"><img src="<?= base_url('assets/images/icons/pdf.png') ?>" alt="pdf_icon" class="me-2" height="24"> Relatório Simplificado</a></p>
  </div>
                        <div class="row">
                        <div id="skills-<?= $candidato['id_person'] ?>" class="apex-charts"></div>
                           </div>

</div>














                              </div>
                          


                              <div class="tab-pane fade show" id="note<?php echo $candidato['person_reference']; ?>" role="tabpanel" aria-labelledby="pills-home-tab">
                              <div id="alert-container"></div>

        <div class="mb-3">
            <div class="editor-container">
                <div id="toolbar-container<?php echo $candidato['person_reference']; ?>"></div>
                <div class="editor" id="editor-container<?php echo $candidato['person_reference']; ?>"></div>
                <textarea hidden class="form-control" id="activities<?php echo $candidato['person_reference']; ?>" name="anotacao" rows="10"><?= esc($candidato['anotacoes']) ?></textarea>
            </div>
        </div>
    </div>
    <div class="text-end">
        <button type="button" class="btn btn-success mt-2 saveButton" data-person-id="<?php echo $candidato['id_person']; ?>" data-person-reference="<?php echo $candidato['person_reference']; ?>"><i class="mdi mdi-content-save"></i> Salvar Informações</button>
    </div>



                              <div class="tab-pane fade show " id="outro<?php echo $candidato['person_reference']; ?>" role="tabpanel" aria-labelledby="pills-home-tab">
Curriculo

                              </div>


</div>










      </div>
    </div>
  </div>
</div>


<?php





                                 $questions = json_decode($candidato['questions'], true);
                                 

                                 if (is_null($questions)) {
                                    $simCount = 0;
                                    $naoCount = 0;
                                    $totalSimNao = 0;
                                } else {
                                    $simCount = 0;
                                    $naoCount = 0;
                                    $totalCount = count($questions);
                                    
                                    foreach ($questions as $q) {
                                    if ($q['response'] === 'Sim') {
                                    $simCount++;
                                    } elseif ($q['response'] === 'Não') {
                                    $naoCount++;
                                    }
                                    }
                                    
                                    $totalSimNao = $simCount + $naoCount;      
                                }

                                                 ?>






                              <tr>
                                 <td>
                                 <div class="mdi mdi-tag" id="star-<?php echo $candidato['person_reference']; ?>" data-reference="<?php echo $candidato['person_reference']; ?>" style="font-size: 1.5rem; color: <?php echo $candidato['favorite'] == 1 ? '#83DF83' : '#ACACAC'; ?>; cursor: pointer;"></div>
                           
                                 </td>
                                 <td>
                                
                                    <div class="d-flex">
                                       <div class="d-flex align-items-center">
                                          <div class="flex-shrink-0">
                                             <!--<img src="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" class="rounded-circle avatar-xs" alt="friend">
                              --></div>
                                          <div class="flex-grow-1 ms-2">
                                          <a style="text-decoration: none; color: inherit;" href="<?= base_url('candidato/' . $candidato['person_reference']) ?>"><h5 class="my-0"><?=$candidato['name']?></a> <?php if (!empty($candidato['linkedin'])): ?>
    <!-- Ícone do LinkedIn -->
    <a href="<?php echo htmlspecialchars($candidato['linkedin']); ?>" target="_blank" class="action-icon ms-2" aria-label="LinkedIn">
        <i class="mdi mdi-linkedin linkedin-icon"></i> <!-- Ícone do LinkedIn -->
    </a>
<?php endif; ?>
</h5>
                                            
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
            <div class="star-rating" data-person-reference="<?php echo htmlspecialchars($candidato['person_reference']); ?>" data-classification="<?php echo $candidato['classification']; ?>">
                <i class="classificacao mdi <?php echo ($candidato['classification'] >= 1) ? 'mdi-star' : 'mdi-star-outline'; ?>" onclick="updateClassification(this, 1)"></i>
                <i class="classificacao mdi <?php echo ($candidato['classification'] >= 2) ? 'mdi-star' : 'mdi-star-outline'; ?>" onclick="updateClassification(this, 2)"></i>
                <i class="classificacao mdi <?php echo ($candidato['classification'] >= 3) ? 'mdi-star' : 'mdi-star-outline'; ?>" onclick="updateClassification(this, 3)"></i>
            </div>
        </td>
                                 <td><?= date('d/m/Y', strtotime($candidato['registration_date'])); ?></td>
                                 <td><?= $simCount ?>/ <?= $totalSimNao ?></td>
                                 <td>
    <?php 
    if (empty($candidato['result_name'])) {
        echo "solicitar teste";
    } else {
        echo $candidato['result_name'];
    }
    ?>
</td>
                                 <td><?= $candidato['interview'];?></td>
                                 <td>
                                    <div class="input-group">
                                    <select id="step_<?php echo htmlspecialchars($candidato['person_reference']); ?>" 
                    name="step" 
                    class="form-select" 
                    onchange="updateStep('<?php echo htmlspecialchars($candidato['person_reference']); ?>', this)">
                <option value="Candidatos" <?php echo ($candidato['step'] === 'Candidatos') ? 'selected' : ''; ?>>Candidatos</option>
                <option value="Análise Inicial" <?php echo ($candidato['step'] === 'Análise Inicial') ? 'selected' : ''; ?>>Análise Inicial</option>
                <option value="Teste de Perfil" <?php echo ($candidato['step'] === 'Teste de Perfil') ? 'selected' : ''; ?>>Teste de Perfil</option>
                <option value="Entrevista" <?php echo ($candidato['step'] === 'Entrevista') ? 'selected' : ''; ?>>Entrevista</option>
                <option value="Aprovado" <?php echo ($candidato['step'] === 'Aprovado') ? 'selected' : ''; ?>>Aprovado</option>
                <option value="Documentação" <?php echo ($candidato['step'] === 'Documentação') ? 'selected' : ''; ?>>Documentação</option>
            </select>
                                    </div>
                                 </td>
                                 <td>
                                 <a data-bs-toggle="modal" data-bs-target="#modal<?= $candidato['person_reference'] ?>" class="action-icon"> <i class="mdi mdi-badge-account-outline"></i></a>
                                    <a data-bs-toggle="modal" data-bs-target="#<?php echo $candidato['person_reference']; ?>modal" class="action-icon"> <i class="mdi mdi-file-document"></i></a>
                                 </td>
                              </tr>




<!-- modal curriculo -->
<div class="modal fade" id="modal<?= $candidato['person_reference'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Curriculo <?= $candidato['name']?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <style>
        .print-button {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        .print-button i {
            margin-right: 8px;
        }

        .print-button:hover {
            background-color: #0056b3;
        }
    </style>
      <a href="<?= base_url('printcurriculo/').$candidato['person_reference'] ?>" target="_blank" class="print-button">
        <i class="mdi mdi-printer"></i> Imprimir
    </a>

      <?php displayCurriculum($candidato['curriculum']); ?>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<!-- modal intrevista -->











                              <?php endforeach ?>
                           </tbody>
                        </table>
                     </div>
                </div>

                  <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="pills-profile-tab">
                     <form action="" method="POST">
                        <div class="row mt-2 mb-3">
                           <div class="col-md-3">
                              <div class="mb-3">
                                 <input hidden  type="text" id="reference" name="reference" class="form-control" value="<?= esc($vaga['reference']) ?>">
                                 <input hidden  type="text" id="id_vacancie" name="id_vacancie" class="form-control" value="<?= esc($vaga['id_vacancie']) ?>">
                                 <label for="company_name" class="form-label">Nome da Vaga</label>
                                 <input required  type="text" id="description" name="description" class="form-control" value="<?= esc($vaga['description']) ?>">
                              </div>
                           </div>
   </div>


                               <div class="row mt-2 mb-3">

                              <div class="col-md-3">
                                 <label for="senioridade" class="form-label">Senioridade</label>
                                 <select class="form-select" id="senioridade" name="senioridade">
                                    <option selected value="<?= esc($vaga['seniority']) ?>"><?= esc($vaga['seniority']) ?></option>
                                    <option></option>
                                    <option value="Trainee">Trainee</option>
                                    <option value="Estagiário">Estagiário</option>
                                    <option value="Júnior">Júnior</option>
                                    <option value="Pleno">Pleno</option>
                                    <option value="Sênior">Sênior</option>
                                    <option value="Especialista">Especialista</option>
                                 </select>
                              </div>
            
                  
                              <div class="col-md-3">
                              <div class="mb-3">
                                 <label for="lastname" class="form-label">Contrato *</label>
                                 <select class="form-control" required class="form-select" id="type" name="type">
                                    <option selected value="<?= esc($vaga['type_vacancie']) ?>"><?= esc($vaga['type_vacancie']) ?></option>
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

                           <div class="col-md-3">
                              <div class="mb-3">
                                 <label for="document_number" class="form-label">Numero de pessoas a serem contratadas para o Cargo*</label>
                                 <input equired id="vacancies_number" name="vacancies_number" data-toggle="touchspin" type="text" value="<?= esc($vaga['vacancies_number']) ?>">
                              </div>
                           </div>


                           <div class="col-md-3">
                              <div class="mb-3">
                                 <label for="segmento" class="form-label">Local de Trabalho</label>
                                 <select class="form-control" required class="form-select" id="job_local" name="job_local">
                                    <option selected value="<?= esc($vaga['local']) ?>"><?= esc($vaga['local']) ?></option>
                                    <option></option>
                                    <option required value='Presencial'>Presencial</option>
                                    <option required value='Híbrido'>Híbrido</option>
                                    <option required value='Remoto'>Remoto</option>
                                 </select>
                              </div>
                           </div>


   </div>


   



                               <div class="row mt-2 mb-3">

                               <div class="col-md-3">
                              <div class="mb-3">
                                 <label for="segmento" class="form-label">Jornada de Trabalho</label>
                                 <input class="form-control" type="text" name="working_hours" id="working_hours" value="<?= esc($vaga['working_hours']) ?>">
                              </div>
                           </div>
                           <div class="col-md-3">
                                 <label class="form-label">Faixa Salarial</label>
                                 <input class="form-control" type = "text" id="faixa_salarial" name="faixa_salarial" value="<?= esc($vaga['salary']) ?>">
                              </div>
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="example-select" class="form-label">Cargo | Departamento</label>
                                    <select required class="form-select" id="job" name="job">
                                       <option selected value="<?= esc($vaga['job_id']) ?>"><?= esc($vaga['job_description']) ?></option>
                                       <option></option>
                                       <?php foreach ($jobs as $job): ?>
                                       <option required value=<?= $job['id_job'] ?>><?= $job['description'] ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
      
                              </div>


   </div>




   <div class="row mt-2 mb-3">

   <div class="col-md-4">
   <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Encerramento da Vaga</label>
                                    <input required type="datetime-local" id="expiration" name="expiration" class="form-control" value="<?= $vaga['expiration_date'] ?>">
                                 </div>
                                 </div>

                                 <div class="col-md-4">
                              <label for="confidencialidade" class="form-label">Divulgar no site da InPerson?</label><br>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="confidencialidade" id="confidencialidade_sim" value="0" <?= $vaga['confidential'] == 0 ? 'checked' : '' ?>>
                                 <label class="form-check-label" for="confidencialidade_sim">
                                 Sim
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="confidencialidade" id="confidencialidade_nao" value="1" <?= $vaga['confidential'] != 0 ? 'checked' : '' ?>>
                                 <label class="form-check-label" for="confidencialidade_nao">
                                 Não
                                 </label>
                              </div>
                           </div>



</div>




<div class="row mt-2 mb-3">






</div>


 


                        <div class="row">
                           
 
                 
                           <script>
                              document.addEventListener('DOMContentLoaded', function () {
                              var input = document.getElementById('salarial');
                              var hiddenInput = document.getElementById('faixa_salarial');
                              
                              function formatCurrency(value) {
                              value = value.replace(/\D/g, '');
                              value = (value / 100).toFixed(2) + '';
                              value = value.replace(".", ",");
                              value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                              return value;
                              }
                              
                              function unformatCurrency(value) {
                              return value.replace(/\./g, '').replace(',', '.');
                              }
                              
                              input.addEventListener('input', function (e) {
                              var value = e.target.value;
                              value = value.replace(/\D/g, '');
                              var numericValue = (value / 100).toFixed(2).replace('.', ',');
                              e.target.value = formatCurrency(value);
                              hiddenInput.value = numericValue.replace(',', '.');
                              });
                              
                              input.addEventListener('focus', function (e) {
                              if (e.target.value === '0,00') {
                              e.target.value = '';
                              }
                              });
                              
                              input.addEventListener('blur', function (e) {
                              if (e.target.value === '') {
                              e.target.value = '0,00';
                              }
                              });
                              
                              document.getElementById('salaryForm').addEventListener('submit', function () {
                              if (input.value === '') {
                              hiddenInput.value = '0.00';
                              } else {
                              var value = input.value.replace(/\D/g, '');
                              hiddenInput.value = (value / 100).toFixed(2).replace(',', '.');
                              }
                              });
                              // Populate the input field with the initial value if available
                              if (hiddenInput.value) {
                              input.value = formatCurrency(hiddenInput.value.replace('.', ''));
                              }
                              });
                           </script>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="mb-3">
                                    <p class="mb-1 fw-bold text-muted">Benefícios</p>
                                    <select id="benefits" class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Selecionar">
                                       <option id="vale-transporte" value="Vale-transporte" data-select2-id="vale-transporte-select2">Vale-transporte</option>
                                       <option id="assistencia-medica" value="Assistência médica" data-select2-id="assistencia-medica-select2">Assistência médica</option>
                                       <option id="vale-refeicao" value="Vale-refeição" data-select2-id="vale-refeicao-select2">Vale-refeição</option>
                                       <option id="vale-alimentacao" value="Vale-alimentação" data-select2-id="vale-alimentacao-select2">Vale-alimentação</option>
                                       <option id="assistencia-odontologica" value="Assistência odontológica" data-select2-id="assistencia-odontologica-select2">Assistência odontológica</option>
                                       <option id="seguro-de-vida" value="Seguro de vida" data-select2-id="seguro-de-vida-select2">Seguro de vida</option>
                                       <option id="participacao-nos-lucros" value="Participação nos lucros" data-select2-id="participacao-nos-lucros-select2">Participação nos lucros</option>
                                       <option id="cesta-basica" value="Cesta básica" data-select2-id="cesta-basica-select2">Cesta básica</option>
                                       <option id="trabalho-remoto" value="Trabalho remoto" data-select2-id="trabalho-remoto-select2">Trabalho remoto</option>
                                       <option id="auxilio-combustivel" value="Auxílio-combustível" data-select2-id="auxilio-combustivel-select2">Auxílio-combustível</option>
                                       <option id="auxilio-educacao" value="Auxílio-educação" data-select2-id="auxilio-educacao-select2">Auxílio-educação</option>
                                       <option id="auxilio-creche" value="Auxílio-creche" data-select2-id="auxilio-creche-select2">Auxílio-creche</option>
                                       <option id="previdencia-privada" value="Previdência privada" data-select2-id="previdencia-privada-select2">Previdência privada</option>
                                       <option id="estacionamento-gratuito" value="Estacionamento gratuito" data-select2-id="estacionamento-gratuito-select2">Estacionamento gratuito</option>
                                       <option id="celular-da-empresa" value="Celular da empresa" data-select2-id="celular-da-empresa-select2">Celular da empresa</option>
                                       <option id="veiculo-da-empresa" value="Veículo da empresa" data-select2-id="veiculo-da-empresa-select2">Veículo da empresa</option>
                                       <option id="auxilio-internet" value="Auxílio-internet" data-select2-id="auxilio-internet-select2">Auxílio-internet</option>
                                       <option id="convenios-e-descontos-comerciais" value="Convênios e descontos comerciais" data-select2-id="convenios-e-descontos-comerciais-select2">Convênios e descontos comerciais</option>
                                       <option id="auxilio-moradia" value="Auxílio-moradia" data-select2-id="auxilio-moradia-select2">Auxílio-moradia</option>
                                       <option id="outro" value="Outro" data-select2-id="outro-select2">Outro</option>
                                    </select>
                                 </div>
                                 <!-- end col --><input hidden  id="benefitsHidden" name="benefits" value="">
                              </div>
                              <div class="col-md-6">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-8">
                                 <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Resumo *</label>
                                    <textarea  class="form-control" id="resume" name="resume" rows="3" value="<?= esc($vaga['resume']) ?>"><?= esc($vaga['resume']) ?></textarea>
                                 </div>
                              </div>
                              <div class="col-md-8">
                                 <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Principais Atividades *</label>
                                    <div class="editor-container">
                                       <div id="toolbar-container2"></div>
                                       <div class="editor" id="editor-container2"></div>
                                       <textarea hidden class="form-control" id="activities" name="activities" rows="3" value="<?= esc($vaga['activities']) ?>"><?= esc($vaga['activities']) ?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-8">
                                 <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Requisitos</label>
                                    <div class="editor-container">
                                       <div id="toolbar-container1"></div>
                                       <div id="editor-container1"></div>
                                       <textarea hidden required class="form-control" id="requeriments" name="requeriments" rows="3" value="<?= esc($vaga['requirements']) ?>"><?= esc($vaga['requirements']) ?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <p class="mb-1 fw-bold text-muted"><b>Perguntas</b></p>
                              <p><?= isset($vaga['q1']) ? $vaga['q1'] : ''; ?></p>
                              <p><?= isset($vaga['q2']) ? $vaga['q2'] : ''; ?></p>
                              <p><?= isset($vaga['q3']) ? $vaga['q3'] : ''; ?></p>
                              <p><?= isset($vaga['q4']) ? $vaga['q4'] : ''; ?></p>
                              <p><?= isset($vaga['q5']) ? $vaga['q5'] : ''; ?></p>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                              </div>
                              <div class="col-md-6">
                              </div>
                           </div>
                        </div>
                        <div class="text-end">
                  <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Salvar Informações</button>
                  </div>
                  </form>
            </div>


            <div class="tab-pane fade mb-3" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

<br>
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


         </div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
      </div>
   </div>
</div>
</div> 
</div>










<script>
   document.addEventListener('DOMContentLoaded', function() {
       // Inicializa o Select2
       $('#benefits').select2();
   
       const benefitsSelect = document.getElementById('benefits');
       const benefitsHiddenInput = document.getElementById('benefitsHidden');
   
       function updateBenefitsHiddenInput() {
           const selectedOptions = Array.from(benefitsSelect.selectedOptions).map(option => option.value);
           benefitsHiddenInput.value = selectedOptions.join(', ');
       }
   
       benefitsSelect.addEventListener('change', updateBenefitsHiddenInput);
   
       // Atualiza o input oculto inicialmente caso haja valores pré-selecionados
       updateBenefitsHiddenInput();
   });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
       // Função para buscar o endereço com base no CEP
       function buscarEndereco(cep) {
           var xhr = new XMLHttpRequest();
           var url = "https://viacep.com.br/ws/" + cep + "/jsex
           xhr.onreadystatechange = function () {
               if (xhr.readyState == 4 && xhr.status == 200) {
                   var data = JSON.parse(xhr.responseText);
                   if (!data.hasOwnProperty('erro')) {
                       document.getElementById('adress').value = data.logradouro;
                       document.getElementById('adress_district').value = data.bairro;
                       document.getElementById('adress_city').value = data.localidade;
                   } else {
                       // Tratar caso haja erro na busca
                   }
               }
           };
           xhr.send();
       }
   
       // Capturar o valor do CEP
       var cepValue = document.getElementById('adress_cep').value.replace(/\D/g, '');
   
       // Verificar se o CEP não está vazio
       if (cepValue !== "") {
           // Buscar o endereço com base no CEP
           buscarEndereco(cepValue);
       }
   
       // Adicionar o evento blur ao campo de CEP
       document.getElementById('adress_cep').addEventListener('blur', function () {
           var cep = this.value.replace(/\D/g, '');
   
           if (cep !== "") {
               buscarEndereco(cep);
           }
       });
   });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
       var selectedBenefits = "<?= $vaga['benefits'] ?>";
       var benefitsArray = selectedBenefits.split(','); // Separar os valores por vírgula em um array
   
       benefitsArray.forEach(function (benefit) {
           $('#benefits').find('option[value="' + benefit + '"]').attr('selected', true); // Adicionar o atributo 'selected' aos options correspondentes
       });
   
       $('#benefits').trigger('change'); // Disparar um evento para atualizar o Select2
   });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
       var select = document.getElementById('benefits');
       var hiddenInput = document.getElementById('benefitsHidden');
   
       // Inicializa o Select2 no elemento select
       $(select).select2();
   
       // Função para atualizar o valor do input hidden
       function updateHiddenInput() {
           var selectedOptions = $(select).val();
           hiddenInput.value = selectedOptions.join(',');
       }
   
       // Adiciona um ouvinte de evento para o evento de mudança do Select2
       $(select).on('change', updateHiddenInput);
   
       // Chama a função updateHiddenInput para definir o valor inicial
       updateHiddenInput();
   });
</script>
<script>
   // Função para criar e configurar o editor CKEditor 5
   function setupEditor(editorContainerId, toolbarContainerId, textareaId) {
       DecoupledEditor
           .create(document.querySelector(editorContainerId), {
               toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'insertTable', 'undo', 'redo', 'heading'],
               table: {
                   contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
               }
           })
           .then(editor => {
               const toolbarContainer = document.querySelector(toolbarContainerId);
               toolbarContainer.appendChild(editor.ui.view.toolbar.element);
   
               // Sincronize o conteúdo do editor com o textarea correspondente
               editor.model.document.on('change:data', () => {
                   const data = editor.getData();
                   document.querySelector(textareaId).value = data;
               });
   
               // Inicialize o conteúdo do editor com o valor atual do textarea
               editor.setData(document.querySelector(textareaId).value);
           })
           .catch(error => {
               console.error(error);
           });
   }
   
   // Configuração dos editores
   setupEditor('#editor-container1', '#toolbar-container1', '#requeriments');
   setupEditor('#editor-container2', '#toolbar-container2', '#activities');
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.mdi-tag').forEach(function(star) {
        star.addEventListener('click', function() {
            var reference = this.getAttribute('data-reference');
            var element = this;
            
            fetch('<?php echo site_url('person/toggleFavorite/'); ?>' + reference, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.favorite !== undefined) {
                    element.style.color = data.favorite == 1 ? '#83DF83' : '#ACACAC';
                } else {
                    console.error('Error:', data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>

<script>
function updateStep(personReference, selectElement) {
    var selectedStep = selectElement.value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/update-step", true); // Atualize a URL conforme necessário
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Sucesso, você pode processar a resposta aqui se necessário
            console.log("Step atualizado com sucesso.");
             // Recarrega a página atual
        } else if (xhr.readyState === XMLHttpRequest.DONE) {
            // Erro
            console.error("Erro ao atualizar o step.");
        }
    };
    location.reload();
    xhr.send("person_reference=" + encodeURIComponent(personReference) + "&step=" + encodeURIComponent(selectedStep));
}
</script>




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
<script>
function updateClassification(starElement, newClassification) {

    var starRatingDiv = starElement.parentElement;
    var personReference = starRatingDiv.getAttribute('data-person-reference');
    var currentClassification = parseInt(starRatingDiv.getAttribute('data-classification'));

    // Se clicar na estrela que já está definida, redefinir para 0 e desmarcar todas as estrelas
    if (currentClassification === newClassification) {
        newClassification = 0;
    }

    // Atualizar visualmente as estrelas em tempo real
    updateStarVisuals(starRatingDiv, newClassification);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/update-classification", true); // Atualize a URL conforme necessário
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Sucesso, atualize a classificação visualmente
                starRatingDiv.setAttribute('data-classification', newClassification);
            } else {
                // Erro
            }
        }
    };
    xhr.send("person_reference=" + encodeURIComponent(personReference) + "&classification=" + encodeURIComponent(newClassification));
    console.log("Solicitação AJAX enviada.");
}

function updateStarVisuals(starRatingDiv, newClassification) {
    var stars = starRatingDiv.getElementsByClassName('classificacao');
    for (var i = 0; i < stars.length; i++) {
        if (i < newClassification) {
            stars[i].classList.remove('mdi-star-outline');
            stars[i].classList.add('mdi-star');
        } else {
            stars[i].classList.remove('mdi-star');
            stars[i].classList.add('mdi-star-outline');
        }
    }
}
</script>


<?php
function displayCurriculum($curriculo_json) {
    $curriculo = json_decode($curriculo_json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Erro ao decodificar JSON: " . json_last_error_msg();
        return;
    }

    echo "<div>";
    foreach ($curriculo as $sectionTitle => $sectionContent) {
        echo "<h4>" . htmlspecialchars($sectionTitle) . "</h4>";
        if (is_array($sectionContent)) {
            foreach ($sectionContent as $key => $value) {
                if (is_array($value)) {
                    echo "<h5>" . htmlspecialchars($key) . "</h5>";
                    echo "<ul>";
                    foreach ($value as $subKey => $subValue) {
                        if (is_array($subValue)) {
                            echo "<li>" . htmlspecialchars($subKey) . ":";
                            echo "<ul>";
                            foreach ($subValue as $subSubKey => $subSubValue) {
                                echo "<li>" . htmlspecialchars($subSubKey) . ": " . htmlspecialchars($subSubValue) . "</li>";
                            }
                            echo "</ul>";
                            echo "</li>";
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
    }
    echo "</div><hr>";
}

function displayQuestions($questions) {
    $questionsArray = json_decode($questions, true);
    if (!empty($questionsArray)) {
        echo "<h4>Questionário</h4>";
        foreach ($questionsArray as $question) {
            echo "<p><b>" . htmlspecialchars($question['question']) . ":</b> " . htmlspecialchars($question['response']) . "</p>";
        }
    }
}
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    function renderAtributesChart(elementId, attributes) {
        var attributesData = attributes ? JSON.parse(attributes) : {};

        var dados_absolutos = [
            parseFloat(attributesData.decision) || 0,
            parseFloat(attributesData.detail) || 0,
            parseFloat(attributesData.enthusiasm) || 0,
            parseFloat(attributesData.relational) || 0
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
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + '%'; // Adicionar '%' aos rótulos
                }
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

        var chart = new ApexCharts(document.querySelector("#" + elementId), options);
        chart.render();
    }

    function renderSkillsChart(elementId, skills) {
        var skillsData = skills ? JSON.parse(skills) : [];

        var options = {
            series: [{
                name: '',
                data: skillsData.map(skill => parseFloat(skill.value) || 0)
            }],
            chart: {
                height: 500,
                type: 'radar'
            },
            yaxis: {
                max: 100 // Define o valor máximo do eixo y como 100
            },
            xaxis: {
                categories: skillsData.map(skill => skill.name)
            }
        };

        var chart = new ApexCharts(document.querySelector("#" + elementId), options);
        chart.render();
    }

    <?php foreach ($candidatos as $candidato) : ?>
        var attributes<?= $candidato['id_person'] ?> = <?= json_encode($candidato['attributes']) ?>;
        var skills<?= $candidato['id_person'] ?> = <?= json_encode($candidato['skills']) ?>;

        renderAtributesChart('atributes-<?= $candidato['id_person'] ?>', attributes<?= $candidato['id_person'] ?> || null);
        renderSkillsChart('skills-<?= $candidato['id_person'] ?>', skills<?= $candidato['id_person'] ?> || null);
    <?php endforeach; ?>
});
</script>
<script>
   // Função para criar e configurar o editor CKEditor 5
   function setupEditor(editorContainerId, toolbarContainerId, textareaId) {
       DecoupledEditor
           .create(document.querySelector(editorContainerId), {
               toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'insertTable', 'undo', 'redo', 'heading'],
               table: {
                   contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
               }
           })
           .then(editor => {
               const toolbarContainer = document.querySelector(toolbarContainerId);
               toolbarContainer.appendChild(editor.ui.view.toolbar.element);
   
               // Sincronize o conteúdo do editor com o textarea correspondente
               editor.model.document.on('change:data', () => {
                   const data = editor.getData();
                   document.querySelector(textareaId).value = data;
               });
   
               // Inicialize o conteúdo do editor com o valor atual do textarea
               editor.setData(document.querySelector(textareaId).value);
           })
           .catch(error => {
               console.error(error);
           });
   }

   // Configuração dos editores para cada instância
   <?php foreach ($candidatos as $candidato) : ?>
       setupEditor(
           '#editor-container<?php echo $candidato['person_reference']; ?>',
           '#toolbar-container<?php echo $candidato['person_reference']; ?>',
           '#activities<?php echo $candidato['person_reference']; ?>'
       );
   <?php endforeach; ?>

   // Função para salvar as anotações
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function() {
    // Função para salvar as anotações
    $(document).on('click', '.saveButton', function() {
        var personId = $(this).data('person-id'); // Obtém o ID da pessoa do atributo data
        var personReference = $(this).data('person-reference'); // Obtém o identificador do editor
        var anotacao = $('#activities' + personReference).val(); // Obtém o valor do textarea

        $.ajax({
            type: 'POST',
            url: '<?= base_url('recruitment/save_anotacao') ?>',
            data: {
                id_person: personId,
                anotacao: anotacao
            },


            success: function(response) {
                // Atualiza o conteúdo da div de alerta e a exibe
                $('#alert-container').html(`
                    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        Informações salvas com sucesso!
                    </div>
                `).show(); // Exibe a div se estiver oculta
            },
            error: function(xhr, status, error) {
                alert('Erro ao salvar informações.');
            }
        });
    });
});
</script>
<script>
        function showModal(modalId) {
            var modalElement = new bootstrap.Modal(document.getElementById(modalId));
            modalElement.show();
        }

        function verifyAndOpenModal(candidato) {
            if (candidato.step === 'Entrevista' && !candidato.interview) {
                var modalId = 'modal_' + candidato.id_person;
                showModal(modalId);
            }
        }

        // Função de atalho
        function openInterviewModal(personId) {
            // Substitua esta parte pela lógica para obter o candidato com base no personId
            // Aqui estamos apenas simulando a obtenção do candidato
            var candidato = <?php echo json_encode($candidatos); ?>.find(function(c) {
                return c.id_person === personId;
            });

            if (candidato) {
                verifyAndOpenModal(candidato);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            <?php foreach ($candidatos as $candidato): ?>
                <?php if ($candidato['step'] == 'Entrevista' && empty($candidato['interview'])): ?>
                    // Chama a função de verificação e exibição do modal
                    openInterviewModal(<?= json_encode($candidato['id_person']); ?>);
                <?php endif; ?>
            <?php endforeach; ?>
        });
    </script>
 <script>
   function closeSpecificModal(personReference) {
    // Utilize o ID diretamente do `personReference`
   
}


        function mudaStep(clickedStep, personReference) {
         
            



            
            var steps = document.querySelectorAll('.etapa');
            steps.forEach(function(step) {
                step.classList.remove('active');
            });

            // Add 'active' class to the clicked step
            clickedStep.classList.add('active');

            // Get the step name
            var stepName = clickedStep.innerText.trim(); // Remove any extra whitespace

            // Create an AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/update-step", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Define what happens on successful data submission
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Step updated successfully');
                    
                    // Check if stepName is "Entrevista"
                    if (stepName === 'Entrevista') {
                        // Close all currently open modals
                        


                        

                        // Open the modal with the corresponding personReference
                        var modalId = 'modal_' + personReference;
                        var modalElement = document.getElementById(modalId);

                        // Ensure the modal element exists before trying to show it
                        if (modalElement) {
                            var bootstrapModal = new bootstrap.Modal(modalElement);
                            bootstrapModal.show();
                        } else {
                            console.error('Modal with ID ' + modalId + ' not found');
                        }
                    }
                } else {
                    console.error('An error occurred while updating the step');
                }
            };

            // Define what happens in case of an error
            xhr.onerror = function() {
                console.error('An error occurred during the request');
            };

            // Send the request with the step name and person reference
            xhr.send("step=" + encodeURIComponent(stepName) + "&person_reference=" + encodeURIComponent(personReference));
        }
    </script>

     
<?=



$this->endSection() ?>