<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    public function index()
    {
        return view('LoginView');
    }

    public function store()
    {
        
        $validated = $this->validate(
            [
                'email' => 'required|valid_email',
                'password' => 'required',
            ],
            [
                'email' => [
                    'required' => 'O email é obrigatório',
                    'valid_email' => 'O email tem que ser válido',
                ],
                'password' => [
                    'required' => 'O password é obrigatório',
                ]
            ]);

        if(!$validated)
        {
            return redirect()->route('login')->with('errors', $this->validator->getErrors());
            
        }
        
        $user = new UserModel();
        $userFound = $user->select('users.id_user, users.name, users.email, users.password, users.id_company, companies.reference')
                    ->join('companies', 'companies.id_company = users.id_company')
                    ->where('users.email', $this->request->getPost('email'))
                    ->first();

        
        if(!$userFound)
        {
            return redirect()->route('login')->with('error', 'Email or password incorrect');
        }

        //var_dump(password_hash("102030", PASSWORD_DEFAULT));
        //var_dump($this->request->getPost('password'));
        //var_dump((password_verify($this->request->getPost('password'), $userFound->password)));
        //die();

        if(!password_verify($this->request->getPost('password'), $userFound->password)){
            return redirect()->route('login')->with('error', 'Email or password incorrect');
        }

        unset($userFound->password);
        session()->set('user', $userFound);

        return redirect()->route('dashboard');
    }

    public function destroy(){
        session()->destroy();

        return redirect()->route('login');
    }








}
