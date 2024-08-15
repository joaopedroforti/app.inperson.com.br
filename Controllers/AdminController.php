<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index($slug)
    {
        $user = session()->get('user');


        if (empty($slug)) {
            echo 'erro';
        } else {
  

            if ($user->email === 'j.forti@duocorp.com.br' || $user->email === 'bignotto@inperson.com.br') {
               
                $companiesModel = new \App\Models\CompanyModel();

                // Busca a empresa com o slug especificado
                $company = $companiesModel->where('slug', $slug)->first();


                if ($company) {
                    // Empresa encontrada

                    $user->id_company = $company['id_company'];
                    return redirect()->to('/employees');




                } else {
                    // Empresa não encontrada
                    echo 'Empresa não encontrada';
                }



            } 
            
            
            
            
            
            else {
                return redirect()->route('login');
            }


        }


        

        
die();
        // Modifica manualmente cada valor
        $user->id_user = $user->id_user;
        $user->name = $user->name;
        $user->email = $user->email;
        $user->id_company = '5';
        $user->reference = $user->reference;
        
        // Salva os dados modificados de volta na sessão
        session()->set('user', $user);
        
        // Exibe o resultado para verificar
        var_dump(session()->get('user'));

    }
}
