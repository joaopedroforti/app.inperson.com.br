<?php

namespace App\Controllers;

use App\Models\PersonModel;
use App\Models\CalculationResultModel;
use App\Models\JobRoleModel;
use App\Models\EducationLevelModel;
use App\Models\GenderModel;
use App\Models\MaritalStatusModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Files\File;
class EmployeeController extends BaseController
{

    public function index($page = 1)
    {



        $companyreference = session()->get('user')->reference;
        $company_id = session()->get('user')->id_company;
        $search = $this->request->getVar('search'); // Obtendo o termo de pesquisa
        $personsModel = new PersonModel();
        $perPage = 10; // Quantidade de registros por página
    
        $personsModel->select('persons.reference, persons.avatar, persons.name as full_name, persons.active, cr.result_name as behavioral_profile, job_roles.description as job_title, departments.description as department')
        ->join('(SELECT id_entity, MAX(id_calculation) AS max_calculation FROM calculation_results WHERE calculation_type = 1 GROUP BY id_entity) AS latest_cr', 'persons.id_person = latest_cr.id_entity', 'left')
        ->join('calculation_results AS cr', 'latest_cr.max_calculation = cr.id_calculation', 'left')
        ->join('job_roles', 'persons.id_job = job_roles.id_job', 'left')
        ->join('departments', 'job_roles.id_department = departments.id_department', 'left')
        ->where('persons.id_company', $company_id)
        ->where('persons.id_person_type', 1)
        ->orderBy('persons.active', 'DESC') // Ordena os registros pelo campo 'active' em ordem decrescente (ativos primeiro)
        ->orderBy('persons.name', 'ASC'); // Em seguida, ordena os registros pelo nome em ordem crescente

        if (!empty($search)) {
            $builder = $personsModel->like('persons.name', $search)
            ->where('persons.id_company', $company_id);
        
        // Contar o total de linhas sem redefinir a consulta
        $totalRows = $builder->countAllResults(false);
        
        // Paginando os resultados
        $results = $builder->paginate($perPage, 'employee');
                                

        } else {
            $results = $personsModel->paginate($perPage, 'employee');
            $totalRows = $personsModel->where('persons.id_company', $company_id)
                                      ->where('persons.id_person_type', 1)
                                      ->countAllResults();
        }
    
        
        $pager = $personsModel->pager;
        $data = [
            'title' => 'Colaboradores InPerson',
            'companyreference' => $companyreference,
            'perpage' => $perPage,
            'employees' => $results,
            'pager' => $pager,
            'totalRows' => $totalRows,
            'registros' => $totalRows,
            'currentPage' => $this->request->getVar('page_employee') ? $this->request->getVar('page_employee') : 1,
        ];
       
   
        return view('EmployeesView', $data);
    }
    








    public function create()
    {
        $company_id = session()->get('user')->id_company;
        $educationLevelModel = new EducationLevelModel();
        $educationLevels = $educationLevelModel->findAll();
        $JobRoleModel = new JobRoleModel();
        $jobroles = $JobRoleModel->select('job_roles.id_job, job_roles.description, job_roles.id_department, departments.description AS department_description')
        ->join('departments', 'departments.id_department = job_roles.id_department')
        ->where('job_roles.id_company', $company_id)
        ->findAll();
        
        $MaritalStatusModel = new MaritalStatusModel();
        $marital = $MaritalStatusModel->findAll();
        $GenderModel = new GenderModel();
        $genders = $GenderModel->findAll();

        $data['maritals'] = $marital;
        $data['genders'] = $genders;
        $data['title'] = 'Novo Colaborador InPerson';
        $data['educationLevels'] = $educationLevels;
        $data['jobroles'] = $jobroles;
        return view('NewEmployeeView', $data);
    }

    public function store()
    {
        $company_id = session()->get('user')->id_company;

        $name = $this->request->getPost('name');
        $document = $this->request->getPost('document');
        $birth = $this->request->getPost('birth');
        $gender = $this->request->getPost('gender');
        $marital = $this->request->getPost('marital');
        $mail = $this->request->getPost('mail');
        $personalMail = $this->request->getPost('personalmail');
        $phone = $this->request->getPost('phone');
        $course = $this->request->getPost('course');
        $education = $this->request->getPost('education');
        $job = $this->request->getPost('job');
        $adressCep = $this->request->getPost('adress_cep');
        $adress = $this->request->getPost('adress');
        $adressNumber = $this->request->getPost('adress_number');
        $adressDistrict = $this->request->getPost('adress_district');
        $adressCity = $this->request->getPost('adress_city');
        $admission = $this->request->getPost('admission');
        $contract_type = $this->request->getPost('contract_type');
    

        // Verifique se o email ou CPF já existem na tabela
        $personModel = new PersonModel();
        $existingPerson = $personModel->where('document_number', $document)
            ->first();
    
        // Se o email ou CPF já existirem, atualize os dados
        if ($existingPerson) {
            $personModel->update($existingPerson['id_person'], [
                'name' => $name,
                'document_number' => $document,
                'birth' => $birth,
                'id_gender' => $gender,
                'marital_status' => $marital,
                'internal_email' => $mail,
                'personal_email' => $personalMail,
                'personal_phone' => $phone,
                'formation_course' => $course,
                'education_level' => $education,
                'id_job' => $job,
                'nascimento' => $birth,
                'adress_zip' => $adressCep,
                'adress' => $adress,
                'adress_number' => $adressNumber,
                'adress_district' => $adressDistrict,
                'adress_city' => $adressCity,
                'admission_date' => $admission,
                'contract_type' => $contract_type,
                'id_person_type' => 1,
                'registration_date' => Time::now(),
            ]);
        
            // Redirecione para a página de sucesso ou faça qualquer outra coisa necessária
            return redirect()->route('employees')->with('alert', 'Colaborador já existente, dados Atualizados.');

        }
    
        // Caso contrário, insira os dados na tabela
        $personModel->insert([
            'name' => $name,
            'id_company' => $company_id,
            'document_number' => $document,
            'birth' => $birth,
            'id_gender' => $gender,
            'marital_status' => $marital,
            'internal_email' => $mail,
            'personal_email' => $personalMail,
            'personal_phone' => $phone,
            'formation_course' => $course,
            'education_level' => $education,
            'id_job' => $job,
            'nascimento' => $birth,
            'adress_zip' => $adressCep,
            'adress' => $adress,
            'adress_number' => $adressNumber,
            'adress_district' => $adressDistrict,
            'adress_city' => $adressCity,
            'admission_date' => $admission,
            'id_person_type' => 1,
            'contract_type' => $contract_type,
            'registration_date' => Time::now(),
        ]);
 
        return redirect()->route('employees')->with('alert', 'Colaborador Cadastrado com sucesso!');
    }
    





    public function view($reference)
    {

$company_id = session()->get('user')->id_company;
        $MaritalStatusModel = new MaritalStatusModel();
        $marital = $MaritalStatusModel->findAll();
        $GenderModel = new GenderModel();
        $genders = $GenderModel->findAll();
        $data['maritals'] = $marital;
        $data['genders'] = $genders;
        $persondetail= new PersonModel();

        
        $person = $persondetail->select('persons.*, 
        job_roles.id_job AS job_id, 
        job_roles.description AS job_title,
        departments.description AS department_description,
        departments.id_department AS department_id,
        departments.id_manager AS department_manager,
        marital_statuses.id_marital AS marital_id,
        marital_statuses.description AS marital_description,
        genders.id_gender AS gender_id,
        genders.description AS gender_description,
        education_levels.description AS education_description') // Adicionando department_description
    ->join('job_roles', 'job_roles.id_job = persons.id_job', 'left')
    ->join('marital_statuses', 'marital_statuses.id_marital = persons.marital_status', 'left')
    ->join('genders', 'genders.id_gender = persons.id_gender', 'left')
    ->join('education_levels', 'education_levels.id_education = persons.education_level', 'left') // Ajustando para education_levels e id_education
    ->join('departments', 'departments.id_department = job_roles.id_department', 'left') // Junção com a tabela departments
    ->where('persons.reference', $reference)
    ->first();

$manager = $persondetail->select('persons.name')
->where('persons.id_person', $person['department_manager'])
->first();

        if ($person) {
            $calculationResults = $persondetail->select('calculation_results.*, DATE_FORMAT(calculation_results.calculed_at, "%d/%m/%Y %H:%i") as formatted_calculed_at')
            ->join('calculation_results', 'calculation_results.id_entity = persons.id_person')
            ->where('calculation_results.calculation_type', 1)
            ->where('calculation_results.id_entity', $person['id_person'])
            ->findAll();


            if (empty($calculationResults[0]['attributes'])) {
                $data['skillsvalue'] = '0';
                $data['attributes'] = [
                    "decision" => "0",
                    "detail" => "0",
                    "enthusiasm" => "0",
                    "relational" => "0"
                ];

            } else {
                $attributes = json_decode($calculationResults[0]['attributes'], true);
                $data['calculation_results'] = $calculationResults;
                $skills = json_decode($calculationResults[0]['skills'], true);



                $desired_order = [
                    "Foco em resultado",
                    "Estrategista",
                    "Automotivação",
                    "Intraempreendedorismo",
                    "Proatividade",
                    "Otimismo",
                    "Influência",
                    "Criatividade",
                    "Adaptabilidade",
                    "Sociabilidade",
                    "Diplomacia",
                    "Empatia",
                    "Harmonia",
                    "Colaboração",
                    "Autocontrole",
                    "Disciplina",
                    "Concentração",
                    "Organização e planejamento",
                    "Precisão",
                    "Análise"
                ];
                
                // Crie um array associativo para armazenar os valores
                $skill_values = [];
                foreach ($skills as $skill) {
                    $skill_values[$skill['name']] = (float) $skill['value']; // Convertendo o valor para float
                }
                
                // Ordene os valores de acordo com a ordem desejada
                $ordered_values = [];
                foreach ($desired_order as $category) {
                    if (isset($skill_values[$category])) {
                        $ordered_values[] = $skill_values[$category];
                    } else {
                        $ordered_values[] = 0; // Adicione um valor padrão (0) se a categoria não estiver presente
                    }
                }
                
                // Passe os dados para a view
                $data['names'] = $desired_order;
                $data['values'] = $ordered_values;






       
                $data['manager'] = $manager;
                $data['skills'] = $skills;
                $data['attributes'] = $attributes;
            }

        


  
            



 
        $educationLevelModel = new EducationLevelModel();
        $educationLevels = $educationLevelModel->findAll();


        $JobRoleModel = new JobRoleModel();
        $jobroles = $JobRoleModel->select('job_roles.id_job, job_roles.description, job_roles.id_department, departments.description AS department_description')
        ->join('departments', 'departments.id_department = job_roles.id_department')
        ->where('job_roles.id_company', $company_id)
        ->findAll();
        




        
        $data['educationLevels'] = $educationLevels;
        $data['jobroles'] = $jobroles;


        
        $data['title'] = 'Visualizar Colaborador InPerson';
        $data['person'] = $person;

       

        return view('AboutPersonView', $data);
    }
}

    public function update()
    {
        $company_id = session()->get('user')->id_company;
        $id_person = $this->request->getPost('id_person');
        $reference = $this->request->getPost('reference');
        $name = $this->request->getPost('name');
        $document = $this->request->getPost('document');
        $birth = $this->request->getPost('birth');
        $gender = $this->request->getPost('gender');
        $marital = $this->request->getPost('marital');
        $mail = $this->request->getPost('mail');
        $personalMail = $this->request->getPost('personalmail');
        $phone = $this->request->getPost('phone');
        $course = $this->request->getPost('course');
        $education = $this->request->getPost('education');
        $job = $this->request->getPost('job');
        $adressCep = $this->request->getPost('adress_cep');
        $adress = $this->request->getPost('adress');
        $adressNumber = $this->request->getPost('adress_number');
        $adressDistrict = $this->request->getPost('adress_district');
        $adressCity = $this->request->getPost('adress_city');
        $admission = $this->request->getPost('admission');
        $contract_type = $this->request->getPost('contract_type');
    
        // Verifique se o email ou CPF já existem na tabela
        $personModel = new PersonModel();
    
        // Se o email ou CPF já existirem, atualize os dados

            $personModel->update($id_person, [
                'name' => $name,
                'document_number' => $document,
                'birth' => $birth,
                'id_gender' => $gender,
                'marital_status' => $marital,
                'internal_email' => $mail,
                'personal_phone' => $phone,
                'formation_course' => $course,
                'education_level' => $education,
                'id_job' => $job,
                'nascimento' => $birth,
                'adress_zip' => $adressCep,
                'adress' => $adress,
                'adress_number' => $adressNumber,
                'adress_district' => $adressDistrict,
                'adress_city' => $adressCity,
                'admission' => $admission,
                'id_person_type' => 1,
                'contract_type' => $contract_type,
            ]);
        
            // Redirecione para a página de sucesso ou faça qualquer outra coisa necessária
            return redirect()->to(base_url('employee/view/' . $reference))->with('alert', 'Dados Atualizados Com Sucesso!');


    }


    public function imageupdater()  {
        $reference = $this->request->getPost('reference');
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
            $destination = 'assets/images/userimages/';
    
            // Gera um novo nome de arquivo para evitar substituições
            $newName = $reference . '.jpg';
    
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
        }
    
        $data = ['errors' => 'The file has already been moved.'];
        //var_dump($data);
        $personModel = new PersonModel();

$data = [
    'avatar' => 1
];

$personModel->where('reference', $reference)->set($data)->update();

        return redirect()->to(base_url('employee/view/' . $reference))->with('alert', 'Imagem de Perfil atualizada Com Sucesso!');



    }
    
 
    


    public function delete($id)
    {
        // Lógica para excluir o funcionário com o ID fornecido
    }

    public function status()
    {
        $reference = $_GET['reference'] ?? null;
        $action = $_GET['action'] ?? null;

        // Verifica se ambos os valores estão definidos antes de executar a atualização
        if ($reference !== null && $action !== null) {
            $personModel = new PersonModel();
           

            $data = [
                'active' => $action
            ];
            $personModel->where('reference', $reference)->set($data)->update();

            return redirect()->to(base_url('employee/view/' . $reference))->with('alert', 'Status alterado Com Sucesso!');
        }
        
    }
    
    public function effective()
    {
        $reference = $_GET['reference'] ?? null;
        $personModel = new PersonModel();

            $data = [
                'id_person_type' => 1
            ];
            $personModel->where('reference', $reference)->set($data)->update();

            return redirect()->to(base_url('employee/view/' . $reference))->with('alert', 'Efetivado Com Sucesso!');
        }
        
    }
    

    

