
<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/decoupled-document/ckeditor.js"></script>
<style>
        #toolbar-container {
            margin-bottom: 10px;
        }
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>

    <script>
        // Função para inicializar CKEditor 5 headless no textarea
        DecoupledEditor
            .create( document.querySelector( '#editor' ), {
                toolbar: [
                    'bold', 'italic', 'bulletedList', 'numberedList', 'insertTable', 'undo', 'redo'
                ],
                table: {
                    contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                }
            } )
            .then( editor => {
                const toolbarContainer = document.createElement( 'div' );
                toolbarContainer.classList.add( 'toolbar-container' );
                document.body.insertBefore( toolbarContainer, document.body.firstChild );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );

                // Sincronize o conteúdo do textarea com o editor
                editor.model.document.on( 'change:data', () => {
                    document.querySelector( '#editor' ).value = editor.getData();
                } );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
<style>
.daterangepicker {
    z-index: 90000;

}
.remove-button {
            cursor: pointer;
            margin-left: 5px;
            color: red;
        }
        #requeriments {
            display: none;
        }
        #activities {
            display: none;
        }
    </style>

<div class="content d-flex justify-content-center">
    <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                               <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"><a href="javascript: void(0);">Vagas</a></li>
                                 <li class="breadcrumb-item active">Adicionar</li>
                               </ol>
                            </div>
                            <h4 class="page-title">Nova Vaga</h4>
                            <form action="" method="POST">

                            <div class="row mb-3">
        <div class="col-lg-6 mb-3">
            <label for="example-palaceholder" class="form-label">Titulo da Vaga *</label>
            <input required required type="text" id="description" name="description" class="form-control">
        </div>

        <div class="col-sm-3 mb-3">
            <label for="faixa_salarial" class="form-label">Senioridade</label>
            <select class="form-select" id="senioridade" name="senioridade">
            <option value="" disabled selected>Selecione a Senioridade da Vaga</option>
                <option value="Trainee">Trainee</option>
                <option value="Estagiário">Estagiário</option>
                <option value="Júnior">Júnior</option>
                <option value="Pleno">Pleno</option>
                <option value="Sênior">Sênior</option>
                <option value="Especialista">Especialista</option>
            </select>
        </div>
        <div class="col-sm-3 mb-3">

            <label for="example-select" class="form-label">Contrato *</label>
            <select class="form-control" required class="form-select" id="type" name="type">
                <option value="" disabled selected>Selecione o tipo de contrato</option>
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

    <div class="row mb-3">
   <div class="col-md-4 mb-3">
      <label for="vacancies_number" class="form-label">Numero de pessoas a serem contratadas para o Cargo *</label>
      <input required id="vacancies_number" name="vacancies_number" data-toggle="touchspin" type="text" value="1">
   </div>
   <div class="col-md-4 mb-3">
      <label for="example-select" class="form-label">Local de Trabalho *</label>
      <select class="form-control" required class="form-select" id="job_local" name="job_local">
         <option selected></option>
         <option required value='Presencial'>Presencial</option>
         <option required value='Híbrido'>Híbrido</option>
         <option required value='Remoto'>Remoto</option>
      </select>
   </div>
   <div class="col-md-4 mb-3">
      <label for="horario" class="form-label">Jornada de Trabalho <i class="mdi mdi-help-box" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="Segunda a Sexta das 08:00 as 17:00" title="Exemplo"></i>*</label>
      <input class="form-control" required id="horario" name="horario"type="text" value="">
   </div>
</div>

<div class="row mb-3">
    <div class="col-md-4 mb-3">
    <label for="salario" class="form-label">Salário *</label>
    <small>Selecione Digitar para o valor ou selecione uma Faixa Salarial</small>
    <select class="form-select" id="salario" name="salario" onchange="updateCustomValue()">
        <option value=""></option>
        <option value="digitar">Digitar</option>
        <option value="A Combinar">A Combinar</option>
        <option value="Até R$ 1.000,00">Até R$ 1.000,00</option>
        <option value="De R$ 1.001,00 a R$ 2.000,00">De R$ 1.001,00 a R$ 2.000,00</option>
        <option value="De R$ 2.001,00 a R$ 3.000,00">De R$ 2.001,00 a R$ 3.000,00</option>
        <option value="De R$ 3.001,00 a R$ 4.000,00">De R$ 3.001,00 a R$ 4.000,00</option>
        <option value="De R$ 4.001,00 a R$ 5.000,00">De R$ 4.001,00 a R$ 5.000,00</option>
        <option value="De R$ 5.001,00 a R$ 6.000,00">De R$ 5.001,00 a R$ 6.000,00</option>
        <option value="De R$ 6.001,00 a R$ 7.000,00">De R$ 6.001,00 a R$ 7.000,00</option>
        <option value="De R$ 7.001,00 a R$ 8.000,00">De R$ 7.001,00 a R$ 8.000,00</option>
        <option value="De R$ 8.001,00 a R$ 9.000,00">De R$ 8.001,00 a R$ 9.000,00</option>
        <option value="De R$ 9.001,00 a R$ 10.000,00">De R$ 9.001,00 a R$ 10.000,00</option>
        <option value="De R$ 10.001,00 a R$ 15.000,00">De R$ 10.001,00 a R$ 15.000,00</option>
        <option value="De R$ 15.001,00 a R$ 20.000,00">De R$ 15.001,00 a R$ 20.000,00</option>
        <option value="Acima de R$ 20.000,00">Acima de R$ 20.000,00</option>
    </select>
    <!-- Campo de entrada adicional para digitar um valor personalizado -->

    <div class="input-group mb-2">
                <div class="input-group-text"  id="divsalarial" name="divsalarial" style="display: none;">R$</div>
                <input type="text" class="form-control" id="salarial" name="salarial" placeholder="Ou Digite um valor personalizado" style="display: none;">
    </div>
    <input hidden type = "text" id="faixa_salarial" name="faixa_salarial">
    </div>








    
    <div class="col-md-8 mb-3">
    <p class="mb-1 fw-bold text-muted">Benefícios *</p>
                    
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
    <input hidden id="benefitsHidden" name="benefits" value="">

</div>
<div class="row mb-3">
    <div class="col-md-6 mb-3">
    <label for="example-textarea" class="form-label">Resumo *</label>
    <textarea required class="form-control" id="resume" name="resume" rows="3"></textarea>
    </div>
    <div class="col-md-4 mb-3">
    <label for="confidencialidade" class="form-label">Divulgar no site da InPerson? *</label><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="confidencialidade" id="confidencialidade_sim" value="0">
        <label class="form-check-label" for="confidencialidade_sim">
            Sim
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="confidencialidade" id="confidencialidade_nao" value="2">
        <label class="form-check-label" for="confidencialidade_nao">
            Não
        </label>
    </div>
    </div>

    </div>
<div class="row mb-3">
    <div class="col-md-6 mb-3">
    <label for="example-textarea" class="form-label">Principais Atividades *</label>

    <div class="editor-container">
        <div id="toolbar-container2"></div>
        <div id="editor-container2"></div>
        <textarea class="form-control" id="activities" name="activities" rows="3"></textarea>
    </div>

    </div>
    <div class="col-md-6 mb-3">
    <label for="example-textarea" class="form-label">Requisitos *</label>
    <div class="editor-container">
        <div id="toolbar-container1"></div>
        <div id="editor-container1"></div>
        <textarea hidden required class="form-control" id="requeriments" name="requeriments" rows="3"></textarea>
    </div>


</div>
<div class="row mb-3">
    <div class="col-md-4 mb-3">
    <label for="example-select" class="form-label "  >Cargo | Departamento *</label>
                        <select required class="form-select select2" id="job" name="job" data-toggle="select2">
                           <option></option>
                           <?php foreach ($jobs as $job): ?>
                           <option required value=<?= $job['id_job'] ?>><?= $job['description'] ?> | <?= $job['departamento'] ?></option>
                           <?php endforeach; ?>
                        </select>
    </div>
    <div class="col-md-4 mb-3">
    <label for="example-textarea" class="form-label">Encerramento da Vaga *</label>
                           <input required type="datetime-local" id="expiration" name="expiration" class="form-control">
    </div>
    


</div>





<!-- Div para a barra de ferramentas -->

    
    <!-- Div para o editor -->


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

</div>
<script>
    // Função para atualizar o valor de faixa_salarial quando o usuário digitar algo em salarial
    document.getElementById('salarial').addEventListener('input', function() {
        var faixaSalarialInput = document.getElementById('faixa_salarial');
        var valorDigitado = parseFloat(this.value.replace(',', '.')); // Converte o valor digitado para float

        // Multiplica o valor digitado por 100 e formata com duas casas decimais
        faixaSalarialInput.value = (valorDigitado * 10); // Define o valor de faixa_salarial formatado
    });

    function updateCustomValue() {
        var salarioSelect = document.getElementById('salario');
        var salarialInput = document.getElementById('salarial');
        var faixaSalarialInput = document.getElementById('faixa_salarial');
        var divSalarial = document.getElementById('divsalarial');

        // Verifica se a opção selecionada é 'digitar'
        if (salarioSelect.value === 'digitar') {
            // Mostra o campo para digitar o valor personalizado
            divSalarial.style.display = 'block';
            salarialInput.style.display = 'block';

            // Esconde o campo de faixa salarial e limpa seu valor
            faixaSalarialInput.value = '';

            // Atualiza o valor de faixa_salarial com o valor de salarial multiplicado por 100
            var valorDigitado = 'R$ ' + salarialInput.value; // Converte o valor digitado para float
            faixaSalarialInput.value = valorDigitado;// Define o valor de faixa_salarial formatado
        } else {
            // Esconde o campo para digitar o valor personalizado
            divSalarial.style.display = 'none';
            salarialInput.style.display = 'none';
            salarialInput.value = '';

            // Mostra o campo de faixa salarial e atualiza seu valor
            faixaSalarialInput.style.display = 'block';
            faixaSalarialInput.value = salarioSelect.value; // Define o valor de faixa_salarial como o valor selecionado no select
        }
    }

    // Chamada inicial para garantir que o estado inicial esteja correto ao carregar a página
    updateCustomValue();
</script>




<script>
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.getElementById('salarial');

            input.addEventListener('input', function (e) {
                var value = e.target.value;
                value = value.replace(/\D/g, '');
                value = (value / 100).toFixed(2) + '';
                value = value.replace(".", ",");
                value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                e.target.value = value;
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

            // Initial formatting
            input.value = '0,00';
        });
    </script>






  







                           <div class="mb-3">
                           <p class="m-0"><label for="" class="form-label">Perguntas Alternativas </label> <i class="mdi mdi-help-box" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="Defina as perguntas mais importantes para a triagem, Exemplo: Você tem experiência em vendas por telefone?" title="Ajuda"></i></p>
                           <p class="mt-0"><small>Você pode adicionar até 3 Perguntas alternativas para essa vaga que serão respondida pelo candidato com Sim ou Não</small></p>
                           <div id="questions"></div>
        <button type="button" class="btn btn-info btn-sm" id="addQuestion">Adicionar Pergunta</button>
                           </div>

                           <div class="mb-3">
                           <p class="m-0"><label for="" class="form-label">Perguntas Dissertivas</label></p>
                           <p class="mt-0"><small>Você pode adicionar até 3 Perguntas disssertivas para essa vaga (texto livre para preenchimento do candidato)</small></p>
                           <div id="questionBlock"></div>
        <button type="button" class="btn btn-info btn-sm" id="addQuestionCustom">Adicionar Pergunta</button>
                           </div>






                        <div class="mb-3">
                          



                        </div>
                        <a href="<?= base_url('employees') ?>" class="btn btn-secundary">Cancelar</a>
<button type="submit" class="btn btn-primary">Adicionar Vaga</button>

                           </form>
</div>



</div>







                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <script>
        document.getElementById('addQuestionCustom').addEventListener('click', function() {
            var questionBlock = document.getElementById('questionBlock');
            var questionBlocks = questionBlock.querySelectorAll('.question-group');

            // Verifica se já existem 2 blocos de perguntas
            if (questionBlocks.length >= 2) {
                alert('Você já adicionou o máximo de 2 blocos de perguntas.');
                return;
            }

            // Cria um novo bloco de perguntas
            var nextBlockNumber = questionBlocks.length + 1;
            var questionGroup = document.createElement('div');
            questionGroup.classList.add('question-group', 'mb-3');

            // Cria uma label para o bloco de perguntas
            var label = document.createElement('label');
            label.textContent = 'Pergunta Discertativa' + nextBlockNumber;
            questionGroup.appendChild(label);

            // Cria um novo campo de texto (textarea) para a pergunta
            var textarea = document.createElement('textarea');
            textarea.name = 'q' + (nextBlockNumber + 3); // Começa com q4 e vai até q5
            textarea.placeholder = 'Digite sua pergunta aqui...';
            textarea.classList.add('form-control');
            questionGroup.appendChild(textarea);

            // Adiciona o botão de remoção ao bloco de perguntas
            var removeButton = document.createElement('span');
            removeButton.textContent = 'Remover Pergunta';
            removeButton.classList.add('remove-button');
            removeButton.addEventListener('click', function() {
                questionBlock.removeChild(questionGroup);
                // Mostra o botão "Adicionar" se o número de blocos de perguntas for menor que 2
                if (questionBlocks.length < 2) {
                    document.getElementById('addQuestionCustom').style.display = 'block';
                }
            });
            questionGroup.appendChild(removeButton);

            // Adiciona o bloco de perguntas ao elemento 'questionBlock'
            questionBlock.appendChild(questionGroup);

            // Oculta o botão "Adicionar" se já existirem 2 blocos de perguntas
            if (questionBlocks.length === 1) {
                document.getElementById('addQuestionCustom').style.display = 'none';
            }
        });
    </script>
    <script>
        document.getElementById('addQuestion').addEventListener('click', function() {
            var questionsContainer = document.getElementById('questions');
            var questionInputs = questionsContainer.querySelectorAll('input[name^="q"]');

            // Verifica se já existem 3 questões
            if (questionInputs.length >= 3) {
                alert('Você já adicionou o máximo de 3 questões.');
                return;
            }

            // Cria um novo grupo de entrada
            var nextQuestionNumber = questionInputs.length + 1;
            var inputGroup = document.createElement('div');
            inputGroup.classList.add('mb-3');

            // Cria uma label para a pergunta alternativa
            var label = document.createElement('label');
            label.textContent = 'Pergunta Alternativa ' + nextQuestionNumber;
            inputGroup.appendChild(label);

            // Cria um novo campo de entrada
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'q' + nextQuestionNumber;
            input.id = 'q' + nextQuestionNumber;
            input.placeholder = 'Questão ' + nextQuestionNumber;
            input.classList.add('form-control');

            // Adiciona o novo campo de entrada ao grupo de entrada
            inputGroup.appendChild(input);

            // Adiciona o botão de remoção ao grupo de entrada
            var removeButton = document.createElement('span');
            removeButton.textContent = 'Remover Pergunta';
            removeButton.classList.add('remove-button');
            removeButton.addEventListener('click', function() {
                questionsContainer.removeChild(inputGroup);
                // Mostra o botão "Adicionar" se o número de questões for menor que 3
                if (questionInputs.length < 3) {
                    document.getElementById('addQuestion').style.display = 'block';
                }
            });
            inputGroup.appendChild(removeButton);

            // Adiciona o grupo de entrada ao elemento 'questions'
            questionsContainer.appendChild(inputGroup);

            // Oculta o botão "Adicionar" se já existirem 3 questões
            if (questionInputs.length === 2) {
                document.getElementById('addQuestion').style.display = 'none';
            }
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
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/"
        }
    }
</script>

<?= $this->endSection() ?>
