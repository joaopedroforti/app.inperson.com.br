<?php

namespace App\Controllers;

use App\Models\PersonModel;
use App\Models\DepartmentModel;
use App\Models\VacancieModel;

class DepartmentController extends BaseController
{
    public function index($page = 1)
    {

        $company_id = session()->get('user')->id_company;
        $search = $this->request->getVar('search'); // Obtendo o termo de pesquisa
        $perPage = 10; // Quantidade de registros por página
        $departmentModel = new DepartmentModel();
    
        $departmentModel->select('departments.*, persons.name as manager_name')
            ->join('persons', 'persons.id_person = departments.id_manager')
            ->where('departments.id_company', $company_id);

            if (!empty($search)) {
                $results = $departmentModel->like('departments.description', $search)
                                           ->paginate($perPage, 'departament');

                $totalRows = $departmentModel->like('departments.description', $search)
                                             ->countAllResults();
            } else {
                $results = $departmentModel->paginate($perPage, 'departament');
                $totalRows = $departmentModel->where('departments.id_company', $company_id)
                                             ->countAllResults();
            }
    
        $data = [
            'title' => 'Departamentos InPerson',
            'perpage' => $perPage,
            'departments' => $results,
            'pager' => $departmentModel->pager,
            'totalRows' => $totalRows,
            'currentPage' => $this->request->getVar('page_departament') ? $this->request->getVar('page_departament') : 1,
            'status' => '1',
        ];
    
        return view('DepartmentView', $data);
    }






    public function show($id)
    {
        echo 'Showing details of employee with ID: ' . $id;
    }

    public function create()
    {
        $company_id = session()->get('user')->id_company;
        $PersonModel = new personModel();
        $persons = $PersonModel->select('*')->where('id_company', $company_id)->where('id_person_type', 1)->findAll();
        


        $data = [
            'step' => 1,
            'title' => 'Novo Departamento',
            'persons' => $persons
        ];


        return view('NewDepartmentView', $data);
    }

    public function store()
    {

        $company_id = session()->get('user')->id_company;
    
        $DepartmentModel = new DepartmentModel();
    

        $post = $this->request->getPost();
$description = $this->request->getPost('description');
$manager = $this->request->getPost('manager');
;


$DepartmentModel->insert([

    'id_company' => $company_id,
    'description' => $description,
    'id_manager' => $manager,
    'status' => 1,

]);

//var_dump($post);

return redirect()->route('department')->with('alert', 'Departamento Criado com sucesso!');
    }

    public function edit($id)
    {
        echo 'Form to edit employee with ID: ' . $id;
    }

    public function changeStatus($id_vacancie)
    {
        $vacancieModel = new VacancieModel();
    
        // Buscar a vaga pelo ID
        $vacancie = $vacancieModel->find($id_vacancie);
    
        if ($vacancie) {
            // Verificar o status atual e alternar entre 0 e 1
            $newStatus = $vacancie['status'] == 1 ? 0 : 1;
    
            // Atualizar o status da vaga
            $vacancieModel->update($id_vacancie, ['status' => $newStatus]);
    
            // Redirecionar de volta para a página anterior
            return redirect()->route('vacancies')->with('alert', 'Status alterado com sucesso!');
        } else {
            // Vaga não encontrada, redirecionar para uma página de erro ou retornar uma mensagem
            return redirect()->route('vacancies');
        }
    }

    public function delete($id)
    {
        // Lógica para excluir o funcionário com o ID fornecido
    }


    public function view($reference)
    {
        $company_id = session()->get('user')->id_company;

        $departmentModel = new DepartmentModel();
        $PersonModel = new PersonModel();

        $persons = $PersonModel->select('persons.name, persons.id_person')
        ->where('persons.id_company', $company_id)
        ->where('persons.id_person_type', 2)
        ->findAll();

        $department = $departmentModel->select('departments.*, persons.name AS manager_name, persons.id_person AS manager_id')
        ->join('persons', 'departments.id_manager = persons.id_person', 'left')
        ->where('departments.id_company', $company_id)
        ->where('departments.reference', $reference)
        ->findAll();
    



        $data = [
            'department' => $department[0],
            'persons' => $persons,
        ];

//var_dump($department);
        //die();
        return view('AboutDepartmentView', $data);

    }



    public function update($id)
    {
        $post = $this->request->getPost();
        $company_id = session()->get('user')->id_company;


        $id_department= $post['id_department'];
        $description = $post['description'];
        $id_manager = $post['gestor'];
        $reference = $post['reference'];
        
        $data = [
            'description' => $description,
            'id_manager' => $id_manager
            // Adicione outras colunas e valores conforme necessário
        ];
        
$departmentModel = new departmentModel();
        
        // Query para atualizar os dados na tabela job_roles
        $departmentModel->update($id_department, $data);

       return redirect()->to(base_url('/department/view/' . $reference))->with('alert', 'Dados Atualizados Com sucesso!!');
    }






}
