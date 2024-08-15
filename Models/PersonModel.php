<?php namespace App\Models;

use CodeIgniter\Model;

class PersonModel extends Model
{
    protected $table = 'persons';
    protected $primaryKey = 'id_person';
    protected $allowedFields = ['admission_date', 'contract_type', 'active', 'id_company', 'id_job', 'reference', 'id_person_type', 'avatar', 'id_gender', 'anotacoes', 'name', 'document_number', 'internal_email', 'personal_email', 'personal_phone', 'marital_status', 'formation_course', 'education_level', 'nascimento', 'adress_zip', 'adress_number', 'registration_date', 'favorite', 'step', 'classification'];
}
