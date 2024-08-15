<?php namespace App\Models;

use CodeIgniter\Model;

class MaritalStatusModel extends Model
{
    protected $table = 'marital_statuses';
    protected $primaryKey = 'id_marital';
    protected $allowedFields = ['description'];
}
