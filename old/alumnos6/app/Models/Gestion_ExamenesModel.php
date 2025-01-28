<?php

namespace App\Models;

use CodeIgniter\Model;

class Gestion_ExamenesModel extends Model
{
    protected $table      = 'gestion_examenes';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_mesa', 'id_persona', 'nota', 'estado'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}