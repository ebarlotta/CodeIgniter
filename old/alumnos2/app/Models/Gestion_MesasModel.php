<?php

namespace App\Models;

use CodeIgniter\Model;

class Gestion_MesasModel extends Model
{
    protected $table      = 'gestion_mesas';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_instituto', 'id_carrera', 'id_materia', 'presidente', 'vocal1', 'vocal2', 'fecha', 'libro', 'folio'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}