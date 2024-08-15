<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<style>
   .hidden {
   display: none;
   }
   .letter-icons{
   width: 60px;
   }
</style>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Matcher</a></li>
                     <li class="breadcrumb-item active">Comparar</li>
                  </ol>
               </div>
               <h4 class="page-title">Matcher</h4>
               <div class="container">
                  <?php
                     // Verifica se o valor de 'step' é igual a 1
                     if ($step == 1) {?>
                  <form method="post">
                     <div class="row">
                        <!--<div class="col-sm-1" style="display: flex; justify-content: center; align-items: center;">
                           <img src="<?= base_url('assets/images/icons/a.png') ?>" class="letter-icons">
                        </div>-->
                        <div class="col-6">
                           <label class="form-label">Selecione Pessoa ou Cargo</label>
                           <select class="form-control" id="option1" name="option1">
                              <option> </option>
                              <option value="01">Pessoa</option>
                              <option value="02">Cargo</option>
                           </select>
                        </div>
                        <div class="col-6">
                           <div id="01job" class="hidden">
                              <!-- Listagem de Cargos -->
                              <label class="form-label">Selecionar</label>
                              <select class="form-control select2" data-toggle="select2" name="value1[]">
                                 <option> </option>
                                 <?php foreach ($jobs as $job) : ?>
                                 <option value=<?= esc($job->id_job) ?>><?= esc($job->description) ?> | <?= esc($job->department_name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                              <!-- /Listagem de Cargos -->
                           </div>
                           <div id="01person" class="hidden">
                              <!-- Listagem de Pessoas -->
                              <label class="form-label">Selecionar </label>
                              <select class="form-control select2" data-toggle="select2" name="value1[]">
                                 <option> </option>
                                 <?php foreach ($persons as $person) : ?>
                                 <option value=<?= esc($person->id_person) ?>><?= esc($person->full_name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                              <!-- /Listagem de Pessoas -->
                           </div>
                        </div>
                     </div>
                     <br><br><br>
                     <div class="text-center">
                        <img src="<?= base_url('assets/images/icons/arrow.png') ?>" class="img-fluid" style="width: 90px;">
                     </div>
                     <br><br>
                     <div class="row">
                       <!-- <div class="col-sm-1" style="display: flex; justify-content: center; align-items: center;">
                           <img src="<?= base_url('assets/images/icons/b.png') ?>" class="letter-icons">
                        </div>-->
                        <div class="col-6">
                           <label class="form-label">Selecione Pessoa ou Cargo</label>
                           <select class="form-control" id="option2" name="option2">
                              <option> </option>
                              <option value="01">Pessoa</option>
                              <option value="02">Cargo</option>
                           </select>
                        </div>
                        <div class="col-6">
                           <div id="02job" class="hidden">
                              <!-- Listagem de Cargos -->
                              <label class="form-label">Selecionar</label>
                              <select class="form-control select2" data-toggle="select2" name="value2[]">
                                 <option> </option>
                                 <?php foreach ($jobs as $job) : ?>
                                 <option value=<?= esc($job->id_job) ?>><?= esc($job->description) ?> | <?= esc($job->department_name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                              <!-- /Listagem de Cargos -->
                           </div>
                           <div id="02person" class="hidden">
                              <!-- Listagem de Pessoas -->
                              <label class="form-label">Selecionar</label>
                              <select class="form-control select2" data-toggle="select2" name="value2[]">
                                 <option> </option>
                                 <?php foreach ($persons as $person) : ?>
                                 <option value=<?= esc($person->id_person) ?>><?= esc($person->full_name) ?></option>
                                 <?php endforeach; ?>
                              </select>
                              <!-- /Listagem de Pessoas -->
                           </div>
                        </div>
                     </div>
                     <br><br><br><br>
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary">Comparar</button>
                     </div>
                  </form>
                  <?php
                     } else {
                     ?>
                  <br><br>
                  <!-- Inicio Caracteristicas -->
                  <div class="row">

                  <div class="col-md-6">
                  <p><b><?= esc($name01) ?></b></p>
                  </div>
                  <div class="col-md-6">
                  <p><b><?= esc($name02) ?></b></p>
</div>
<br><br>
                     </div>
                  <div class="row">
                     <!-- Entidade A -->
                     <div class="col-md-5">
                        <div class="row">
                           <!--<div class="col-sm-1" style="display: flex; justify-content: center; align-items: center;">
                              <img src="<?= base_url('assets/images/icons/a.png') ?>" class="letter-icons">
                           </div>-->
                           <div class="col">
                              <div class="row" style="margin-bottom: 5px;">
                                 <div class="col-3">
                                    Decisão
                                 </div>
                                 <div class="col-8">
                                    <div style="background-color: #bf66e5; align-items:right;">
                                       <div style="background-color: #9400d3; width: <?= esc($attributes01['decision']) ?>%"> .</div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <?= esc($attributes01['decision']) ?>%
                                 </div>
                              </div>
                              <div class="row" style="margin-bottom: 5px;">
                                 <div class="col-3">
                                    Detalhismo
                                 </div>
                                 <div class="col-8">
                                    <div style="background-color: #66c2c2; align-items:right;">
                                       <div style="background-color: #009999; width: <?= esc($attributes01['detail']) ?>%"> .</div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <?= esc($attributes01['detail']) ?>%
                                 </div>
                              </div>
                              <div class="row" style="margin-bottom: 5px;">
                                 <div class="col-3">
                                    Entusiasmo
                                 </div>
                                 <div class="col-8">
                                    <div style="background-color: #ffa3c2; align-items:right;">
                                       <div style="background-color: #ff6699; width: <?= esc($attributes01['enthusiasm']) ?>%"> .</div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <?= esc($attributes01['enthusiasm']) ?>%
                                 </div>
                              </div>
                              <div class="row" style="margin-bottom: 5px;">
                                 <div class="col-3">
                                    Relacional
                                 </div>
                                 <div class="col-8">
                                    <div style="background-color: #66b5d0; align-items:right;">
                                       <div style="background-color: #0084b0; width: <?= esc($attributes01['relational']) ?>%"> .</div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <?= esc($attributes01['relational']) ?>%
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Fim Entidade A -->
                     <div class="col-1"></div>
                     <!-- Entidade B -->
                     <div class="col-md-5">
                        <div class="row">
                           <!--<div class="col-sm-1" style="display: flex; justify-content: center; align-items: center;">
                              <img src="<?= base_url('assets/images/icons/b.png') ?>" class="letter-icons">
                           </div>-->
                           <div class="col">
                              <div class="row" style="margin-bottom: 5px;">
                                 <div class="col-3">
                                    Decisão
                                 </div>
                                 <div class="col-8">
                                    <div style="background-color: #bf66e5; align-items:right;">
                                       <div style="background-color: #9400d3; width: <?= esc($attributes02['decision']) ?>%"> .</div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <?= esc($attributes02['decision']) ?>%
                                 </div>
                              </div>
                              <div class="row" style="margin-bottom: 5px;">
                                 <div class="col-3">
                                    Detalhismo
                                 </div>
                                 <div class="col-8">
                                    <div style="background-color: #66c2c2; align-items:right;">
                                       <div style="background-color: #009999; width: <?= esc($attributes02['detail']) ?>%"> .</div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <?= esc($attributes02['detail']) ?>%
                                 </div>
                              </div>
                              <div class="row" style="margin-bottom: 5px;">
                                 <div class="col-3">
                                    Entusiasmo
                                 </div>
                                 <div class="col-8">
                                    <div style="background-color: #ffa3c2; align-items:right;">
                                       <div style="background-color: #ff6699; width: <?= esc($attributes02['enthusiasm']) ?>%"> .</div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <?= esc($attributes02['enthusiasm']) ?>%
                                 </div>
                              </div>
                              <div class="row" style="margin-bottom: 5px;">
                                 <div class="col-3">
                                    Relacional
                                 </div>
                                 <div class="col-8">
                                    <div style="background-color: #66b5d0; align-items:right;">
                                       <div style="background-color: #0084b0; width: <?= esc($attributes02['relational']) ?>%"> .</div>
                                    </div>
                                 </div>
                                 <div class="col-1">
                                    <?= esc($attributes02['relational']) ?>%
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Fim Entidade B -->
                  </div>
                  <br><br><br>
                  <!-- Fim Caracteristicas -->
                  <p> Roda de competencias </p>
                  <div id="chart"></div>
                  <br><br><br>
                  <script src="<?= base_url('assets/js/vendor/apexcharts.min.js') ?>"></script>
                  <!-- third party end -->
                  <!--  chart skills-->
                  <script>
                     var options = {
                        series: [{
                            name: '<?= $name01 ?>',
                            data: <?= $skillsvalue01 ?>,
                            color: '#4e79a7', // Azul
                        }, {
                            name: '<?= $name02 ?>',
                            data: <?= $skillsvalue02 ?>,
                            color: '#984ea3', // Roxo
                        }],
                        chart: {
                            height: 700,
                            type: 'radar'
                        },
                        title: {
                            text: ''
                        },
                        stroke: {
                            width: 0
                        },
                        fill: {
                            opacity: 0.7
                        },
                        markers: {
                            size: 0
                        },
                        xaxis: {
                            categories: [
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
                            ],
                            
                            labels: {
                              show: true,
                              style: {
                                colors: ["#a8a8a8"],
                                fontSize: "11px",
                                fontFamily: 'Arial'
                              }
                            }
                        },
                        yaxis: {
            max: 100 // Define o valor máximo do eixo y como 100
        },
                        legend: {
                            fontSize: '17px'
                        }
                     };
                     
                     var chart = new ApexCharts(document.querySelector("#chart"), options);
                     chart.render();
                  </script>
                  <?php
                     }
                     ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="<?= base_url('assets/js/match.js') ?>"></script>
<?= $this->endSection() ?>