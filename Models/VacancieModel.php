<?php namespace App\Models;

use CodeIgniter\Model;

class VacancieModel extends Model
{
    protected $table = 'vacancies';
    protected $primaryKey = 'id_vacancie';
    protected $allowedFields = [];

    public function __construct()
    {
        parent::__construct();
        $this->allowedFields = $this->db->getFieldNames('vacancies');
    }
}
