<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\JobRoleModel;
use App\Models\DepartmentModel;


class JobRoleController extends Controller
{
    public function index()
    {
        $company_id = session()->get('user')->id_company;

$departments = $DepartmentModel->findAll(array('conditions' => array('id_company' => $company_id)));

var_dump($departments);

    }






    public function show($id)
    {
        echo 'Showing details of employee with ID: ' . $id;
    }

    public function create()
    {
        $data = [
            'step' => 1,
            'title' => 'Novo Cargo InPerson'
        ];
        return view('NewJobRoleView', $data);
    }

    public function store()
    {
        // Lógica para salvar os dados do novo funcionário
    }

    public function edit($id)
    {
        echo 'Form to edit employee with ID: ' . $id;
    }

    public function update($id)
    {
        // Lógica para atualizar os dados do funcionário com o ID fornecido
    }

    public function delete($id)
    {
        // Lógica para excluir o funcionário com o ID fornecido
    }
}
