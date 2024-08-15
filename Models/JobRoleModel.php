<?php namespace App\Models;

use CodeIgniter\Model;

class JobRoleModel extends Model
{
    protected $table = 'job_roles';
    protected $primaryKey = 'id_job';
    protected $allowedFields = ['reference', 'id_company', 'id_department', 'description', 'long_description', 'status', 'creation_date', 'seniority'];
}
