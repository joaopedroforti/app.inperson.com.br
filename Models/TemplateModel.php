<?php namespace App\Models;

use CodeIgniter\Model;

class TemplateModel extends Model
{
    protected $table = 'templates';
    protected $primaryKey = 'id_template';
    protected $allowedFields = ['name_template', 'type_template', 'content', 'updated_at'];
}
