<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CompanyModel;
use App\Models\PersonModel;
use CodeIgniter\Files\File;
class CompanyController extends BaseController
{


    public function view()
    {
        $company_id = session()->get('user')->id_company;


        $CompanyModel = new CompanyModel();

        $query = $CompanyModel->select('companies.*, persons.id_person AS manager_id, persons.name AS manager_name')
        ->join('persons', 'persons.id_person = companies.id_manager', 'left')
        ->where('companies.id_company', $company_id)
        ->first();
    

        $filePath = 'assets/images/companies/' . $query['reference'] . '.png';


        if (file_exists($filePath)) {
            $query['urlimg'] = base_url('assets/images/companies/' . $query['reference'] . '.png');
        } else {
            $query['urlimg'] = base_url('assets/images/companies/default.png');
        }
        


        $PersonModel = new PersonModel();
        $persons = $PersonModel
        ->select('persons.id_person, persons.name')
        ->where('id_company', $company_id)
        ->findAll();
    
        $urlimgdesktop = base_url('assets/images/banners/desktop/' . $query['reference'] . '.png');
        $urlimgmobile = base_url('assets/images/banners/mobile/' . $query['reference'] . '.png');
  
        $data = [
            'company' => $query,
            'persons' => $persons,
            'urlimgdesktop' => $urlimgdesktop,
            'urlimgmobile' => $urlimgmobile,
        ];

        return view('AboutCompanyView', $data);


    }






    public function update()
    {
        $post = $this->request->getPost();
        $company_id = session()->get('user')->id_company;


        $company_name = $post['company_name'];
        $document_number = $post['document_number'];
        $id_manager = $post['gestor'];
        $Segmento = $post['Segmento'];
        $adress_cep = $post['adress_cep'];
        $adress_number = $post['adress_number'];
        $financial_email = $post['financial_email'];
        $financial_phone = $post['financial_phone'];
 
        $data = [
            'company_name' => $company_name,
            'document_number' => $document_number,
            'industry' => $Segmento,
            'adress_zip' => $adress_cep,
            'adress_number' => $adress_number,
            'financial_email' => $financial_email,
            'financial_phone' => $financial_phone,
            'id_manager' => $id_manager,
            // Adicione outras colunas e valores conforme necessário
        ];


$CompanyModel = new CompanyModel();
        
        // Query para atualizar os dados na tabela job_roles
        $CompanyModel->update($company_id, $data);

        
       return redirect()->to(base_url('/company'))->with('alert', 'Dados Atualizados Com sucesso!!');
    }

    public function delete($id)
    {
        // Lógica para excluir o funcionário com o ID fornecido
    }

    public function checkSlug()
    {
        $slug = $this->request->getPost('slug');

        $companyModel = new CompanyModel();
        $exists = $companyModel->where('slug', $slug)->first();

        if ($exists) {
            return $this->response->setJSON(['exists' => true]);
        } else {
            return $this->response->setJSON(['exists' => false]);
        }
    }





    public function updatelp()
    {
        $post = $this->request->getPost();


        $company_id = session()->get('user')->id_company;


        $slug = $post['slug'];
        $color = $post['color'];
        $reference = $post['reference'];
        $long_description = $post['long_description'];
        $video_url = $post['url_video'];

        $data = [
            'slug' => $slug,
            'primary_color' => $color,
            'long_description' => $long_description,
            'video_url' => $video_url,
        ];
 
        $CompanyModel = new CompanyModel();
        
        // Query para atualizar os dados na tabela job_roles
        $CompanyModel->update($company_id, $data);




//Imagem logo ------------------------------------------------------------------------------
        $file = $this->request->getFile('userfile');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Verifica se o arquivo é uma imagem
            $mimeType = $file->getMimeType();
            $isImage = strpos($mimeType, 'image/') === 0;



            if (file_exists('assets/images/companies/'.$reference.'.png')) {



            unlink('assets/images/companies/'.$reference.'.png');

            }
            if ($isImage) {
                $validationRule = [
                    'userfile' => [
                        'label' => 'Image File',
                        'rules' => [
                            'uploaded[userfile]',
                            'is_image[userfile]',
                            'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                            'max_size[userfile,100]',
                            'max_dims[userfile,1024,768]',
                        ],
                    ],
                ];
                
                if (! $this->validate($validationRule)) {
                    $data = ['errors' => $this->validator->getErrors()];
                    //return view('upload_form', $data);
                }
                
                $img = $this->request->getFile('userfile');
               
                if (! $img->hasMoved()) {
                    // Define o diretório de destino
                    $destination = 'assets/images/companies/';
                
                    // Gera um novo nome de arquivo para evitar substituições
                    $newName = $reference . '.png';
                
                    // Verifica se o arquivo existe
                    if (file_exists($destination . $newName)) {
                        // Exclui o arquivo existente
                        unlink($destination . $newName);
                    }
                   
                    // Move o arquivo para o novo diretório com o novo nome
                    $img->move($destination, $newName);
                    
                    // Define o caminho completo do arquivo
                    $filepath = $destination . $newName;
                
                    $data = ['uploaded_fileinfo' => new File($filepath)];
                    //return view('upload_success', $data);
                } else {
                    // O arquivo não é válido ou já foi movido
                    echo "Erro ao processar o arquivo.";
                }


            } else {

            }
        } else {
        }
    
// Imagem logo ------------------------------------------------------------------------------

    

 //Imagem desktop ------------------------------------------------------------------------------
 $file = $this->request->getFile('img-desktop');

 if ($file && $file->isValid() && !$file->hasMoved()) {
     // Verifica se o arquivo é uma imagem
     $mimeType = $file->getMimeType();
     $isImage = strpos($mimeType, 'image/') === 0;



     if (file_exists('assets/images/banners/desktop/'.$reference.'.png')) {



     unlink('assets/images/banners/desktop/'.$reference.'.png');

     

     }
     if ($isImage) {
         $validationRule = [
             'img-desktop' => [
                 'label' => 'Image File',
                 'rules' => [
                     'uploaded[img-desktop]',
                     'is_image[img-desktop]',
                     'mime_in[img-desktop,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                     'max_size[img-desktop,100]',
                     'max_dims[img-desktop,1024,768]',
                 ],
             ],
         ];
         
         if (! $this->validate($validationRule)) {
             $data = ['errors' => $this->validator->getErrors()];
             //return view('upload_form', $data);
         }
         
         $img = $this->request->getFile('img-desktop');
        
         if (! $img->hasMoved()) {
             // Define o diretório de destino
             $destination = 'assets/images/banners/desktop';
         
             // Gera um novo nome de arquivo para evitar substituições
             $newName = $reference . '.png';
         
             // Verifica se o arquivo existe
             if (file_exists($destination . $newName)) {
                 // Exclui o arquivo existente
                 unlink($destination . $newName);
             }
            
             // Move o arquivo para o novo diretório com o novo nome
             $img->move($destination, $newName);
             
             // Define o caminho completo do arquivo
             $filepath = $destination . $newName;
         
             $data = ['uploaded_fileinfo' => new File($filepath)];
             //return view('upload_success', $data);
         } else {
             // O arquivo não é válido ou já foi movido
             echo "Erro ao processar o arquivo.";
         }


     } else {

     }
 } else {
 }

// Imagem desktop ------------------------------------------------------------------------------

//Imagem mobile ------------------------------------------------------------------------------
$file = $this->request->getFile('img-mobile');

if ($file && $file->isValid() && !$file->hasMoved()) {
    // Verifica se o arquivo é uma imagem
    $mimeType = $file->getMimeType();
    $isImage = strpos($mimeType, 'image/') === 0;



    if (file_exists('assets/images/banners/mobile/'.$reference.'.png')) {



    unlink('assets/images/banners/mobile/'.$reference.'.png');

    }
    if ($isImage) {
        $validationRule = [
            'img-mobile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[img-mobile]',
                    'is_image[img-mobile]',
                    'mime_in[img-mobile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[img-mobile,100]',
                    'max_dims[img-mobile,1024,768]',
                ],
            ],
        ];
        
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
            //return view('upload_form', $data);
        }
        
        $img = $this->request->getFile('img-mobile');
       
        if (! $img->hasMoved()) {
            // Define o diretório de destino
            $destination = 'assets/images/banners/mobile';
        
            // Gera um novo nome de arquivo para evitar substituições
            $newName = $reference . '.png';
        
            // Verifica se o arquivo existe
            if (file_exists($destination . $newName)) {
                // Exclui o arquivo existente
                unlink($destination . $newName);
            }
           
            // Move o arquivo para o novo diretório com o novo nome
            $img->move($destination, $newName);
            
            // Define o caminho completo do arquivo
            $filepath = $destination . $newName;
        
            $data = ['uploaded_fileinfo' => new File($filepath)];
            //return view('upload_success', $data);
        } else {
            // O arquivo não é válido ou já foi movido
            echo "Erro ao processar o arquivo.";
        }


    } else {

    }
} else {
}

// Imagem mobile ------------------------------------------------------------------------------








       $CompanyModel = new CompanyModel();

       $query = $CompanyModel->select('companies.*, persons.id_person AS manager_id, persons.name AS manager_name')
       ->join('persons', 'persons.id_person = companies.id_manager', 'left')
       ->where('companies.id_company', $company_id)
       ->first();
   

       $filePath = 'assets/images/companies/' . $query['reference'] . '.png';


       if (file_exists($filePath)) {
           $query['urlimg'] = base_url('assets/images/companies/' . $query['reference'] . '.png');
       } else {
           $query['urlimg'] = base_url('assets/images/companies/default.png');
       }


        



       $PersonModel = new PersonModel();
       $persons = $PersonModel
       ->select('persons.id_person, persons.name')
       ->where('id_company', $company_id)
       ->findAll();
   
       $urlimgdesktop = base_url('assets/images/banners/desktop/' . $query['reference'] . '.png');
       $urlimgmobile = base_url('assets/images/banners/mobile/' . $query['reference'] . '.png');
       $data = [
           'company' => $query,
           'persons' => $persons,
           'alert' => 'Dados Atualizados Com sucesso!!',
           'urlimgdesktop' => $urlimgdesktop,
           'urlimgmobile' => $urlimgmobile,


       ];

       return view('AboutCompanyView', $data);


    }







}
