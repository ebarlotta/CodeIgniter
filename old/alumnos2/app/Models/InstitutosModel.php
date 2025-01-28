<?php
namespace App\Models;
use CodeIgniter\Model;

class InstitutosModel extends Model
{
    protected $table      = 'institutos';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['numero', 'nombre', 'cue', 'direccion', 'email', 'telefono', 'rol', 'notas', 'pass'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}