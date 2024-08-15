<?php namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id_company';
    protected $allowedFields = ['reference', 'company_name', 'financial_phone', 'financial_email', 'document_number', 'industry', 'adress_zip', 'adress_number', 'id_manager', 'registration_date', 'primary_color', 'slug', 'long_description' ,'video_url'];
}
