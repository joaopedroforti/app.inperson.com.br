<?php namespace App\Models;

use CodeIgniter\Model;

class EducationLevelModel extends Model
{
    protected $table = 'education_levels';
    protected $primaryKey = 'id_education';
    protected $allowedFields = ['description'];
}
