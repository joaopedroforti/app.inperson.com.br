<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PersonModel;
use App\Models\CalculationResultModel;
use App\Models\JobRoleModel;


class MatcherController extends Controller
{
    public function index()
    {


        $company_id = session()->get('user')->id_company;
        $personModel = new PersonModel();
        $querypersons = $personModel->builder()
    ->select('persons.reference, persons.avatar, persons.id_person, persons.name as full_name, cr.result_name as behavioral_profile, job_roles.description as job_title, departments.description as department')
    ->join('calculation_results cr', 'persons.id_person = cr.id_entity', 'left')
    ->join('job_roles', 'persons.id_job = job_roles.id_job', 'left')
    ->join('departments', 'job_roles.id_department = departments.id_department', 'left')
    ->where('persons.id_company', $company_id)
    ->where('cr.calculation_type', 1);

    $persons = $querypersons->get()->getResult();


    $job_roles_model = new JobRoleModel();
    $queryJobs = $job_roles_model->builder()
    ->select('job_roles.*, departments.description as department_name')
    ->join('departments', 'job_roles.id_department = departments.id_department', 'left')
    ->where('job_roles.id_company', $company_id)
    ->where('job_roles.status', 1);

$jobs = $queryJobs->get()->getResult();

      //die();
        $data = [
            'step' => 1,
            'jobs' => $jobs,
            'persons' => $persons,
            'title' => 'Matcher InPerson'
        ];
        return view('MatcherView', $data);
    }


    public function view()
    {
        $dadosPost = $this->request->getVar();
   
        $persondetail= new PersonModel();
        $jobdetail= new JobRoleModel();

        if ($this->request->getPost('option1') === '01') {
            if ($this->request->getPost('value1')[0] ===''){
                $identity = $this->request->getPost('value1')[1];
            }
            else{$identity = $this->request->getPost('value1')[0];}

            $calculationResults = $persondetail->select('calculation_results.*, DATE_FORMAT(calculation_results.calculed_at, "%d/%m/%Y %H:%i") as formatted_calculed_at, persons.name')
            ->join('calculation_results', 'calculation_results.id_entity = persons.id_person')
            ->join('persons as p', 'p.id_person = calculation_results.id_entity')
            ->where('calculation_results.calculation_type', 1)
            ->where('calculation_results.id_entity', $identity)
            ->findAll();


            $name = $calculationResults[0]['name'];
            $attributes = json_decode($calculationResults[0]['attributes'], true);
            $skills = json_decode($calculationResults[0]['skills'], true);
            $skillsvaluearray = [];
                foreach ($skills as $skill) {
                    $skillsvaluearray[] = floatval($skill['value']) * 0.9;;
                                            }
            
                                            $skillsvalue01 = json_encode($skillsvaluearray);
             $data['name01'] = $name;
             $data['attributes01'] = $attributes;
             $data['skillsvalue01'] = $skillsvalue01;

           
        } else {
            if ($this->request->getPost('value1')[0] ===''){
                $identity = $this->request->getPost('value1')[1];
            }
            else{$identity = $this->request->getPost('value1')[0];}
            $calculationResults = $jobdetail->select('calculation_results.*, job_roles.description')
            ->join('calculation_results', 'calculation_results.id_entity = job_roles.id_job') 
            ->where('calculation_results.calculation_type', 2)
            ->where('calculation_results.id_entity', $identity)
            ->findAll();
        
            $name = $calculationResults[0]['description'];
            $attributes = json_decode($calculationResults[0]['attributes'], true);
            $skills = json_decode($calculationResults[0]['skills'], true);
            $skillsvaluearray = [];
                foreach ($skills as $skill) {
                    $skillsvaluearray[] = floatval($skill['value']) * 0.9;;
                                            }
                                            $skillsvalue01 = json_encode($skillsvaluearray);
             $data['name01'] = $name;
             $data['attributes01'] = $attributes;
             $data['skillsvalue01'] = $skillsvalue01;
            
          
        }








       

        if ($this->request->getPost('option2') === '01') {
            if ($this->request->getPost('value2')[0] ===''){
                $identity2 = $this->request->getPost('value2')[1];
            }
            else{$identity2 = $this->request->getPost('value2')[0];}


            $calculationResults2 = $persondetail->select('calculation_results.*, DATE_FORMAT(calculation_results.calculed_at, "%d/%m/%Y %H:%i") as formatted_calculed_at, persons.name')
            ->join('calculation_results', 'calculation_results.id_entity = persons.id_person')
            ->join('persons as p', 'p.id_person = calculation_results.id_entity')
            ->where('calculation_results.calculation_type', 1)
            ->where('calculation_results.id_entity', $identity2)
            ->findAll();

        
          
            $name2 = $calculationResults2[0]['name'];
            $attributes2 = json_decode($calculationResults2[0]['attributes'], true);
            $skills2 = json_decode($calculationResults2[0]['skills'], true);
            $skillsvaluearray2 = [];
foreach ($skills2 as &$skill2) { // Usando "&" para modificar os valores diretamente no array original
    $skillsvaluearray2[] = floatval($skill2['value']);
}
            
$skillsvalue02 = json_encode($skillsvaluearray2);
             $data['name02'] = $name2;
             $data['attributes02'] = $attributes2;
             $data['skillsvalue02'] = $skillsvalue02;
            
 
        } else {
            if ($this->request->getPost('value2')[0] ===''){
                $identity2 = $this->request->getPost('value2')[1];
            }
            else{$identity2 = $this->request->getPost('value2')[0];}
            $calculationResults2 = $jobdetail->select('calculation_results.*, job_roles.description')
            ->join('calculation_results', 'calculation_results.id_entity = job_roles.id_job') 
            ->where('calculation_results.calculation_type', 2)
            ->where('calculation_results.id_entity', $identity2)
            ->findAll();
        
            $name2 = $calculationResults2[0]['description'];
            $attributes2 = json_decode($calculationResults2[0]['attributes'], true);
            $skills2 = json_decode($calculationResults2[0]['skills'], true);
            $skillsvaluearray2 = [];
                foreach ($skills2 as $skill2) {
                    $skillsvaluearray2[] = floatval($skill2['value']);
                                            }
                                            $skillsvalue02 = json_encode($skillsvaluearray2);
             $data['name02'] = $name2;
             $data['attributes02'] = $attributes2;
             $data['skillsvalue02'] = $skillsvalue02;
            
     
        }



        $data['step'] = 2;

        return view('MatcherView', $data);









        
        //var_dump($data);
        // Var_dump dos dados do POST
        //var_dump($dadosPost);
    }



    public function show($id)
    {

    }

    public function create()
    {

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
