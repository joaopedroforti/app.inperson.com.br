<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\JobRoleModel;
use App\Models\VacancieModel;
use App\Models\PersonModel;
use App\Models\RecruitmentsModel;
use CodeIgniter\I18n\Time;
use App\Models\CalculationResultModel;


class RecruitmentController extends BaseController
{



    public function vervaga($reference)
    {
        $post = $this->request->getPost();

$text = $this->request->getPost('ftext');
$favorite = $this->request->getPost('ffavorite');
$etapa = $this->request->getPost('fetapas');

if (empty($reference)) {
    // Set $reference to the value from the POST request
    $reference = $this->request->getPost('ref');
}


        $company_id = session()->get('user')->id_company;
        $VagaReference = $reference;

        $vacancieModel = new vacancieModel();
        $vacancie = $vacancieModel->select('vacancies.*, job_roles.description as job_description, job_roles.id_job as job_id')
        ->join('job_roles', 'job_roles.id_job = vacancies.id_job')
        ->where('vacancies.reference', $VagaReference)
        ->first();
        if (empty($vacancie)) {
            echo "nao encontrado";
            die();
        }


        $IdVaga = $vacancie['id_vacancie'];

        

        $DataCriacao = date('d/m/Y', strtotime($vacancie['creation_date']));
        $creation_date_datetime = new \DateTime($vacancie['creation_date']);
        $current_date_datetime = new \DateTime();
        $interval = $current_date_datetime->diff($creation_date_datetime);
        $DiasCriacao = $interval->days;

        $recruitmentsModel = new RecruitmentsModel();
        $candidatos = $recruitmentsModel->select('recruitments.*, persons.*, persons.reference as person_reference, vacancies.*, cr.*, cr.reference as calculation_reference')
        ->join('persons', 'persons.id_person = recruitments.id_person')
        ->join('vacancies', 'vacancies.id_vacancie = recruitments.id_vacancy')
        ->join('(SELECT id_entity, MAX(id_calculation) as max_id, reference as calc_reference
                 FROM calculation_results
                 WHERE calculation_type = 1
                 GROUP BY id_entity) as cr_max', 'cr_max.id_entity = recruitments.id_person', 'left')
        ->join('calculation_results cr', 'cr.id_calculation = cr_max.max_id', 'left')
        ->where('recruitments.id_vacancy', $IdVaga)
        ->groupBy('recruitments.id_person');

    
    // Aplica a condição de etapa, se definida

    if (!empty($text)) {
        // Set $reference to the value from the POST request
        $candidatos->like('persons.name', $text);
    }
    if (!empty($favorite)) {
        // Set $reference to the value from the POST request
        $candidatos->where('persons.favorite', $favorite);
    }
    if (!empty($etapa)) {
        // Set $reference to the value from the POST request
        $candidatos->where('persons.step', $etapa);
    }
    $candidatos = $candidatos->findAll();
    
    
        $JobRoleModel = new JobRoleModel();
        $jobroles = $JobRoleModel->select('job_roles.*, departments.description as departamento')
        ->join('departments', 'job_roles.id_department = departments.id_department')
        ->join('calculation_results', 'calculation_results.id_entity = job_roles.id_job AND calculation_results.calculation_type = 2')
        ->where('job_roles.id_company', $company_id)
        ->findAll();
    
    //var_dump($candidatos);
    
    
    //die();

    $calculationResultsModel = new CalculationResultModel();
    $calculationResults = $calculationResultsModel
    ->select('calculation_results.*, job_roles.*')
    ->join('job_roles', 'job_roles.id_job = calculation_results.id_entity', 'left')
    ->where('calculation_results.calculation_type', 2)
    ->where('calculation_results.id_entity', $vacancie['id_job'])
    ->orderBy('calculation_results.id_calculation', 'DESC')
    ->first();







    if (empty($calculationResults)) {
        $data = [
            'departments' => $departments,
            'job' => $query[0],
            'skillsvalue' => '0', // Definindo como '0' inicialmente
            'attributes' => [
                "decision" => "0",
                "detail" => "0",
                "enthusiasm" => "0",
                "relational" => "0",
            ],
            'ftext' => $text,
            'ffavorite' => $favorite,
            'fetapa' => $etapa,
            'vaga' => $vacancie,
            'jobs' => $jobroles,
            'datacriacao' => $DataCriacao,
            'diascriacao' => $DiasCriacao,
            'candidatos' => $candidatos,
        ];
        

    } else {
        $attributes = json_decode($calculationResults['attributes'], true);
        $data['calculation_results'] = $calculationResults;
        $skills = json_decode($calculationResults['skills'], true);
        $skillsvaluearray = [];
        foreach ($skills as $skill) {
            $skillsvaluearray[] = floatval($skill['value']);
        }

        $skillsvalue = json_encode($skillsvaluearray);
        $data['skills'] = $skills;
        $data['attributes'] = $attributes;
        $data['skillsvalue'] = $skillsvalue;

        $data = [
            'calculation_results' => $calculationResults,
            'skills' => $skills,
            'attributes' => $attributes,
            'skillsvalue' => $skillsvalue,
            'ftext' => $text,
            'ffavorite' => $favorite,
            'fetapa' => $etapa,
            'vaga' => $vacancie,
            'jobs' => $jobroles,
            'datacriacao' => $DataCriacao,
            'diascriacao' => $DiasCriacao,
            'candidatos' => $candidatos,
        ];
    }

        
        // Realizar a consulta


        //var_dump($candidatos);
        //die();
        return view('AboutVagaView', $data);
    }




    public function index($page = 1)
    {
        $company_id = session()->get('user')->id_company;
        $search = $this->request->getVar('search'); 
        $perPage = 10; // Quantidade de registros por página
        $vacanciesModel = new VacancieModel();




        $vacanciesModel->select('vacancies.*, job_roles.description as job_description')
            ->join('job_roles', 'job_roles.id_job = vacancies.id_job')
            ->where('vacancies.id_company', $company_id);

        if (!empty($search)) {
            $results = $vacanciesModel->like('vacancies.description', $search)
                                      ->paginate($perPage, 'vacancies');
            $totalRows = $vacanciesModel->like('vacancies.description', $search)
                                        ->countAllResults();
        } else {
            $results = $vacanciesModel->paginate($perPage, 'vacancies');
            $totalRows = $vacanciesModel->countAllResults();
        }
    
        // Percorra os resultados e atualize o status para aqueles com data de expiração vencida
        foreach ($results as &$vacancy) {
            $expirationDate = Time::parse($vacancy['expiration_date']);
    
            if ($expirationDate < Time::now()) {
                // A data de expiração já passou, defina o status como 0
                $vacancy['status'] = 0;
            }
        }
    
        $pager = $vacanciesModel->pager;
    
        $data = [
            'search' => $search,
            'title' => 'Colaboradores InPerson',
            'perpage' => $perPage,
            'vacancies' => $results,
            'pager' => $pager,
            'totalRows' => $totalRows,
            'currentPage' => $this->request->getVar('page_vacancies') ? $this->request->getVar('page_vacancies') : 1,
            'status' => '1',
        ];
    
        return view('VacanciesView', $data);
    }






    public function show($id)
    {
        echo 'Showing details of employee with ID: ' . $id;
    }

    public function create()
    {
        $company_id = session()->get('user')->id_company;
        $JobRoleModel = new JobRoleModel();
        $jobroles = $JobRoleModel->select('job_roles.*, departments.description as departamento')
        ->join('departments', 'job_roles.id_department = departments.id_department')
        ->join('calculation_results', 'calculation_results.id_entity = job_roles.id_job AND calculation_results.calculation_type = 2')
        ->where('job_roles.id_company', $company_id)
        ->findAll();
    
        
        $data = [
            'step' => 1,
            'title' => 'Nova Vaga InPerson',
            'jobs' => $jobroles
        ];
        return view('NewVacancieView', $data);
    }

    public function store()
    {

        $company_id = session()->get('user')->id_company;
    
        $vacanciesModel = new VacancieModel();
    

        $post = $this->request->getPost();

        $faixa_salarial = $this->request->getPost('faixa_salarial');

        // Verifica se a faixa salarial começa com um número
        if (preg_match('/^\d/', $faixa_salarial)) {
            // Formata a faixa salarial como um valor monetário em reais
            $faixa_salarial = 'R$ ' . number_format($faixa_salarial, 2, ',', '.');
        }

$description = $this->request->getPost('description');
$vacancies_number = $this->request->getPost('vacancies_number');
$job_local = $this->request->getPost('job_local');
$type = $this->request->getPost('type');
$confidencialidade = $this->request->getPost('confidencialidade');
$senioridade = $this->request->getPost('senioridade');
$benefits = $this->request->getPost('benefits');
$activities = $this->request->getPost('activities');
$requeriments = $this->request->getPost('requeriments');
$job = $this->request->getPost('job');
$expiration = $this->request->getPost('expiration');
$q1 = $this->request->getPost('q1'); 
$q2 = $this->request->getPost('q2'); 
$q3 = $this->request->getPost('q3'); 
$q4 = $this->request->getPost('q4'); 
$q5 = $this->request->getPost('q5'); 
$horario = $this->request->getPost('horario'); 
$resume = $this->request->getPost('resume'); 

$vacanciesModel->insert([

    'id_company' => $company_id,
    'description' => $description,
    'vacancies_number' => $vacancies_number,
    'type_vacancie' => $type,
    'confidential' => $confidencialidade,
    'salary' => $faixa_salarial,
    'benefits' => $benefits,
    'seniority' => $senioridade,
    'activities' => $activities,
    'requirements' => $requeriments,
    'id_job' => $job,
    'expiration_date' => $expiration,
    'status' => 1,
    'local' => $job_local,
    'q1' => $q1,
    'q2' => $q2,
    'q3' => $q3,
    'q4' => $q4,
    'q5' => $q5,
    'working_hours' => $horario,
    'resume' => $resume,
]);


return redirect()->route('vacancies')->with('alert', 'Vaga Cadastrada com sucesso!');
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

        $vacancieModel = new vacancieModel();

        $vacancie = $vacancieModel->select('vacancies.*, job_roles.description as job_description, job_roles.id_job as job_id')
        ->join('job_roles', 'job_roles.id_job = vacancies.id_job')
        ->where('vacancies.reference', $reference)
        ->first();
        $JobRoleModel = new JobRoleModel();
        $jobroles = $JobRoleModel->select('*')->where('id_company', $company_id)->findAll();

        $data = [
            'vacancie' => $vacancie,
            'jobs' => $jobroles,
        ];



        return view('AboutVacancieView', $data);

    }



    public function update($id)
    {
      
        $company_id = session()->get('user')->id_company;
    
        $vacanciesModel = new VacancieModel();

        $post = $this->request->getPost();


    $description = $this->request->getPost('description');
    $vacancies_number = $this->request->getPost('vacancies_number');
    $job_local = $this->request->getPost('job_local');
    $type = $this->request->getPost('type');
    $confidencialidade = $this->request->getPost('confidencialidade');
    $faixa_salarial = $this->request->getPost('faixa_salarial');
    $senioridade = $this->request->getPost('senioridade');
    $benefits = $this->request->getPost('benefits');
    $activities = $this->request->getPost('activities');
    $requeriments = $this->request->getPost('requeriments');
    $resume = $this->request->getPost('resume');
    $job = $this->request->getPost('job');
    $expiration = $this->request->getPost('expiration');
    
    $id_vacancie = $this->request->getPost('id_vacancie');
    $reference = $this->request->getPost('reference');
    $working_hours = $this->request->getPost('working_hours');


        $data = [
            'id_company' => $company_id,
            'description' => $description,
            'vacancies_number' => $vacancies_number,
            'type_vacancie' => $type,
            'confidential' => $confidencialidade,
            'salary' => $faixa_salarial,
            'benefits' => $benefits,
            'seniority' => $senioridade,
            'activities' => $activities,
            'requirements' => $requeriments,
            'id_job' => $job,
            'expiration_date' => $expiration,
            'status' => 1,
            'resume' => $resume,
            'local' => $job_local,
            'working_hours' => $working_hours
            // Adicione outras colunas e valores conforme necessário
        ];
        
$vacancieModel = new vacancieModel();
        
        // Query para atualizar os dados na tabela job_roles
        $vacancieModel->update($id_vacancie, $data);

       return redirect()->to(base_url('vaga/' . $reference))->with('alert', 'Dados Atualizados Com sucesso!!');
    }


// No seu controlador
public function updateStep()
{
    $personReference = $this->request->getPost('person_reference');
    $step = $this->request->getPost('step');


    $personsModel = new PersonModel();

    // Consultar id_person usando reference
    $person = $personsModel->where('reference', $personReference)->first();

    if ($person) {
        $idPerson = $person['id_person'];

        // Atualizar o campo step usando id_person
        $personsModel->update($idPerson, ['step' => $step]);

        return $this->response->setStatusCode(200);
    } else {
        // Se não encontrar a pessoa, retorne um erro
        return $this->response->setStatusCode(404, 'Pessoa não encontrada - '.$step);
    }


}


// No seu controlador
public function updateClassification()
{
    $personReference = $this->request->getPost('person_reference');
    $classification = $this->request->getPost('classification');



    
    $personsModel = new PersonModel();

    // Consultar id_person usando reference
    $person = $personsModel->where('reference', $personReference)->first();

    if ($person) {
        $idPerson = $person['id_person'];

        // Atualizar o campo classification usando id_person
        $personsModel->update($idPerson, ['classification' => $classification]);

        return $this->response->setStatusCode(200);
    } else {
        // Se não encontrar a pessoa, retorne um erro
        return $this->response->setStatusCode(404, 'Pessoa não encontrada');
    }










}



// RecruitmentController.php
public function updateNotes() {
    // Obtenha os dados enviados via POST
    $id_person = $this->request->getPost('id_person');
    $anotacao = $this->request->getPost('anotacao');




    // Valide e sanitize os dados conforme necessário
    if (empty($id_person) || empty($anotacao)) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Dados inválidos']);
    }

    // Atualize as anotações no banco de dados
    $personsModel = new PersonModel();
    $result = $personsModel->update($id_person, ['anotacoes' => $anotacao]);

    if ($result) {
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Falha ao atualizar']);
    }
}


public function newInterview() {
    // Obtenha os dados enviados via POST
    var_dump($this->request->getPost());
    $id_recruitment = $this->request->getPost('id');
    
    $datetime = new \DateTime($this->request->getPost('datetime'));

    $formattedDateTime = $datetime->format('d/m/Y H:i');

    // Construir o texto
    $text = $formattedDateTime . " - " . $this->request->getPost('local') ;;
    $vacancie = $this->request->getPost('vacancie') ;


    $recruitmentsModel = new RecruitmentsModel();
    $result = $recruitmentsModel->update($id_recruitment, ['interview' => $text]);

    return redirect()->to(base_url('vaga/'. $vacancie))->with('alert', 'Dados Atualizados Com sucesso!!');
}


}
