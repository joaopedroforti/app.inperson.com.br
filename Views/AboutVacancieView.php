<!-- app/Views/home.php -->



<?= $this->extend('layouts/master') ?>
<!--<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>-->
<?= $this->section('content') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/decoupled-document/ckeditor.js"></script>
<style>
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
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Vaga</a></li>
                     <li class="breadcrumb-item active">Ver</li>
                  </ol>
               </div>
               <h4 class="page-title">Cadastro da vaga</h4>
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
                  <h4 class="mb-0 mt-2"><?= esc($vacancie['description']) ?></h4>
                 
                  <p class="font-14">Cargo: <?= esc($vacancie['job_description']) ?></p>
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
                        Dados da Vaga
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
                              <div class="col-md-4">
                                 <div class="mb-3">
                                 <input hidden  type="text" id="reference" name="reference" class="form-control" value="<?= esc($vacancie['reference']) ?>">
                                 <input hidden  type="text" id="id_vacancie" name="id_vacancie" class="form-control" value="<?= esc($vacancie['id_vacancie']) ?>">
                                    <label for="company_name" class="form-label">Nome da Vaga</label>
                                    <input required  type="text" id="description" name="description" class="form-control" value="<?= esc($vacancie['description']) ?>">
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="document_number" class="form-label">Vagas</label>
                                    <input equired id="vacancies_number" name="vacancies_number" data-toggle="touchspin" type="text" value="<?= esc($vacancie['vacancies_number']) ?>">
                                 </div>
                              </div>

                              <div class="col-md-4">
                              <div class="mb-3">
                                    <label for="segmento" class="form-label">Local de Trabalho</label>


                                    <select class="form-control" required class="form-select" id="job_local" name="job_local">
                                    <option selected value="<?= esc($vacancie['local']) ?>"><?= esc($vacancie['local']) ?></option>
                        <option></option>
                           <option required value='Presencial'>Presencial</option>
                           <option required value='Híbrido'>Híbrido</option>
                           <option required value='Remoto'>Remoto</option>
                        </select>
                                 </div>
                              </div>




                                 </div>

                              <div class="row">

                
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="lastname" class="form-label">Tipo de Vaga</label>


                                    <select class="form-control" required class="form-select" id="type" name="type">
                                    <option selected value="<?= esc($vacancie['type_vacancie']) ?>"><?= esc($vacancie['type_vacancie']) ?></option>
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

                              
                              <div class="col-md-4">
                              <div class="mb-3">
                                    <label for="segmento" class="form-label">Jornada de Trabalho</label>


                                
                                    <input class="form-control" type="text" name="working_hours" id="working_hours" value="<?= esc($vacancie['working_hours']) ?>">
                                 </div>
                              </div>

                          

<div class="col-md-4">
<label for="confidencialidade" class="form-label">Divulgar no site da InPerson?</label><br>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="confidencialidade" id="confidencialidade_sim" value="0" <?= $vacancie['confidential'] == 0 ? 'checked' : '' ?>>
    <label class="form-check-label" for="confidencialidade_sim">
        Sim
    </label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="confidencialidade" id="confidencialidade_nao" value="1" <?= $vacancie['confidential'] != 0 ? 'checked' : '' ?>>
    <label class="form-check-label" for="confidencialidade_nao">
        Não
    </label>
</div>

</div>



<div class="row mb-3">
<div class="col-md-4">
            <label for="senioridade" class="form-label">Senioridade</label>
            <select class="form-select" id="senioridade" name="senioridade">
            <option selected value="<?= esc($vacancie['seniority']) ?>"><?= esc($vacancie['seniority']) ?></option>
                        <option></option>
                <option value="Trainee">Trainee</option>
                <option value="Estagiário">Estagiário</option>
                <option value="Júnior">Júnior</option>
                <option value="Pleno">Pleno</option>
                <option value="Sênior">Sênior</option>
                <option value="Especialista">Especialista</option>
            </select>
        </div>
<div class="col-md-4">
<label class="form-label">Faixa Salarial</label>

   
<input class="form-control" type = "text" id="faixa_salarial" name="faixa_salarial" value="<?= esc($vacancie['salary']) ?>">


</div>




</div>






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
                                                    </div> <!-- end col --><input hidden  id="benefitsHidden" name="benefits" value="">
</div>



<div class="col-md-6">

</div>

</div>



                
<div class="row">

<div class="col-md-8">
<div class="mb-3">
                           <label for="example-textarea" class="form-label">Resumo *</label>

        <textarea  class="form-control" id="resume" name="resume" rows="3" value="<?= esc($vacancie['resume']) ?>"><?= esc($vacancie['resume']) ?></textarea>
                        </div>
</div>


<div class="col-md-8">
<div class="mb-3">
                           <label for="example-textarea" class="form-label">Principais Atividades *</label>

    <div class="editor-container">
        <div id="toolbar-container2"></div>
        <div class="editor" id="editor-container2"></div>
        <textarea hidden class="form-control" id="activities" name="activities" rows="3" value="<?= esc($vacancie['activities']) ?>"><?= esc($vacancie['activities']) ?></textarea>
    </div>
                        </div>
</div>



<div class="col-md-8">
<div class="mb-3">
                           <label for="example-textarea" class="form-label">Requisitos</label>
                           <div class="editor-container">
        <div id="toolbar-container1"></div>
        <div id="editor-container1"></div>
        <textarea hidden required class="form-control" id="requeriments" name="requeriments" rows="3" value="<?= esc($vacancie['requirements']) ?>"><?= esc($vacancie['requirements']) ?></textarea>
    </div>
                        </div>

</div>


<p class="mb-1 fw-bold text-muted"><b>Perguntas</b></p>

<p><?= isset($vacancie['q1']) ? $vacancie['q1'] : ''; ?></p>
<p><?= isset($vacancie['q2']) ? $vacancie['q2'] : ''; ?></p>
<p><?= isset($vacancie['q3']) ? $vacancie['q3'] : ''; ?></p>
<p><?= isset($vacancie['q4']) ? $vacancie['q4'] : ''; ?></p>
<p><?= isset($vacancie['q5']) ? $vacancie['q5'] : ''; ?></p>




</div>
                           





<div class="row">

<div class="col-md-6">
<div class="mb-3">
                        <label for="example-select" class="form-label">Cargo</label>
                        <select required class="form-select" id="job" name="job">
                        <option selected value="<?= esc($vacancie['job_id']) ?>"><?= esc($vacancie['job_description']) ?></option>
                        <option></option>
                           <?php foreach ($jobs as $job): ?>
                           <option required value=<?= $job['id_job'] ?>><?= $job['description'] ?></option>
                           <?php endforeach; ?>
                        </select>
                           </div>
                        <div class="mb-3">
                           <label for="example-textarea" class="form-label">Encerramento da Vaga</label>
                           <input required type="datetime-local" id="expiration" name="expiration" class="form-control" value="<?= $vacancie['expiration_date'] ?>">



                        </div>
</div>



<div class="col-md-6">

</div>

</div>
                           




<div class="row">

<div class="col-md-6">

</div>



<div class="col-md-6">

</div>

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
        var selectedBenefits = "<?= $vacancie['benefits'] ?>";
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



<?= $this->endSection() ?>