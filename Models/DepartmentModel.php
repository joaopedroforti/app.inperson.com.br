<?php namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id_department';
    protected $allowedFields = ['reference', 'id_company', 'description', 'id_manager', 'status', 'creation_date'];
}
