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
                  <li class="breadcrumb-item"><a href="<?= base_url('recruitment/vacancies') ?>">Vagas</a></li>
                  <li class="breadcrumb-item active">Listar</li>
               </ol>
            </div>
            <h4 class="page-title">Vagas</h4>
            <!-- Start Filter -->
            <br><br>
            <div class="row">
               <div class="col-3">
                  <!-- Conteúdo da primeira coluna alinhado à esquerda -->
                  <div class="app-search dropdown d-none d-lg-block">
                     <form method="GET">
                        <div class="input-group">
                           <input type="text" class="form-control dropdown-toggle" placeholder="Procurar..." id="top-search" name="search" value="<?php echo $search?>">
                           <span class="mdi mdi-magnify search-icon"></span>
                           
                        </div>



                      
                  </div>
               </div>
               <div class="col-3">
               <div class="input-group">
    <select id="active" name="active" class="form-select">
         <option value="">Todas as vagas</option>
        <option value="1">Ativas</option>
        <option value="2">Inativas</option>
    </select>
</div>
</div>
<div class="col-3">

<button class="input-group-text btn-primary" type="submit">Filtrar</button>
                     </form>
</div>
               <div class="col">
                  <!-- Conteúdo da segunda coluna alinhado à direita -->
                  <div class="text-end">
                  <a href="<?= base_url('/recruitment/vacancies/new') ?>"> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cademployee">Adicionar Vaga</button></a>
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
               <?php if (!empty($vacancies)) : ?>
               <table class="table table-striped table-centered mb-0">
                  <thead>
                     <tr>
                        <th>Nome da Vaga</th>
                        <th>Cargo</th>
                        <th>Encerra em:</th>
                        <th>Status</th>
                        <th></th>
                  </thead>
                  <tbody>


                  <?php foreach ($vacancies as $vacancie) : ?>
    <tr class="linharegistro" id="<?= $vacancie['id_vacancie'] ?>" status="<?= $vacancie['status'] ?>">
        <td>
            <p><b><?= esc($vacancie['description']) ?>  <?= esc($vacancie['seniority']) ?></b></p>
        </td>
        <td><?= esc($vacancie['job_description']) ?></td>
        <td><?= esc(date('d/m/Y H:i', strtotime($vacancie['expiration_date']))) ?></td>
        <td>
            <?php if ($vacancie['status'] == 1) : ?>
                <span class="badge badge-success-lighten">Ativa</span>
            <?php else : ?>
                <span class="badge badge-danger-lighten">Encerrada</span>
            <?php endif; ?>
            <?php if ($vacancie['confidential'] == 1) : ?>
               <span class="mdi mdi-lock search-icon"></span> Confidencial
            <?php else : ?>
               <span class="mdi mdi-access-point-network search-icon"></span> Pública
            <?php endif; ?>
        </td>
       
        <td>
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ação</button>
            <div class="dropdown-menu">
                <?php if ($vacancie['status'] == 1) : ?>
                    <a class="dropdown-item" href="<?= base_url('/vacancie/status/' . esc($vacancie['id_vacancie'])) ?>">Inativar</a>
                <?php else : ?>
                    <a class="dropdown-item" href="<?= base_url('/vacancie/status/' . esc($vacancie['id_vacancie'])) ?>">Ativar</a>
                <?php endif; ?>
                <a class="dropdown-item copy-link" href="#" data-link="https://vagas.inperson.com.br/vaga/<?= esc($vacancie['reference']) ?>">Copiar Link da vaga</a>
                <a class="dropdown-item copy-link" href="#" data-link="https://questionaries.inperson.com.br?questionarie=<?= esc($vacancie['reference']) ?>">Copiar Link teste de perfil</a>
                <a class="dropdown-item" href="<?= base_url('/vaga/' . esc($vacancie['reference'])) ?>">Editar</a>
            </div>
        </td>
    </tr>
<?php endforeach; ?>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectElement = document.getElementById('active');
        const rows = document.querySelectorAll('.linharegistro');
        const totalRowsDisplay = document.getElementById('totalRowsDisplay');

        selectElement.addEventListener('change', function() {
            const selectedValue = this.value;
            let totalRows = 0;

            rows.forEach(row => {
                const status = parseInt(row.getAttribute('status'));

                if (selectedValue === '') {
                    row.style.display = 'table-row';
                    totalRows++;
                } else if (selectedValue === '1' && status === 1) {
                    row.style.display = 'table-row';
                    totalRows++;
                } else if (selectedValue === '2' && status !== 1) {
                    row.style.display = 'table-row';
                    totalRows++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Atualiza o texto com o total de vagas encontradas
            totalRowsDisplay.textContent = `${totalRows} `;
        });

        // Contagem inicial de linhas visíveis ao carregar a página
        let initialTotalRows = 0;
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                initialTotalRows++;
            }
        });
        totalRowsDisplay.textContent = `${initialTotalRows} `;
    });
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




<!-- Success Alert Modal -->
<div id="copyLinkModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-success">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-checkmark h1"></i>
                    <h4 class="mt-2">Link Copiado!</h4>
                    <p class="mt-3">Para compartilhar a vaga, basta enviar o link que você acabou de copiar!</p>
                    <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continuar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>





                  </tbody>
               </table>
               <br>
               <p><span id="totalRowsDisplay"></span>Vagas encontradas</p>

<br>
               <?php else : ?>
               <p>Nenhum resultado encontrado.</p>
               <?php endif; ?>
               <br>
               <?= $pager->links('vacancies', 'custom_pagination'); ?>
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
<?= $this->endSection() ?>