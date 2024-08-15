<?php namespace App\Models;

use CodeIgniter\Model;

class GenderModel extends Model
{
    protected $table = 'genders';
    protected $primaryKey = 'id_gender';
    protected $allowedFields = ['description'];
}
