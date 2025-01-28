<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriasModel extends Model
{
    protected $table      = 'materias';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'horas', 'carrera', 'ano', 'regimen', 'cuatrimestre', 'horasanuales', 'horasanuales', 'formato'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}