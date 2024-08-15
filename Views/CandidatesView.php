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
                  <li class="breadcrumb-item"><a href="<?= base_url('recruitment/candidates') ?>">Candidatos</a></li>
                  <li class="breadcrumb-item active">Listar</li>
               </ol>
            </div>
            <h4 class="page-title">Candidatos</h4>
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
    <select id="favorite" name="favorite" class="form-select">
        <option value="0" <?php echo $favorite == 0 ? 'selected' : ''; ?>>Exibindo Todos</option>
        <option value="1" <?php echo $favorite == 1 ? 'selected' : ''; ?>>Somente Favoritos</option>
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
                     <!--<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Status <span class="caret"></span> </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Ativos</a>
                            <a class="dropdown-item" href="#">Inativos</a>
                            <a class="dropdown-item" href="#">Todos</a>
                        </div>
                        </div>-->
                  
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
               <?php if (!empty($candidates)) : ?>
               <table class="table table-striped table-centered mb-0 table-sm">
                  <thead>
                     <tr>
                        <th></th>
                     <th>Candidato</th>
                        <th>Data de Inscrição</th>
                        <th></th>
                  </thead>
                  <tbody>
                     <?php foreach ($candidates as $candidate) : ?>
                     <tr>
   <td><div class="mdi mdi-tag"  id="star-<?php echo $candidate['reference']; ?>" data-reference="<?php echo $candidate['reference']; ?>" style="font-size: 1.5rem; cursor: pointer; color: <?php echo $candidate['favorite'] == 1 ? '#74d46f' : '#ACACAC'; ?>; cursor: pointer;"></div></td>
                     <td style="white-space: nowrap;">
    <div class="row">

        <div class="col">
            <?php if ($candidate['avatar'] == 1): ?>
                <img src="<?= base_url('assets/images/userimages/' . $candidate['reference'] . '.jpg') ?>" alt="table-user" class="list-user-img rounded-circle" style="width: 40px; height: 40px;"> 
            <?php else: ?>
                <img src="<?= base_url('assets/images/userimages/default.jpg') ?>" alt="table-user" class="list-user-img rounded-circle" style="width: 40px; height: 40px;">
            <?php endif; ?>
            <a href="<?= base_url('candidato/' . $candidate['reference']) ?>" class="text-decoration-none"><?= esc($candidate['full_name']) ?></a>

        </div>
    </div>
</td>
                           <td><?= date('d/m/Y', strtotime($candidate['registration_date'])) ?></td>
                           <td>
                        <a href="<?= base_url('candidato/' . $candidate['reference']) ?>"><i class="mdi mdi-account-eye" style="font-size: 25px"></i></a></td>
                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
               <br>
               <?= esc($totalRows) ?> Candidatos encontrados
<br>
               <?php else : ?>
               <p>Nenhum resultado encontrado.</p>
               <?php endif; ?>
               <br>
               <?= $pager->links('candidate', 'custom_pagination'); ?>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.mdi-star').forEach(function(star) {
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
                    element.style.color = data.favorite == 1 ? '#D0D46F' : '#ACACAC';
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
<?= $this->endSection() ?>