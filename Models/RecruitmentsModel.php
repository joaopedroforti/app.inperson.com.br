<?php

namespace App\Models;

use CodeIgniter\Model;

class RecruitmentsModel extends Model
{
    protected $table = 'recruitments';
    protected $primaryKey = 'id_recruitment';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_company', 
        'id_person', 
        'id_vacancy', 
        'questions', 
        'curriculum', 
        'creation_date',
        'interview'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'creation_date';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
