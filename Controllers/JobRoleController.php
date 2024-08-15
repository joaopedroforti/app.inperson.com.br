<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\JobRoleModel;
use App\Models\DepartmentModel;
use App\Models\QuestionModel;
use App\Models\AdjectiveModel;
use App\Models\CalculationResultModel;

class JobRoleController extends BaseController
{
    public function index($page = 1)
    {
   
        $company_id = session()->get('user')->id_company;
        $search = $this->request->getVar('search'); // Obtendo o termo de pesquisa
        $jobRolesModel = new JobRoleModel();
        $perPage = 10; // Quantidade de registros por página
        
        // Query principal para buscar registros
        $jobRolesModel->select('job_roles.*, calculation_results.result_name, departments.description as department_description')
        ->join('calculation_results', 'calculation_results.id_entity = job_roles.id_job', 'left')
        ->join('departments', 'departments.id_department = job_roles.id_department')
        ->where('calculation_results.calculation_type', 2)
        ->where('job_roles.id_company', $company_id)
        ->orWhere('calculation_results.id_entity IS NULL')
        ->where('job_roles.id_company', $company_id);
        
        // Adicionando a condição LIKE se houver um termo de pesquisa
        if (!empty($search)) {
            $results = $jobRolesModel->like('job_roles.description', $search)
                                    ->paginate($perPage, 'job');


                                    $registros = $jobRolesModel->where('job_roles.id_company', $company_id)
                           ->countAllResults();
                                    
$totalRows = $jobRolesModel->like('job_roles.description', $search)
                           ->where('job_roles.id_company', $company_id)
                           ->countAllResults();

        } else {
            $results = $jobRolesModel->paginate($perPage, 'job');
            $totalRows = $jobRolesModel->countAllResults();

            $registros = $jobRolesModel->where('job_roles.id_company', $company_id)
            ->countAllResults();
        }
    
        $pager = $jobRolesModel->pager;
        
        $data = [
            'registros' => $registros,
            'title' => 'Colaboradores InPerson',
            'perpage' => $perPage,
            'jobs' => $results,
            'pager' => $pager,
            'totalRows' => $totalRows,
            'currentPage' => $this->request->getVar('page_job') ? $this->request->getVar('page_job') : 1,
        ];








        return view('JobRolesView', $data);
    }






    public function view($reference)
    {
        $company_id = session()->get('user')->id_company;


        $departmentModel = new DepartmentModel();
        $departments = $departmentModel->where('id_company', $company_id)->findAll();
        $jobRolesModel = new JobRoleModel();

        $query = $jobRolesModel->select('job_roles.*, departments.description as department_description')
        ->join('departments', 'departments.id_department = job_roles.id_department', 'left')
        ->where('job_roles.id_company', $company_id)
        ->where('job_roles.reference', $reference)
        ->findAll();

        $calculationResultsModel = new CalculationResultModel();

        $calculationResults = $calculationResultsModel
            ->select('calculation_results.*, job_roles.*')
            ->join('job_roles', 'job_roles.id_job = calculation_results.id_entity', 'left')
            ->where('calculation_results.calculation_type', 2)
            ->where('calculation_results.id_entity', $query[0]['id_job'])
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
                'title' => 'Edição de Cargo InPerson'
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
                'job' => $query[0],
                'calculation_results' => $calculationResults,
                'skills' => $skills,
                'attributes' => $attributes,
                'skillsvalue' => $skillsvalue,
                'departments' => $departments,
                'title' => 'Edição de Cargo InPerson'
            ];
        }


    
    

        
        return view('AboutJobView', $data);

    var_dump($data);
    }







    public function create()
    {
        $company_id = session()->get('user')->id_company;
        $departmentModel = new DepartmentModel();

        $departments = $departmentModel->where('id_company', $company_id)->findAll();


        $adjectivesmodel = new AdjectiveModel();
        $adjectives = $adjectivesmodel->get()->getResult();
//var_dump($adjectives);
        //die();
        $QuestionModel = new QuestionModel();
        // Busca todos os resultados como objetos
$allQuestions = $QuestionModel->where('id_question_type', 2)
->orderBy('classification', 'ASC')
->get()
->getResult();

        $questions = $QuestionModel->where('id_question_type', 2)->orderBy('classification', 'ASC')->limit(15)->get()->getResult();
        $questions2 = array_slice($allQuestions, 15);
        

        $data = [
            'adjectives' => $adjectives,
            'questions' => $questions,
            'questions2' => $questions2,
            'departments' => $departments,
            'step' => 1,
            'title' => 'Novo Cargo InPerson'
        ];

        
        return view('NewJobRoleView', $data);
    }



    public function store()
    {
        $post = $this->request->getPost();


        $company_id = session()->get('user')->id_company;
        $today = date('Y-m-d');
        $now = date("Y-m-d H:i:s");

            $description = $post['description'];
            $long_description = $post['long_description'];
            $id_department = $post['department'];
            $senioridade = $post['senioridade'];



         // Dados para inserção
$data = [
    'id_company' => $company_id,
    'id_department' => $id_department,
    'description' => $description,
    'long_description' => $long_description,
    'creation_date' => $today,
    'seniority' => $senioridade,
    'status' => 0
    // Adicione mais colunas e variáveis conforme necessário
];
$jobRoleModel = new JobRoleModel();
// Inserir na tabela 'job_roles'
$jobRoleModel->insert($data);

// Retornar o id_job inserido
$id_job = $jobRoleModel->insertID();

// Buscar o $reference
$reference = $jobRoleModel->select('reference')->where('id_job', $id_job)->get()->getRow()->reference;
$data = [
    'reference' => $reference
];
          
                return view('JobCreatedView', $data);
    
    }



    public function questionarie($reference)
    {


        $company_id = session()->get('user')->id_company;
        $departmentModel = new DepartmentModel();

        $departments = $departmentModel->where('id_company', $company_id)->findAll();


        $adjectivesmodel = new AdjectiveModel();
        $adjectives = $adjectivesmodel->get()->getResult();
//var_dump($adjectives);
        //die();
        $QuestionModel = new QuestionModel();
        // Busca todos os resultados como objetos
$allQuestions = $QuestionModel->where('id_question_type', 2)
->orderBy('classification', 'ASC')
->get()
->getResult();

        $questions = $QuestionModel->where('id_question_type', 2)->orderBy('classification', 'ASC')->limit(15)->get()->getResult();
        $questions2 = array_slice($allQuestions, 15);
        


$jobRoleModel = new jobRoleModel();
// Buscar tudo de job_roles onde reference = $reference
$jobRoleData = $jobRoleModel->where('reference', $reference)->First();





$data = [
    'id_job' => $jobRoleData['id_job'],
    'reference' => $jobRoleData['reference'],
    'adjectives' => $adjectives,
    'questions' => $questions,
    'questions2' => $questions2,
    'departments' => $departments,
    'step' => 1,
    'title' => 'Novo Cargo InPerson'
];

        return view('JobFormView', $data);
    }











    public function store2()
    {
        $post = $this->request->getPost();

        $company_id = session()->get('user')->id_company;
        $today = date('Y-m-d');
        $now = date("Y-m-d H:i:s");

        $questions = '';
        for ($i = 1; $i <= 31; $i++) {
            $questions .= $i . "_". $post[$i];
            if ($i < 31) {
                $questions .= ",";
            }
        }
    
            // Remove a última vírgula, se houver
            $questions = rtrim($questions, ',');

            $adjectiveValues = $post['adjectives'];

            // Converte o array de valores em uma string separada por vírgula
            $adjectives = implode(',', $adjectiveValues);

            $data = [
                "awnser_id" => "0",
                "client_id" => "0",
                "person_id" => "0",
                "questions" => $questions,
                "adjectives" => $adjectives
            ];
    
            // Inicializa a biblioteca cURL
            $curl = curl_init();
    
            // Define a URL da API
            $url = "https://inperson-a26cb019f272.herokuapp.com/v1/calculation";
    
            // Configura as opções da requisição POST
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json'
            ]);
    
            // Executa a requisição e obtém a resposta
            $response = curl_exec($curl);
    
            // Verifica se houve algum erro na requisição
            if ($response === false) {
                $error = curl_error($curl);
                curl_close($curl);
                return "Erro ao enviar requisição: " . $error;
            }
    
            // Fecha a conexão cURL
            curl_close($curl);
            $responseData = json_decode($response, true);
            // Imprime a resposta da API
            $skills = $responseData['skills'];

            $skillsString = '['; // Inicia a string com '['
            foreach ($skills as $skill) {
                $skillJson = json_encode($skill);
                $skillsString .= $skillJson . ',';
            }
            if (strlen($skillsString) > 1) {
                $skillsString = rtrim($skillsString, ',');
            }
            $skillsString .= ']';

            $atributes = [
                'decision' => $responseData['decision'],
                'detail' => $responseData['detail'],
                'enthusiasm' => $responseData['enthusiasm'],
                'relational' => $responseData['relational']
            ];
            
            





                $id_job = $post['id'];
                $reference = $post['reference'];
                $CalculationResultModel = new CalculationResultModel();

                // Dados para inserção
                $data_calc = [
                    'id_company' => $company_id,
                    'calculation_type' => 2,
                    'id_entity' => $id_job,
                    'request' => json_encode($post),
                    'result_name' => str_replace(',', ' e ', $responseData['profile']),
                    'result' => json_encode($responseData), // Convertendo o array em uma string JSON
                    'attributes' => json_encode($atributes), // Convertendo o array em uma string JSON
                    'skills' => $skillsString,
                    'calculed_at' => $now
                    // Adicione mais colunas e variáveis conforme necessário
                ];
            

                $data = [
                    'status' => 1
                ];
                $jobRolesModel = New jobRoleModel;

                $jobRolesModel->where('reference', $reference)->set($data)->update();
    
    
                
                // Inserir na tabela 'job_roles'
                $CalculationResultModel->insert($data_calc);
                return redirect()->route('jobroles')->with('alert', 'Perfil Criado com sucesso.');
    
    }

    public function edit($id)
    {
        echo 'Form to edit employee with ID: ' . $id;
    }

    public function update($id)
    {
        $post = $this->request->getPost();
        $company_id = session()->get('user')->id_company;


        $id_job = $post['id_job'];
        $description = $post['description'];
        $long_description = $post['long_description'];
        $id_department = $post['department'];
        $reference = $post['reference'];
        $senioridade = $post['senioridade'];
        $data = [
            'description' => $description,
            'long_description' => $long_description,
            'id_department' => $id_department,
            'seniority' => $senioridade
            // Adicione outras colunas e valores conforme necessário
        ];
        
$jobRolesModel = new JobRoleModel();
        
        // Query para atualizar os dados na tabela job_roles
        $jobRolesModel->update($id_job, $data);

       return redirect()->to(base_url('/jobroles/view/' . $reference))->with('alert', 'Dados Atualizados Com sucesso!!');
    }

    public function delete($id)
    {
        // Lógica para excluir o funcionário com o ID fornecido
    }
}
