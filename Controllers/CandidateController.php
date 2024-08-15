<?php

namespace App\Controllers;

use App\Models\PersonModel;
use App\Models\CalculationResultModel;
use App\Models\JobRoleModel;
use App\Models\DepartmentModel;
use App\Models\EducationLevelModel;
use App\Models\GenderModel;
use App\Models\MaritalStatusModel;
use App\Models\RecruitmentsModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Files\File;
class CandidateController extends BaseController
{


    public function vercandidato($reference)
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


    $RecruitmentsModel = new RecruitmentsModel();

    $vacancies = $RecruitmentsModel->select('recruitments.*, vacancies.description as descricao_vaga')
    ->join('vacancies', 'recruitments.id_vacancy = vacancies.id_vacancie')
    ->where('recruitments.id_company', $company_id)

    ->findAll();

    $data['vacancies'] = $vacancies;
//var_dump($vacancies);
//die();
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
                $data['names'] = "0";
                $data['values'] = "0";
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

        }


        return view('AboutCandidatoView', $data);

    }
    
    public function index($page = 1)
    {
        $company_id = session()->get('user')->id_company;
        $search = $this->request->getVar('search'); 
        $search = empty($search) ? "" : $search;
        $favorite = $this->request->getVar('favorite');

        // Obtendo o termo de pesquisa
        $personsModel = new PersonModel();
        $perPage = 10; // Quantidade de registros por página
    
        $personsModel->select('persons.name as full_name, persons.vacancies, persons.registration_date, persons.avatar, persons.reference, persons.favorite')
        ->where('persons.id_company', $company_id)
        ->where('persons.id_person_type', 2); 

    
        if ($favorite == 1) {

            $results = $personsModel->like('persons.name', $search)
            ->where('persons.id_company', $company_id)
            ->where('persons.favorite', $favorite)
                                      ->where('persons.id_person_type', 2)
                                    ->paginate($perPage, 'candidate');

            $totalRows = $personsModel->like('persons.name', $search)
            ->where('persons.id_company', $company_id)
            ->where('persons.favorite', $favorite)
                                      ->where('persons.id_person_type', 2)
                                      ->countAllResults();
        }else{

            $results = $personsModel->like('persons.name', $search)
            ->where('persons.id_company', $company_id)
                                      ->where('persons.id_person_type', 2)
                                    ->paginate($perPage, 'candidate');

            $totalRows = $personsModel->like('persons.name', $search)
            ->where('persons.id_company', $company_id)
                                      ->where('persons.id_person_type', 2)
                                      ->countAllResults();


        }

    
        
        $pager = $personsModel->pager;

        $data = [
            'search' => $search,
            'favorite' => $favorite,
            'title' => 'Colaboradores InPerson',
            'perpage' => $perPage,
            'candidates' => $results,
            'pager' => $pager,
            'totalRows' => $totalRows,
            'currentPage' => $this->request->getVar('page_candidate') ? $this->request->getVar('page_candidate') : 1,
        ];

    
        return view('CandidatesView', $data);
    }
    








    public function create()
    {
        $company_id = session()->get('user')->id_company;
        $educationLevelModel = new EducationLevelModel();
        $educationLevels = $educationLevelModel->findAll();
        $JobRoleModel = new JobRoleModel();
        $jobroles = $JobRoleModel->where('id_company',  $company_id)
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
        $birth = Time::createFromFormat('d/m/Y', $this->request->getPost('birth'))->toDateTimeString();
        $gender = $this->request->getPost('gender');
        $marital = $this->request->getPost('marital');
        $mail = $this->request->getPost('mail');
        $personalmail = $this->request->getPost('personalmail');
        $phone = $this->request->getPost('phone');
        $course = $this->request->getPost('course');
        $education = $this->request->getPost('education');
        $job = $this->request->getPost('job');
        $adressCep = $this->request->getPost('adress_cep');
        $adress = $this->request->getPost('adress');
        $adressNumber = $this->request->getPost('adress_number');
        $adressDistrict = $this->request->getPost('adress_district');
        $adressCity = $this->request->getPost('adress_city');
        $admission = Time::createFromFormat('d/m/Y', $this->request->getPost('admission'))->toDateTimeString();

    
        // Verifique se o email ou CPF já existem na tabela
        $personModel = new PersonModel();
        $existingPerson = $personModel->where('personal_email', $personalmail)
            ->orWhere('document_number', $document)
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
                'personal_email' => $personalmail,
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
                'registration_date' => Time::now(),
            ]);
        
            // Redirecione para a página de sucesso ou faça qualquer outra coisa necessária
            return redirect()->route('employees')->with('alert', 'Colaborador já existente, dados Atualizados.');

        }
    
        // Caso contrário, insira os dados na tabela
        $personModel->insert([
            'name' => $name,
            'document_number' => $document,
            'birth' => $birth,
            'id_gender' => $gender,
            'marital_status' => $marital,
            'internal_email' => $mail,
            'personal_email' => $personalmail,
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

    $RecruitmentsModel = new RecruitmentsModel();

    $vacancies = $RecruitmentsModel->select('recruitments.*, vacancies.description as descricao_vaga')
    ->join('vacancies', 'recruitments.id_vacancy = vacancies.id_vacancie')
    ->where('recruitments.id_company', $company_id)
    ->where('id_person', $person['id_person'])
    ->findAll();

    $data['vacancies'] = $vacancies;
//var_dump($vacancies);
//die();
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
                $skillsvaluearray = [];
                foreach ($skills as $skill) {
                    $skillsvaluearray[] = floatval($skill['value']);
                }
        
                $skillsvalue = json_encode($skillsvaluearray);
                $data['skills'] = $skills;
                $data['attributes'] = $attributes;
                $data['skillsvalue'] = $skillsvalue;
               
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
        //$birth = Time::createFromFormat('d/m/Y', $this->request->getPost('birth'))->toDateTimeString();
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
        $anotacao = $this->request->getPost('anotacao');




        // Verifique se o email ou CPF já existem na tabela
        $personModel = new PersonModel();
        // Se o email ou CPF já existirem, atualize os dados
            $personModel->update($id_person, [
                'name' => $name,
                'document_number' => $document,
                //'birth' => $birth,
                'id_gender' => $gender,
                'anotacoes' => $anotacao,
                'marital_status' => $marital,
                'personal_email' => $personalMail,
                'personal_phone' => $phone,
                'formation_course' => $course,
                'education_level' => $education,
                'id_job' => $job,
                //'nascimento' => $birth,
                'adress_zip' => $adressCep,
                'adress' => $adress,
                'adress_number' => $adressNumber,
                'adress_district' => $adressDistrict,
                'adress_city' => $adressCity,

            ]);
        
            // Redirecione para a página de sucesso ou faça qualquer outra coisa necessária
            return redirect()->to(base_url('candidato/' . $reference))->with('alert', 'Dados Atualizados Com Sucesso!');


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
    
 
    





    public function toggleFavorite($reference)
    {
        $model = new PersonModel();
        
        // Obter o registro pelo reference
        $person = $model->where('reference', $reference)->first();
        
        if ($person) {
            // Alternar o valor de favorite
            $newFavoriteValue = $person['favorite'] == 1 ? 0 : 1;
            
        
            $model->where('reference', $reference)->set(['favorite' => $newFavoriteValue])->update();
        
            // Retornar o novo valor
            return $this->response->setJSON(['favorite' => $newFavoriteValue]);
            
        }
        
        // Retornar um erro se o registro não for encontrado
        return $this->response->setJSON(['error' => 'Record not found'], 404);
    }
















    public function curriculo($reference)
    {
     
     $PersonModel = new PersonModel();
        
     $person = $PersonModel->where('reference', $reference)->first();

     if ($person) {
         // Instanciar o modelo Recruitment
         $recruitmentModel = new RecruitmentsModel();
     
         // Obter o último registro em recruitments onde id_person é igual ao id_person da $person
         $lastRecruitment = $recruitmentModel->where('id_person', $person['id_person'])
                                             ->orderBy('id_recruitment', 'DESC')
                                             ->first();
     
$curriculo = $lastRecruitment['curriculum'];
     //var_dump($curriculo);
     $data['curriculo'] = $curriculo;
     return view('CurriculoView', $data);
}
}
}