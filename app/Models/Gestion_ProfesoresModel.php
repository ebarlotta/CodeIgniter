<?php

namespace App\Models;

use CodeIgniter\Model;

class Gestion_ProfesoresModel extends Model
{
    protected $table      = 'gestion_profesores';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_personas', 'id_institutos', 'id_carrera', 'id_materia', 'estado'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}