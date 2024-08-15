<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\JobRoleModel;
use App\Models\DepartmentModel;
use App\Models\CalculationResultModel;
use App\Models\TemplateModel;
class ReportController extends Controller
{
    public function completeview($reference)
    {
        $calculationResultsModel = new CalculationResultModel();

        $calculation = $calculationResultsModel
        ->select('calculation_results.*, persons.name as person_name')
        ->join('persons', 'persons.id_person = calculation_results.id_entity')
        ->where('calculation_results.reference', $reference)
        ->first();
    


$result_name = strtolower(str_replace(' ', '_', $calculation['result_name']));

//var_dump($result_name);
//die();
$TemplateModel = new TemplateModel();

// Buscar o template pelo nome
$template = $TemplateModel
    ->select('content')
    ->where('name_template', $result_name)
    ->first();

if (!empty($template)) {
    $templatepage = $template['content'];
}

// Buscar o template da capa
$templatecapa = $TemplateModel
    ->select('content')
    ->where('name_template', 'capa')
    ->first();

if (!empty($templatecapa)) {
    $templatecapa = $templatecapa['content'];
}





$template = $templatecapa . $templatepage;


$attributes = json_decode($calculation['attributes'], true);
            $skills = json_decode($calculation['skills'], true);
            $skillsvaluearray = [];
                foreach ($skills as $skill) {
                    $skillsvaluearray[] = floatval($skill['value']*0.9);
                                            }
            
                                            
                                            $skillsvalue = json_encode($skillsvaluearray);
                                        

// Função para analisar e substituir as tags no modelo
function parseTemplate($template, $bindings) {
    foreach ($bindings as $key => $value) {
        $template = str_replace('{' . $key . '}', $value, $template);
    }
    return $template;
}


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

// Dados para substituir no modelo
$tagValues = [
    'name' => $calculation['person_name'],
    'date' => $calculation['calculed_at'],
    'response_time' => 'name',
    'resultado_name' => $calculation['result_name'],
    'decision' => $attributes['decision'],
    'detail' => $attributes['detail'],
    'enthusiasm' => $attributes['enthusiasm'],
    'relational' => $attributes['relational'],
    'skills' => $skillsvalue,
    'logocapa' => base_url('assets/reports/logo.png')
];
// Aplicar os dados no modelo
$templateFinal = parseTemplate($template, $tagValues);

$data['templateFinal'] = $templateFinal;


return view('ReportView', $data);

    }




    public function simplifyview($reference)
    {
        $calculationResultsModel = new CalculationResultModel();

        $calculation = $calculationResultsModel
        ->select('calculation_results.*, persons.name as person_name')
        ->join('persons', 'persons.id_person = calculation_results.id_entity')
        ->where('calculation_results.reference', $reference)
        ->first();
    


$result_name = strtolower(str_replace(' ', '_', $calculation['result_name']));

//var_dump($result_name);
//die();
$TemplateModel = new TemplateModel();

// Buscar o template pelo nome
$template = $TemplateModel
    ->select('content')
    ->where('name_template', $result_name.'_min')
    ->first();

if (!empty($template)) {
    $templatepage = $template['content'];
}

// Buscar o template da capa
$templatecapa = $TemplateModel
    ->select('content')
    ->where('name_template', 'capa')
    ->first();

if (!empty($templatecapa)) {
    $templatecapa = $templatecapa['content'];
}





$template = $templatecapa . "</div>". $templatepage;


$attributes = json_decode($calculation['attributes'], true);
            $skills = json_decode($calculation['skills'], true);
            $skillsvaluearray = [];
                foreach ($skills as $skill) {
                    $skillsvaluearray[] = floatval($skill['value']);
                                            }
            
                                            
                                            $skillsvalue = json_encode($skillsvaluearray);




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



// Função para analisar e substituir as tags no modelo
function parseTemplate($template, $bindings) {
    foreach ($bindings as $key => $value) {
        $template = str_replace('{' . $key . '}', $value, $template);
    }
    return $template;
}



// Dados para substituir no modelo
$tagValues = [
    'name' => $calculation['person_name'],
    'date' => $calculation['calculed_at'],
    'response_time' => 'name',
    'resultado_name' => $calculation['result_name'],
    'decision' => $attributes['decision'],
    'detail' => $attributes['detail'],
    'enthusiasm' => $attributes['enthusiasm'],
    'relational' => $attributes['relational'],
    'skills' => $skillsvalue,
    'logocapa' => base_url('assets/reports/logo.png')
];
// Aplicar os dados no modelo
$templateFinal = parseTemplate($template, $tagValues);




$data['templateFinal'] = $templateFinal;

return view('ReportView', $data);

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
