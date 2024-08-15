<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>
<!-- Adicione esta linha no cabeçalho do seu HTML -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?= base_url('assets/js/vendor/dropzone.min.js') ?>"></script>
<!-- init js -->
<script src="<?= base_url('assets/js/assets/js/ui/component.fileupload.js') ?>"></script>
<?= $this->section('content') ?>
<style>
   .daterangepicker {
   z-index: 90000;
   }

    
</style>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <br>
                  <ol class="breadcrumb m-0">
                     <br>
                     <li class="breadcrumb-item"><a href="<?= base_url('employees') ?>">Colaboradores</a></li>
                     <li class="breadcrumb-item active">Novo Colaborador</li>
                  </ol>
               </div>
               <br><br>
               <div class="card-body">
                  <h4 class="header-title">Novo Colaborador</h4>
                  <p class="text-muted font-14">
                     
                  </p>
                  <br>
                  <form action="" method="POST">
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="mb-3">
                              <label for="name" class="form-label">Nome Completo *</label>
                              <input required type="text" id="name" name="name" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-2">
                        <div class="mb-3">
        <label for="document" class="form-label">Documento(CPF) *</label>
        <input required type="text" id="document" name="document" class="form-control" data-toggle="input-mask" data-mask-format="000.000.000-00">
    </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="mb-3">
                              <label class="form-label">Data de Nascimento *</label>
                              <input required type="date" class="form-control" id="birth" name="birth">
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="mb-3">
                              <label class="form-label">Sexo *</label>
                              <select required class="form-select" id="gender" name="gender">
                                 <option>Selecionar</option>
                                 <?php foreach ($genders as $gender): ?>
                                 <option value="<?= $gender['id_gender'] ?>"><?= $gender['description'] ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="mb-3">
                              <label class="form-label">Estado Civil *</label>
                              <select required class="form-select" id="marital" name="marital">
                                 <option>Selecionar</option>
                                 <?php foreach ($maritals as $marital): ?>
                                 <option value="<?= $marital['id_marital'] ?>"><?= $marital['description'] ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                     </div>
                     <!-- Divisor -->
                     <p class="text-muted font-14">Contato</p>
                     <hr class="my-2">
                     <!-- Divisor -->
                     <div class="row">
                        <div class="col-sm-3">
                           <div class="mb-3">
                              <label for="mail" class="form-label">Email Corporativo</label>
                              <input type="mail" id="mail" name="mail" class="form-control">
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="mb-3">
                              <label for="personalmail" class="form-label">Email Pessoal *</label>
                              <input required type="mail" id="personalmail" name="personalmail" class="form-control">
                           </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="mb-3">
        <label for="phone" class="form-label">Telefone Pessoal *</label>
        <input required type="text" id="phone" name="phone" class="form-control" data-toggle="input-mask" data-mask-format="(00) 00000-0000">
    </div>
                        </div>
                     </div>
                     <!-- Divisor -->
                     <p class="text-muted font-14">Cargo e Formação</p>
                     <hr class="my-2">
                     <!-- Divisor -->
                     <div class="row">
                        <div class="col-sm-3">
                           <div class="mb-3">
                              <label for="mail" class="form-label">Area de Formação</label>
                              <input type="text" id="course" name="course" class="form-control">
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="mb-3">
                              <label for="example-select" class="form-label">Escolaridade</label>
                              <select required class="form-select" id="education" name="education">
                                 <option>Selecionar</option>
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
<input hidden type="text" id="department_name" name="department_name" readonly value="">
<div class="col-sm-3">
    <div class="mb-3">
        <label for="department_select" class="form-label">Departamento *</label>
        <select required class="form-select" id="department_select" name="department_select">
            <option></option>
            <?php foreach ($uniqueDepartments as $departmentId => $departmentDescription): ?>
                <option value="<?= $departmentId ?>"><?= $departmentDescription ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="col-sm-3">
    <div class="mb-3">
        <label for="job" class="form-label">Cargo *</label>
        <select required class="form-select" id="job" name="job">
        <option></option>
        <option value="">Selecione uma função</option>
        </select>
    </div>
</div>


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
                        </div>
                        <div class="col-sm-3">
                           <div class="mb-3">
                              <label for="example-select" class="form-label">Tipo de Contrato *</label>
                              <select required class="form-select" id="contract_type" name="contract_type">
                                       <option>Selecionar</option>
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
                     <!-- Divisor -->
                     <p class="text-muted font-14">Endereço</p>
                     <hr class="my-2">
                     <!-- Divisor -->
                     <div class="row">
                        <div class="col-sm-3">
                           <div class="mb-1">
                              <label for="phone" class="form-label">CEP *</label>
                              <input required type="text" id="adress_cep" name="adress_cep" class="form-control">
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="mb-3">
                              <label for="phone" class="form-label">Endereço *</label>
                              <input type="text" id="adress" name="adress" class="form-control">
                           </div>
                        </div>
                        <div class="col-sm-1">
                           <div class="mb-3">
                              <label for="phone" class="form-label">Número *</label>
                              <input required type="text" id="adress_number" name="adress_number" class="form-control">
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="mb-3">
                              <label for="phone" class="form-label">Bairro *</label>
                              <input type="text" id="adress_district" name="adress_district" class="form-control">
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="mb-3">
                              <label for="phone" class="form-label">Cidade *</label>
                              <input readonly type="text" id="adress_city" name="adress_city" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                     <div class="col-sm-3">
                           <div class="mb-3">
                              <label for="complemento" class="form-label">Complemento</label>
                              <input type="text" id="" name="" class="form-control">
                           </div>
                        </div>

                        <div class="col-sm-2">
                           <div class="mb-3">
                              <label class="form-label">Data de Admissão *</label>
                              <input required type="date" class="form-control date" id="admission" name="admission">
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
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
<br>
<a href="<?= base_url('employees') ?>" class="btn btn-secundary">Cancelar</a>
<button type="submit" class="btn btn-primary">Adicionar Colaborador</button>
</div>
</div>
</div>
</form>
<script>
   document.addEventListener('DOMContentLoaded', function () {
       document.getElementById('adress_cep').addEventListener('blur', function () {
           var cep = this.value.replace(/\D/g, '');
   
           if (cep != "") {
               var xhr = new XMLHttpRequest();
               var url = "https://viacep.com.br/ws/" + cep + "/json/";
   
               xhr.open("GET", url, true);
               xhr.onreadystatechange = function () {
                   if (xhr.readyState == 4 && xhr.status == 200) {
                       var data = JSON.parse(xhr.responseText);
                       if (!data.hasOwnProperty('erro')) {
                           document.getElementById('adress').value = data.logradouro;
                           document.getElementById('adress_district').value = data.bairro;
                           document.getElementById('adress_city').value = data.localidade;
                       } else {
                           
                       }
                   }
               };
               xhr.send();
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
<?= $this->endSection() ?>