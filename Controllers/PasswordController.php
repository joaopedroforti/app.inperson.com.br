<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class PasswordController extends BaseController
{
    public function index()
    {
        $data['step'] = '1';
        return view('PasswordRecoveryView', $data);
    }
    
    public function recovery()
    {
        $userModel = new UserModel();
        $email =  $this->request->getPost('email');

        if ($email) {
           
            $user = $userModel->getUserByEmail($email);

            if ($user) {
                $reference = $user->reference;
                $postData = [
                    'email' => $email,
                    'reference' => $reference
            ];

            $client = \Config\Services::curlrequest();
            $client->request('POST', 'https://webhook.duocorp.com.br/webhook/80b61819-8c7f-4ef0-9672-c071ec2f084b', [
                'form_params' => $postData
            ]);

            $data['step'] = 'check-email';

            return view('PasswordRecoveryView', $data);

        } else {
                  $data['step'] = 'error';
                  
            return view('PasswordRecoveryView', $data);
            }
        } 
    }

    public function new()
    {
        $reference = $this->request->uri->getSegment(2);
        $data['step'] = 'new';
        $data['reference'] = $reference;
        return view('PasswordRecoveryView', $data);

    }

    public function store()
    {
        $reference = $this->request->getPost('reference');
        $new_password = password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT);

        $data = [
            'password' => $new_password,
        ];

        $user = new UserModel();
        $user->builder()->update($data, ['reference' => $reference]);

        return redirect()->route('login');
    }
}
