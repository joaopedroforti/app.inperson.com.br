<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<style>
   .daterangepicker {
   z-index: 90000;
   }
   .list-user-img{
   width: 50px;
   height: 50px;
   margin-right: 10px;
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
                  <li class="breadcrumb-item"><a href="<?= base_url('employees')?>">Colaboradores</a></li>
                  <li class="breadcrumb-item active">Listar</li>
               </ol>
            </div>
            <h4 class="page-title">Colaboradores</h4>
            <!-- Start Filter -->
            <br><br>
            <div class="row">
               <div class="col-3">
                  <!-- Conteúdo da primeira coluna alinhado à esquerda -->
                  <div class="app-search dropdown d-none d-lg-block">
                     <form method="GET">
                        <div class="input-group">
                           <input type="text" class="form-control dropdown-toggle" placeholder="Procurar..." id="top-search" name="search">
                           <span class="mdi mdi-magnify search-icon"></span>
                           <button class="input-group-text btn-primary" type="submit">Procurar</button>
                        </div>
                     </form>
                  </div>
</div>

                  <div class="col-2">
         
                  <select required class="form-select" id="Status" name="Status" onchange="filterEmployees()">
    <option  value="3">Exibindo todos</option>
    <option selected value="1">Ativos</option>
    <option value="0">Inativos</option>
</select>

                   </div>
              



               <div class="col text-end">
               <a ><button type="button" class="btn btn-primary copy-link" data-link="https://questionaries.inperson.com.br?questionarie=<?=esc($companyreference) ?>">Copiar Link de Mapeamento</button></a>
               <a href="<?= base_url('/employees/new') ?>"> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cademployee">Adicionar Colaborador</button></a>
</div>
         
                  
                  </div>
               </div>
               <br><br><br><br>
               <!-- End Filter -->
               <?php if(session()->has('alert')): ?>
               <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <?= session('alert') ?>
               </div>
               <?php endif; ?>
               <?php if (!empty($employees)) : ?>
               <table class="table table-striped table-centered mb-0 table-sms">
                  <thead>
                     <tr>
                        <th></th>
                        <th>Colaborador</th>
                        <th>Perfil Comportamental</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                        <th></th>
                  </thead>
                  <tbody id="employeeTable">
        <?php foreach ($employees as $employee) : ?>
        <tr id="employeeRow<?= $employee['reference'] ?>" <?php if ($employee['active'] == 0) echo 'style="display:none;"' ?>>
            <td>
                <p class="text-muted mb-1 font-13">
                    <?php if ($employee['active'] == 1): ?>
                    <span class="badge bg-success">Ativo</span>
                    <?php else: ?>
                    <span class="badge bg-light text-dark">Inativo</span>
                    <?php endif; ?>
                </p>
            </td>
            <td>
                <a href="<?= base_url('employee/view/' . $employee['reference']) ?>">
                    <p>
                        <?php if ($employee['avatar'] == 1): ?>
                        <img src="<?= base_url('assets/images/userimages/' . $employee['reference'] . '.jpg') ?>" alt="table-user" class="list-user-img rounded-circle">
                        <?php else: ?>
                        <img src="<?= base_url('assets/images/userimages/default.jpg') ?>" alt="table-user" class="list-user-img rounded-circle">
                        <?php endif; ?>
                        <?= esc($employee['full_name']) ?>
                    </p>
                </a>
            </td>
            <td><?= esc($employee['behavioral_profile']) ?></td>
            <td><?= esc($employee['department']) ?></td>
            <td><?= esc($employee['job_title']) ?></td>
            <td>
                <a href="<?= base_url('employee/view/' . $employee['reference']) ?>"><i class="mdi mdi-account-eye" style="font-size: 25px"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
               </table>

               <br>
<?= $registros ?> Colaboradores Encontrados
               <br>
               <?php else : ?>
               <p>Nenhum resultado encontrado.</p>
               <?php endif; ?>
               <br>
               <?= $pager->links('employee', 'custom_pagination'); ?>
               <br>
               <br>

            </div>
         </div>
      </div>
      <!-- end page title --> 
   </div>
   <!-- container -->
</div>
<!-- content -->
<!-- bundle -->

<!-- Success Alert Modal -->
<div id="copyLinkModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-warning">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-checkmark h1"></i>
                    <h4 class="mt-2">Link Copiado!</h4>
                    <p class="mt-3">Atenção!! Esse link deve ser compartilhado apenas com colaboradores da empresa!</p>
                    <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continuar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    function filterEmployees() {
        var status = document.getElementById('Status').value;
        var rows = document.querySelectorAll('[id^="employeeRow"]');
        
        rows.forEach(function(row) {
            var badge = row.querySelector('.badge');
            if (status == 3 || (status == 1 && badge.classList.contains('bg-success')) || (status == 0 && badge.classList.contains('bg-light'))) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>



<script>
    document.querySelectorAll('.copy-link').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault(); // Evita que o link seja seguido imediatamente

            const link = item.getAttribute('data-link'); // Obtém o link a ser copiado

            // Cria um elemento de texto temporário para copiar o link
            const tempInput = document.createElement('input');
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            // Exibe um alerta ou outra mensagem para indicar que o link foi copiado
            $('#copyLinkModal').modal('show'); // Exibe o modal ao copiar o link
        });
    });
</script>
<?= $this->endSection() ?>