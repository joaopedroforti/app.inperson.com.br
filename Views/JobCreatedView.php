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
              
               <div class="container">
               <h4 class="page-title">Cargo Criado com Sucesso!</h4>
                  <div class="row">
                     <div class="col-3">
                     <a href="<?= base_url('jobroles/questionarie/') ?><?= $reference ?>"><button type="submit"  id="btn-avancar" class="btn btn-primary mt-3">Preencher Teste de perfil agora</button></a>
                    </div>
                    <div class="col-3">
                     <a href="<?= base_url('jobroles') ?>"><button type="submit"  id="btn-avancar" class="btn btn-secondary mt-3">Preencher Depois</button></a>
                    </div>
                </div>
            </div>
    </div>
</div>
                  




<?= $this->endSection() ?>
