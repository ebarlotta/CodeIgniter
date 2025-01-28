<?php

namespace App\Controllers;

Use App\Models\PersonasModel;

class Home extends BaseController
{
    protected $personas, $session, $reglaslogin, $departamentos;
    protected $alumnos;

    public function index(): string
    {
        $this->personas = new PersonasModel();

        // $datos=$this->personas->where('id',1)->first();
        $datos=$this->personas->where('id',1)->findall();

        $data = ['vAlumnos' => $datos];

        // echo var_dump($datos);
        // exit;
        // $datos = ['alumnos'=>'enzo','alumnos'=>'pedro'];
        // $data =['vTITULO' => 'Editar datos Personales'];

        return view('welcome_message', $data);
    }
}
