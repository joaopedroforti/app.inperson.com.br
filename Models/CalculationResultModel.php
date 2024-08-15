<?php namespace App\Models;

use CodeIgniter\Model;

class CalculationResultModel extends Model
{
    protected $table = 'calculation_results';
    protected $primaryKey = 'id_calculation';
    protected $allowedFields = ['reference', 'id_company', 'id_person', 'calculation_type', 'id_entity', 'response_time', 'request', 'result_name', 'result', 'attributes', 'skills', 'calculed_at'];
}
