<?php

namespace App\Models;

use CodeIgniter\Model;

class Gestion_AlumnosModel extends Model
{
    protected $table      = 'gestion_alumnos';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_personas', 'id_institutos', 'id_carrera', 'anolectivo', 'curso', 'estado', 'egreso', 'observaciones'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}