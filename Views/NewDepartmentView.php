<!-- app/Views/home.php -->
<?= $this->extend('layouts/master') ?>
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
                               <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"><a href="javascript: void(0);">Departamentos</a></li>
                                 <li class="breadcrumb-item active">Adicionar</li>
                               </ol>
                            </div>
                            <h4 class="page-title">Novo Departamento</h4>

<div>
<div class=row>
<div class="col-lg-6">
<div class="mb-3">

<form action="" method="POST">
                           <label for="example-palaceholder" class="form-label">Nome do Departamento</label>
                           <input required required type="text" id="description" name="description" class="form-control">

                        </div>
                        <div class="mb-3">
                        <label for="example-select" class="form-label">Responsável</label>
                        <select required class="form-select" id="manager" name="manager">
                           <option></option>
                           <?php foreach ($persons as $person): ?>
                           <option required value=<?= $person['id_person'] ?>><?= $person['name'] ?></option>
                           <?php endforeach; ?>
                        </select>
                           </div>

                        <a href="<?= base_url('department') ?>" class="btn btn-secundary">Cancelar</a>
<button type="submit" class="btn btn-primary">Adicionar Departamento</button>

                           </form>
</div>



</div>







                        </div>
                    </div>
                </div>
            </div> 
        </div>

   

<?= $this->endSection() ?>
