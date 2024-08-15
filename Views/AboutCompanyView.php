<!-- app/Views/home.php -->



<?= $this->extend('layouts/master') ?>
<!--<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>-->
<?= $this->section('content') ?>
<style>
           .invalid-phone {
            border-color: red;
        }
        .valid-phone {
            border-color: green;
        }
.preview-logo{
   width: 150px;
   max-height: 150px;
   background-color: #FBFBFB;
   padding: 5px;
}
.preview-mobile{
   max-width: 150px;
   max-height: 150px;
   background-color: <?= esc($company['primary_color']) ?>;
   padding: 5px;
}
.preview-desktop{
   width: 200px;
   max-height: 150px;
   background-color: <?= esc($company['primary_color']) ?>;
   padding: 5px;
   max-wo
}
.slugfeedback{
    margin-top: 10px;
    font-weight: 300;
    font-size: 14px;

}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="content">
   <!-- Start Content-->
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Empresa</a></li>
                     <li class="breadcrumb-item active">Ver</li>
                  </ol>
               </div>
               <h4 class="page-title">Cadastro da Empresa</h4>
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
                  <h4 class="mb-0 mt-2"><?= esc($company['company_name']) ?></h4>
                 
                  <p class="font-14">Administrador: <?= esc($company['manager_name']) ?></p>
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
                        Cadastro
                        </a></li>
                        <li class="nav-item">
                        <a href="#vagas" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                        Página de Vagas




                        
                        </a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <!-- end tab-pane -->

                     <!-- end tab-pane -->
                     <!-- end about me section content -->
                    

                     <div class="tab-pane show active" id="settings">
                        <form action="/dados/company" method="POST">

                           <div class="row">
                              <div class="col-md-4">
                                 <div class="mb-3">
                                 <input hidden  type="text" id="id_company" name="id_company" class="form-control" value="<?= esc($company['id_company']) ?>">
                                    <label for="company_name" class="form-label">Razão Social *</label>
                                    <input required type="text" id="company_name" name="company_name" class="form-control" value="<?= esc($company['company_name']) ?>">
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="document_number" class="form-label">CNPJ *</label>
                                    <input required type="text" id="document_number" name="document_number" class="form-control" data-toggle="input-mask" data-mask-format="99.999.999/9999-99" value="<?= esc($company['document_number']) ?>">
                                 </div>
                              </div>

                              <div class="col-md-4 d-none">
                              <div class="mb-3">
                                    <label for="segmento" class="form-label">Segmento</label>


                                   <select class="form-control select2" data-toggle="select2" name="Segmento">
                                    <option value="<?= $company['industry'] ?>"><?= $company['industry'] ?></option>
                                       <option selected></option>
                                       <option value="Agro">Agro</option>
    <option value="Comércio/ Varejo">Comércio/ Varejo</option>
    <option value="Construtora">Construtora</option>
    <option value="Distribuidor">Distribuidor</option>
    <option value="Educação">Educação</option>
    <option value="Empresa em geral">Empresa em geral</option>
    <option value="Hospital/ Saúde">Hospital/ Saúde</option>
    <option value="Hotéis e Pousada (Turismo)">Hotéis e Pousada (Turismo)</option>
    <option value="Indústria">Indústria</option>
    <option value="Instalador">Instalador</option>
    <option value="Instituição Financeira">Instituição Financeira</option>
    <option value="Laboratório">Laboratório</option>
    <option value="Logística">Logística</option>
    <option value="Mineradora">Mineradora</option>
    <option value="Organização Religiosa">Organização Religiosa</option>
    <option value="Órgão Público">Órgão Público</option>
    <option value="Pessoa Física">Pessoa Física</option>
    <option value="Revenda">Revenda</option>
    <option value="Serviços">Serviços</option>
    <option value="Shopping">Shopping</option>
    <option value="Supermercado">Supermercado</option>
    <option value="Outro">Outro</option>

                                    </select>
                                 </div>
                              </div>




                                 </div>

                              <div class="row">

                
                              <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="lastname" class="form-label">Administrador *</label>


                                   <select class="form-control select2" data-toggle="select2" name="gestor">
                                    <option selected value="<?= $company['manager_id'] ?>"><?= $company['manager_name'] ?></option>
                                       <option></option>
                                       <?php foreach ($persons as $person): ?>
                                       <option value="<?= $person['id_person'] ?>"><?= $person['name'] ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>

                              
                           </div>

                           

                           <h5 class="mb-3 text-uppercase bg-light p-2">Endereço</h5>
                     <hr class="my-2">
                     <!-- Divisor -->
                     <div class="row">
                        <div class="col-sm-2">
                           <div class="mb-1">
                              <label for="phone" class="form-label">CEP *</label>
                              <input required type="text" id="adress_cep" name="adress_cep" class="form-control" value="<?= $company['adress_zip'] ?>">
                           </div>
                        </div>
                        <div class="col-sm-3">
                           <div class="mb-3">
                              <label for="phone" class="form-label">Endereço *</label>
                              <input type="text" id="adress" name="adress" class="form-control">
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="mb-3">
                              <label for="phone" class="form-label">Número *</label>
                              <input required type="text" id="adress_number" name="adress_number" class="form-control" value="<?= $company['adress_number'] ?>">
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


                     <h5 class="mb-3 text-uppercase bg-light p-2">Financeiro</h5>
                           <div class="row">
                              <div class="col-sm-3">
                                 <div class="mb-1">
                                    <label for="phone" class="form-label">Email *</label>
                                    <input  type="email" id="financial_email" name="financial_email" class="form-control" value="<?= esc($company['financial_email']) ?>">
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="mb-3">
                                    <label for="phone" class="form-label">Telefone *</label>
                                    <input required type="text" id="financial_phone" name="financial_phone" class="form-control" data-toggle="input-mask" data-mask-format="(00) 00000-0000" value="<?= esc($company['financial_phone']) ?>">
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















                     <div class="tab-pane show" id="vagas">
                     <form action="/settings/company" method="post" enctype="multipart/form-data">
 


<div class="row">
<div class="col">
<p class="form-label">Logo da Empresa</p>
<small> 500 x 500 px </small>
                     <p><img class="preview-logo" src="<?= esc($company['urlimg']) ?>"></p>
                     
<label for="file-upload" class="btn btn-primary">Alterar</label>
<input hidden id="file-upload" class="file-chooser" name="userfile" type="file" accept="image/*">   


                                       </div>


                                       <div class="col">
<p class="form-label">Banner Desktop</p>
<small> 1920 x 420 px </small>
                     <p><img class="preview-desktop" src="<?= $urlimgdesktop ?>"></p>
                     
<label for="file-upload-desktop" class="btn btn-primary">Alterar</label>
<input hidden id="file-upload-desktop" class="file-desktop" name="img-desktop" type="file" accept="image/*">   


                                       </div>

                                       <div class="col">
<p class="form-label">Banner Mobile</p>
<small> 390 x 330 px </small>
                     <p><img class="preview-mobile" src="<?= $urlimgmobile ?>"></p>
                     
<label for="file-upload-mobile" class="btn btn-primary">Alterar</label>
<input hidden id="file-upload-mobile" class="file-mobile" name="img-mobile" type="file" accept="image/*">   


                                       </div>
                          

                                       </div>









                     <br><br><br><br>
                        
<div class="row">
                              <div class="col-md-5">
                                 

                              
                              <div class="mb-3">
        <label class="form-label">Url da página</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon1">vagas.inperson.com.br/</span>
            
            <input type="text" class="form-control" name="slug" id="slug" value="<?= esc($company['slug']) ?>">
            
        </div><div id="slug-feedback" name="slug-feedback"></div>
    </div>



                              </div>
                              <div class="col-sm-3">
                              <div class="mb-3">
        <label class="form-label">Cor Principal</label>
            <input type="color" class="form-control" name="color" id="color" value="<?= esc($company['primary_color']) ?>">
            
        </div>
    </div> 
                             </div>
                             <div class="mb-3">
                                    <label for="company_name" class="form-label">URL Video Youtube</label>
                                    <input type="text" id="url_video" name="url_video" class="form-control" value="<?= esc($company['video_url']) ?>">
                                 </div>
<input hidden name="reference" id="reference" value="<?= esc($company['reference']) ?>">
<div class="row">
<div class="mb-3">
        <label class="form-label">Descrição Sobre a empresa</label>
            <textarea rows="10" type="text" class="form-control" name="long_description" id="long_description" value="<?= esc($company['long_description']) ?>"><?= esc($company['long_description']) ?></textarea>
            
        </div>

                                       </div>

                                       <div class="text-end">
                              <button type="submit" id="lp" name="lp"  class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Salvar Informações da LP</button>
                              </div>

                              </div>

                           </form>

                     </div>



     <!-- end settings content-->

     <script>
jQuery(document).ready(function() {
    jQuery('#inputField').on('input', function() {
        var inputValue = jQuery(this).val();
        jQuery('#output').text(inputValue);
    });
});
</script>
<script>
    jQuery(document).ready(function() {
        jQuery('#slug').on('input', function() {
         var slug = jQuery(this).val();

// Remover acentos e transformar em caracteres "normais"
slug = slug.normalize('NFD').replace(/[\u0300-\u036f]/g, '');

// Substituir caracteres não alfanuméricos (incluindo espaços) por hífen
slug = slug.replace(/[^a-zA-Z0-9\s]/g, '-');

// Substituir espaços por hífens
slug = slug.replace(/\s+/g, '-');


// Transformar em minúsculas
slug = slug.toLowerCase();

// Atualiza o valor do campo de entrada com o slug modificado
jQuery(this).val(slug);
            
            if (slug) {
                // Verifica se o slug é igual ao esc($company['slug'])
                if (slug === '<?php echo esc($company['slug']); ?>') {
                    // Se for igual, exibe mensagem de URL disponível e habilita o botão
                    jQuery('#slug-feedback').text('URL disponível.').css('color', 'green').addClass('slugfeedback');
                    jQuery('#lp').prop('disabled', false);
                } else {
                    // Se não for igual, faz a verificação no banco de dados
                    jQuery.ajax({
                        url: '<?php echo base_url('check-slug'); ?>',
                        type: 'POST',
                        data: { slug: slug },
                        dataType: 'json',
                        success: function(response) {
                            console.log('Consultando');
                            if (response.exists) {
                                jQuery('#slug-feedback').text('Essa URL já está sendo usada.').css('color', 'red').addClass('slugfeedback');
                                jQuery('#lp').prop('disabled', true);
                            } else {
                                jQuery('#slug-feedback').text('URL disponível.').css('color', 'green').addClass('slugfeedback');
                                jQuery('#lp').prop('disabled', false);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Erro ao verificar o slug:', error);
                            jQuery('#slug-feedback').text('Erro ao verificar o slug.').removeClass('slugfeedback');
                        }
                    });
                }
            } else {
                jQuery('#slug-feedback').text('').removeClass('slugfeedback');
            }
        });
    });
</script>






<!-- Script para imagem de logo -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewImg = document.querySelector('.preview-logo');
    const fileChooserLogo = document.querySelector('.file-chooser');

    if (fileChooserLogo) {
        fileChooserLogo.addEventListener('change', function(e) {
            const fileToUpload = e.target.files.item(0);
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
            };

            if (fileToUpload) {
                reader.readAsDataURL(fileToUpload);
            }
        });
    }
});
</script>

<!-- Script para imagem de desktop -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewImgd = document.querySelector('.preview-desktop');
    const fileChooserDesktop = document.querySelector('.file-desktop');

    if (fileChooserDesktop) {
        fileChooserDesktop.addEventListener('change', function(e) {
            const fileToUpload = e.target.files.item(0);
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImgd.src = e.target.result;
            };

            if (fileToUpload) {
                reader.readAsDataURL(fileToUpload);
            }
        });
    }
});
</script>

<!-- Script para imagem de mobile -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewImgm = document.querySelector('.preview-mobile');
    const fileChooserMobile = document.querySelector('.file-mobile');

    if (fileChooserMobile) {
        fileChooserMobile.addEventListener('change', function(e) {
            const fileToUpload = e.target.files.item(0);
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImgm.src = e.target.result;
            };

            if (fileToUpload) {
                reader.readAsDataURL(fileToUpload);
            }
        });
    }
});
</script>












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

<!-- end Footer -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- Right Sidebar -->
<div class="end-bar">
   <div class="rightbar-title">
      <a href="javascript:void(0);" class="end-bar-toggle float-end">
      <i class="dripicons-cross noti-icon"></i>
      </a>
      <h5 class="m-0">Settings</h5>
   </div>
   <div class="rightbar-content h-100" data-simplebar>
      <div class="p-3">
         <div class="alert alert-warning" role="alert">
            <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
         </div>
         <!-- Settings -->
         <h5 class="mt-3">Color Scheme</h5>
         <hr class="mt-1" />
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light" id="light-mode-check" checked>
            <label class="form-check-label" for="light-mode-check">Light Mode</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check">
            <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
         </div>
         <!-- Width -->
         <h5 class="mt-4">Width</h5>
         <hr class="mt-1" />
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check" checked>
            <label class="form-check-label" for="fluid-check">Fluid</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
            <label class="form-check-label" for="boxed-check">Boxed</label>
         </div>
         <!-- Left Sidebar-->
         <h5 class="mt-4">Left Sidebar</h5>
         <hr class="mt-1" />
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
            <label class="form-check-label" for="default-check">Default</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked>
            <label class="form-check-label" for="light-check">Light</label>
         </div>
         <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
            <label class="form-check-label" for="dark-check">Dark</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check" checked>
            <label class="form-check-label" for="fixed-check">Fixed</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
            <label class="form-check-label" for="condensed-check">Condensed</label>
         </div>
         <div class="form-check form-switch mb-1">
            <input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
            <label class="form-check-label" for="scrollable-check">Scrollable</label>
         </div>
         <div class="d-grid mt-4">
            <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
            <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/"
               class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
         </div>
      </div>
      <!-- end padding-->
   </div>
</div>
<div class="rightbar-overlay"></div>

<!-- /End-bar -->


<script>




    document.addEventListener('DOMContentLoaded', function () {
        // Função para buscar o endereço com base no CEP
        function buscarEndereco(cep) {
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

        document.getElementById('financial_phone').addEventListener('blur', function () {
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