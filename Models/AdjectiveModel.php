<?php namespace App\Models;

use CodeIgniter\Model;

class AdjectiveModel extends Model
{
    protected $table = 'adjectives';
    protected $primaryKey = 'id_adjective';
    protected $allowedFields = ['reference', 'description'];
}
