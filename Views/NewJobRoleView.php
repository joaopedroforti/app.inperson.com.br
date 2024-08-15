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
                  <div class="row">
                     <div class="col-12">
                     <form action"" method="post">
                        <div class="mb-3">
                           <label for="example-palaceholder" class="form-label">Nome do Cargo</label>
                           <input required type="text" id="description" name="description" class="form-control">
                        </div>
                        <div class="mb-3">
                        <label for="seniority" class="form-label">Senioridade</label>
    <select required class="form-select" id="senioridade" name="senioridade">
    <option value=""></option>
    <option value="Trainee">Trainee</option>
<option value="Estagiário">Estagiário</option>
<option value="Júnior">Júnior</option>
<option value="Pleno">Pleno</option>
<option value="Sênior">Sênior</option>
<option value="Especialista">Especialista</option>

    </select>
                           </div>
                        <div class="mb-3">
                           <label for="example-textarea" class="form-label">Descrição do Cargo</label>
                           <textarea  class="form-control" id="long_description" name="long_description" rows="5"></textarea>
                        </div>
                        <label for="example-select" class="form-label">Departamento</label>
                        <select required class="form-select" id="department" name="department">
                           <option></option>
                           <?php foreach ($departments as $department): ?>
                           <option required value=<?= $department['id_department'] ?>><?= $department['description'] ?></option>
                           <?php endforeach; ?>
                        </select>
                           
                     </div>
                    </div>
                </div>
            </div>
    </div>
</div>
                  


<div class="container d-flex justify-content-between align-items-end">
   <button type="submit"  id="btn-avancar" class="btn btn-primary mt-3">Avançar</button>
</div>

</form>
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


<?= $this->endSection() ?>
