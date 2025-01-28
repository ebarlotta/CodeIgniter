<?php

namespace App\Models;

use CodeIgniter\Model;

class Gestion_CarrerasModel extends Model
{
    protected $table      = 'gestion_carreras';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_carrera', 'id_institutos', 'estado', 'nueva_cohorte', 'observaciones'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}