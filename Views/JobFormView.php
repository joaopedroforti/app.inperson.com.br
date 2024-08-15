<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<style>

.adjective_select {
    display: none;
}

.inperson_logo {
    width: 30%;
}



.adjective_name {
    cursor: pointer;
    margin: auto;
}

.btn_adjective,
.btn_adjective:hover,
.btn_adjective_active {
    margin: 10px;
    padding: 10px;
    cursor: pointer;
    border-style: solid;
    border-color: #E7E7E7;
    border-radius: 20px;
    text-align: center; /* Adiciona centralização do texto */
        display: flex; /* Adiciona flex container */
        align-items: center; /* Centraliza verticalmente */
        justify-content: center; /* Centraliza horizontalmente */
}

.btn_adjective {
    background-color: #F1F1F1;
    color: gray;
}

.btn_adjective:hover {
    background-color: #508dfd;
    color: white;
}

.btn_adjective_active {
    background-color: #508dfd;
    color: white;
}

</style>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Cargos</a></li>
                     <li class="breadcrumb-item active">Novo Cargo</li>
                  </ol>
               </div>
               <h4 class="page-title">Novo Cargo</h4>
               <div class="container">
                  <div id="div-container" class="row">
                     <div id="div1" class="col-12">
                     <form action="<?= base_url('jobroles/new/questionarie') ?>" method="post">

                        <h1>Atenção!</h1>
                        <p>Ao avançar, você será direcionado á criação de Cargo. Responda as perguntas considerando o nível hierárquico do cargo e as atividades gerais que serão exercidas pelo profissional. Seja o mais realista possível. Lembre-se de que um profissional de nível Júnior, não terá as mesmas responsabilidades que um profissional de nível Sênior.</p>
                        <input name="id" id="id" value="<?= $id_job ?>" hidden>  
       <input name="reference" id="reference" value="<?= $reference ?>" hidden>  
                    </div>
                     <div id="div3" class="col-12 d-none">
                     <div class="container text-center" style="width: 70%;">
        <!-- Div principal com largura de 70% e centralizada horizontalmente -->

        <?php foreach ($questions as $question): ?>
            <div class="row mb-5">
                <!-- Linha com margem inferior de 5 pixels -->
                <div class="col-md-12">
                    <div class="row">
                        <!-- Pergunta -->
                        <div class="col-md-12 mb-2">
                            <p><?= $question->question ?></p><br>
                        </div>
                        <!-- Input range -->
                        <div class="col-md-12">
                            <div class="position-relative">
                                <!-- Legenda -->
                                <div class="d-flex justify-content-between position-absolute w-100" style="top: -30px;">
                                    <span class="text-muted">Discordo Totalmente</span>
                                    <span class="text-muted">Discordo</span>
                                    <span class="text-muted">Neutro</span>
                                    <span class="text-muted">Concordo</span>
                                    <span class="text-muted">Concordo Totalmente</span>
                                </div>
                                <input style="width: 84%;" type="range" name="<?= $question->classification ?>" min="1" max="5" step="1" value="0" class="form-range">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
                     </div>
                     <div id="div4" class="col-12 d-none">
    <div class="container text-center" style="width: 70%;">
        <!-- Div principal com largura de 70% e centralizada horizontalmente -->

        <?php foreach ($questions2 as $question2): ?>
            <div class="row mb-5">
                <!-- Linha com margem inferior de 5 pixels -->
                <div class="col-md-12">
                    <div class="row">
                        <!-- Pergunta -->
                        <div class="col-md-12 mb-2">
                            <p><?= $question2->question ?></p><br>
                        </div>
                        <!-- Input range -->
                        <div class="col-md-12">
                            <div class="position-relative">
                                <!-- Legenda -->
                                <div class="d-flex justify-content-between position-absolute w-100" style="top: -30px;">
                                    <span class="text-muted">Discordo Totalmente</span>
                                    <span class="text-muted">Discordo</span>
                                    <span class="text-muted">Neutro</span>
                                    <span class="text-muted">Concordo</span>
                                    <span class="text-muted">Concordo Totalmente</span>
                                </div>
                                <input style="width: 84%;" type="range" name="<?= $question2->classification ?>" min="1" max="5" step="1" value="0" class="form-range">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
                     <div id="div5" class="col-12 d-none">

<div class="row">
   
                     <?php foreach ($adjectives as $adjective): ?>
                     <div class="col-md-auto btn_adjective" id="adjective_<?= $adjective->id_adjective ?>" onclick="toggleAdjective('adjective_<?= $adjective->id_adjective ?>', event)">
                        <input type='checkbox' class="adjective_select" name="adjectives[]" value="<?= $adjective->id_adjective ?>" id="<?= $adjective->id_adjective ?>">
                        <label class="adjective_name"><?= $adjective->description ?></label>
                    </div>

                    <?php endforeach; ?>
                     </div>
                     <div class="container d-flex justify-content-between align-items-end">
                     <button type="submit" id="" class="btn btn-primary mt-3">Finalizar</button>
                     </div>
                     </div>



                     
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>

<div class="container d-flex justify-content-between align-items-end">
   <button type="button" id="btn-avancar" class="btn btn-primary mt-3">Avançar</button>
</div>


<!-- Warning Header Modal -->

<div id="incomplete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-warning">
                <h4 class="modal-title" id="warning-header-modalLabel">Atenção!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                Para prosseguir com a criação de um novo cargo, você precisa preencher todos os campos do formulario.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning "data-bs-dismiss="modal">Continuar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Danger Header Modal -->

<script>
   const divs = document.querySelectorAll("#div-container .col-12");
   const btnAvancar = document.querySelector("#btn-avancar");
   let currentDivIndex = 0;
   
   // Função para validar os campos na div atual
   function validarCampos() {
       const campos = divs[currentDivIndex].querySelectorAll('input[required], select[required], textarea[required]');
       for (let campo of campos) {
           if (!campo.value) {
               return false; // Se algum campo estiver vazio, retorna falso
           }
       }
       // Verificar se há pelo menos uma opção selecionada para cada grupo de radio
       const gruposRadio = divs[currentDivIndex].querySelectorAll('input[type="radio"]');
       for (let grupo of gruposRadio) {
           const opcoesSelecionadas = divs[currentDivIndex].querySelectorAll(`input[type="radio"][name="${grupo.name}"]:checked`);
           if (opcoesSelecionadas.length === 0) {
               return false; // Se não houver opção selecionada para algum grupo de radio, retorna falso
           }
       }
       return true; // Retorna verdadeiro se todos os campos estiverem preenchidos
   }
   
   btnAvancar.addEventListener("click", () => {
       // Validar campos antes de avançar
       window.scrollTo(0, 0);
       if (validarCampos()) {
           if (currentDivIndex < divs.length - 1) {
               divs[currentDivIndex].classList.add("d-none");
               currentDivIndex++;
               divs[currentDivIndex].classList.remove("d-none");
               if(currentDivIndex === divs.length - 1){

                   btnAvancar.style.display = "none"; // Oculta o botão na última div
               }
           } else {
               // Alterar texto do botão para "Finalizar"
  
           }
       } else {
    $('#incomplete').modal('show'); // Abre o modal "incomplete"
}
   });

   // Selecionar o terceiro select em todas as divs
   const selects = document.querySelectorAll("#div-container select");
   selects.forEach(select => {
       if (select.id !== 'department') {
           select.value = '3'; // Seleciona a opção com value '3'
       }
   });
</script>
<script>
    function validarCheckbox() {
        var checkboxes = document.querySelectorAll('.adjective_select:checked');
        if (checkboxes.length < 10) {
            Swal.fire({
                icon: 'error',

                text: 'Por favor, selecione no minímo 10 adjetivos.'
            });
            return false;
        }
        return true;
    }
</script>
<script>
    function toggleAdjective(elementId, event) {
        // Adiciona a classe 'btn_adjective_active' à div clicada
        var element = document.getElementById(elementId);
        element.classList.toggle('btn_adjective_active');

        // Encontra a checkbox correspondente
        var checkbox = element.querySelector('.adjective_select');

        // Inverte o estado atual da checkbox
        checkbox.checked = !checkbox.checked;

        // Impede que o evento de clique se propague para a hierarquia do DOM
        event.stopPropagation();
    }
</script>

<?= $this->endSection() ?>
