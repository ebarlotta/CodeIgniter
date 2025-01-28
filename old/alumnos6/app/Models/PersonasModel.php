<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasModel extends Model
{
    protected $table      = 'personas';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_email', 'user_pass', 'user_estado', 'user_rol',
    'user_apellido', 'user_nombres', 'user_domicilio', 'user_telefono', 'user_dni', 'user_cuil', 'user_nacimiento', 'user_civil', 
    'user_domiciliolegal', 'user_domicilioreal', 'user_departamento_id', 'user_ocupacion', 'user_secundaria', 'user_secundaria_terminada'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function usuarios_lst() {
    $sql = "SELECT * FROM personas";
		$query = $this->db->query($sql);
		$result = $query->getResult();
        return $result;
    }
}