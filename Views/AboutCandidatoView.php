<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/decoupled-document/ckeditor.js"></script>
<style>

.cke_top{
    border-radius: 10px 10px 0px 0px
}

.cke_bottom{
    border-radius: 0px 0px 10px 10px
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
</style>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="<?= base_url('recruitment/candidates') ?>">Banco de Talentos</a></li>
                     <li class="breadcrumb-item active">Vizualização</li>
                  </ol>
               </div>
               <h4 class="vaga-title mb-0"><?= esc($person['name']) ?></h4>
               <p class="mb-3"><?= date('d/m/Y', strtotime($person['registration_date'])); ?></p>
               <?php if(session()->has('alert')): ?>
      <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         <?= session('alert') ?>
      </div>
      <?php endif; ?>
               <ul class="nav nav-pills " id="pills-tab" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#infos" role="tab" aria-controls="pills-home" aria-selected="true">Informações</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#curriculo" role="tab" aria-controls="pills-profile" aria-selected="false">Curriculo</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#vagas" role="tab" aria-controls="pills-contact" aria-selected="false">Histórico de Vagas</a>
                  </li>
                  <?php if (!empty($calculation_results[0])) : ?><li class="nav-item">
                     <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#perfil" role="tab" aria-controls="pills-contact" aria-selected="false">Perfil Comportamental</a>
                  </li> <?php endif; ?>
                  <li class="nav-item">
                     <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#anotacoes" role="tab" aria-controls="pills-contact" aria-selected="false">Anotações</a>
                  </li>
               </ul>
               <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="infos" role="tabpanel" aria-labelledby="pills-home-tab">
                  








                     <form id="form1" action="" method="POST">
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
            <select  class="form-select" id="gender" name="gender">
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
            <select  class="form-select" id="marital" name="marital">
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
            <label for="personalmail" class="form-label">Email Pessoal</label>
            <input required type="mail" id="personalmail" name="personalmail" class="form-control" value="<?= esc($person['personal_email']) ?>">
         </div>
      </div>
      <div class="col-sm-4">
         <div class="mb-3">
            <label for="phone" class="form-label">Telefone Pessoal</label>
            <input required type="text" id="phone" name="phone" class="form-control" data-toggle="input-mask" data-mask-format="(00) 00000-0000" value="<?= esc($person['personal_phone']) ?>">
         </div>
      </div>
   </div>
   <!-- end row -->

 
   <div class="row">
      <!-- <div class="col-sm-3">
         <div class="mb-3">
            <label for="lastname" class="form-label">Data de Admissão</label>
            <input type="date" class="form-control" id="admission" name="admission" value="<?= esc($person['admission_date']) ?>">
         </div>
         </div>-->

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
            <input type="text" id="adress" name="adress" class="form-control">
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
            <input type="text" id="adress_district" name="adress_district" class="form-control">
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




                     </div>
                


            <div class="tab-pane fade" id="curriculo" role="tabpanel" aria-labelledby="pills-contact-tab">
      










            <div class="accordion" id="accordionExample 1">
   <?php if (!empty($vacancies)) : ?>
      <?php
      function displaySection($sectionTitle, $sectionContent, $id_recruitment) {
          echo "<h2 id='section-" . htmlspecialchars($id_recruitment) . "-" . htmlspecialchars($sectionTitle) . "'>" . htmlspecialchars($sectionTitle) . "</h2>";
          if (is_array($sectionContent)) {
              foreach ($sectionContent as $key => $value) {
                  if (is_array($value)) {
                      echo "<h3>" . htmlspecialchars($key) . "</h3><ul>";
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

      function displayCurriculum($curriculo_json, $id_recruitment) {
          $curriculo = json_decode($curriculo_json, true);
          if (json_last_error() !== JSON_ERROR_NONE) {
              echo "Erro ao decodificar JSON: " . json_last_error_msg();
              return;
          }
          foreach ($curriculo as $sectionTitle => $sectionContent) {
              displaySection($sectionTitle, $sectionContent, $id_recruitment);
          }
      }
      ?>

      <?php foreach ($vacancies as $vacancy) : ?>
         <div class="card mb-0">
            <div class="card-header" id="heading<?= $vacancy['id_recruitment'] ?>">
               <h5 class="m-0">
                  <a class="custom-accordion-title d-block pt-2 pb-2" data-bs-toggle="collapse" href="#re<?= $vacancy['id_recruitment'] ?>" aria-expanded="false" aria-controls="re<?= $vacancy['id_recruitment'] ?>">
                   <?= date('d/m/Y', strtotime($vacancy['creation_date'])) ?> <i class="mdi mdi-arrow-down"></i>
                  </a>
               </h5>
            </div>
            <div id="re<?= $vacancy['id_recruitment'] ?>" class="collapse" aria-labelledby="heading<?= $vacancy['id_recruitment'] ?>" data-bs-parent="#accordionExample3">
               <div class="card-body">
                  <?php displayCurriculum($vacancy['curriculum'], $vacancy['id_recruitment']); ?>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
   <?php else : ?>
   <?php endif; ?>
</div>







            











            </div>

            <div class="tab-pane fade" id="vagas" role="tabpanel" aria-labelledby="pills-contact-tab">




            <div class="accordion" id="accordionExample3">
   <?php if (!empty($vacancies)) : ?>
      <?php
      function displayQuestions($questions) {
          if (!empty($questions)) {
              echo "<h2 mb-3>Questionário</h2>";
              foreach ($questions as $question) {
                  echo "<p><b>" . htmlspecialchars($question['question']) . ":</b> " . htmlspecialchars($question['response']) . "</p>";
              }
          }
      }
      ?>

      <?php foreach ($vacancies as $vacancy) : ?>
         <div class="card mb-0">
            <div class="card-header" id="heading<?= $vacancy['id_recruitment'] ?>">
               <h5 class="m-0">
                  <a class="custom-accordion-title d-block pt-2 pb-2" data-bs-toggle="collapse" href="#re<?= $vacancy['id_recruitment'] ?>" aria-expanded="false" aria-controls="re<?= $vacancy['id_recruitment'] ?>">
                     <?= htmlspecialchars($vacancy['descricao_vaga']) ?> - <?= date('d/m/Y', strtotime($vacancy['creation_date'])) ?>  <i class="mdi mdi-arrow-down"></i>
                  </a>
               </h5>
            </div>
            <div id="re<?= $vacancy['id_recruitment'] ?>" class="collapse" aria-labelledby="heading<?= $vacancy['id_recruitment'] ?>" data-bs-parent="#accordionExample1">
               <div class="card-body">
                  <?php 
                  $questions = json_decode($vacancy['questions'], true);
                  displayQuestions($questions);
                  ?>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
   <?php else : ?>
   <?php endif; ?>
</div>



</div>



<div class="tab-pane fade mt-3 mb-5" id="perfil" role="tabpanel" aria-labelledby="pills-contact-tab">




<?php
if (isset($calculation_results)) {
    ?>
                     <div class="tab-pane" id="profile">
            
                     <div class="row">
                     <div class="col-8">
                     <div class="row">
                           <div id="atributes" class="apex-charts"></div>
                        </div>
                     </div>
                     
                     
                     
                     <div class="col-4">


                     <?php if (!empty($calculation_results[0])) : ?>
                                 <?php foreach ($calculation_results as $calc) : ?>
<p><a href="<?= base_url('/reports/complete/' . $calc['reference']) ?>"><img src="<?= base_url('assets/images/icons/pdf.png') ?>" alt="pdf_icon" class="me-2" height="24"> Relatório Completo</a></p>
<p><a href="<?= base_url('/reports/simplify/' . $calc['reference']) ?>"><img src="<?= base_url('assets/images/icons/pdf.png') ?>" alt="pdf_icon" class="me-2" height="24"> Relatório Simplificado</a></p>
                                 <?php endforeach; ?>
                                 <?php else : ?>
                                 <?php endif; ?>




                                 </div>
                     </div>
                    
                        <div class="row">
                           <div id="skills" class="apex-charts"></div>
                        </div>
                        <div class="card">
                        </div>
                     </div>
                     <?php }?>


























            
            </div>
            <div class="tab-pane fade mt-3" id="anotacoes" role="tabpanel" aria-labelledby="pills-contact-tab">

               <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Anotações</label>
                                    <div class="editor-container">
                                       <div id="toolbar-container2"></div>
                                       <div class="editor" id="editor-container2"></div>
                                       <textarea hidden class="form-control" id="activities" name="anotacao" rows="10" value="<?= esc($person['anotacoes']) ?>"><?= esc($person['anotacoes']) ?></textarea>
                                    </div>
                                 </div>





            </div>
         </div>



         <div class="text-end">
      <button type="submit"  class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Salvar Informações</button>
   </div>
</form>



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
</script>
<script>
        function isValidCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

            let sum = 0;
            for (let i = 0; i < 9; i++) {
                sum += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let remainder = (sum * 10) % 11;
            if (remainder === 10 || remainder === 11) remainder = 0;
            if (remainder !== parseInt(cpf.charAt(9))) return false;

            sum = 0;
            for (let i = 0; i < 10; i++) {
                sum += parseInt(cpf.charAt(i)) * (11 - i);
            }
            remainder = (sum * 10) % 11;
            if (remainder === 10 || remainder === 11) remainder = 0;
            return remainder === parseInt(cpf.charAt(10));
        }

        document.getElementById('document').addEventListener('input', function () {
            const cpfInput = this;
            const cpfValue = cpfInput.value;
            if (isValidCPF(cpfValue)) {
                cpfInput.classList.remove('invalid-cpf');
                cpfInput.classList.add('valid-cpf');
            } else {
                cpfInput.classList.remove('valid-cpf');
                cpfInput.classList.add('invalid-cpf');
            }
        });
    </script>
 <script>
        function applyPhoneMask(value) {
            value = value.replace(/\D/g, '');
            if (value.length <= 10) {
                return value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3').trim();
            } else {
                return value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3').trim();
            }
        }

        function isValidPhone(phone) {
            phone = phone.replace(/\D/g, '');
            return phone.length === 10 || phone.length === 11;
        }

        document.getElementById('phone').addEventListener('blur', function () {
            const input = this;
            let value = input.value;

            // Preserve only digits
            value = value.replace(/\D/g, '');

            // Apply the mask
            const maskedValue = applyPhoneMask(value);

            // Update the value
            input.value = maskedValue;

            // Validate the phone number
            if (isValidPhone(maskedValue)) {
                input.classList.remove('invalid-phone');
                input.classList.add('valid-phone');
            } else {
                input.classList.remove('valid-phone');
                input.classList.add('invalid-phone');
            }
        });
    </script>
<?=



$this->endSection() ?>