<?php namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id_question';
    protected $allowedFields = ['id_question_type', 'question', 'classification'];
}
