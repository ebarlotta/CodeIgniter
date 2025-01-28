<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PersonasModel;
use App\Models\DepartamentosModel;
use PasswordHash;

class personas extends BaseController
{
    protected $personas, $session, $reglaslogin, $departamentos;

    public function __construct()
    {
        $this->session = session();
        $this->reglaslogin=['user'=>'required', 'pass'=>'required'];
        $this->personas= new PersonasModel();
        $this->departamentos = new DepartamentosModel();
    }

    public function index()
    {

    }

    // Editar datos personales por parte del usuario
	public function perfil()
	{
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $persona=$this->personas->where('ID',$this->session->user_id)->first();
        $deptos=$this->departamentos->findAll();

		$data =['vTITULO' => 'Editar datos Personales', 'vPERSONA' => $persona, 'vDEPARTAMENTOS' => $deptos];

        echo view('header');
        echo view('personas/perfil', $data);
        echo view('footer');
	}

    // Actualizar datos personales por parte del usuario
    public function actualizar_perfil()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $this->personas->update($this->session->user_id, [
            'user_apellido' => $this->request->getPost('apellido'),
            'user_nombres' => $this->request->getPost('nombres'),
            'user_dni' => $this->request->getPost('dni'),
            'user_cuil' => $this->request->getPost('cuil'),
            'user_telefono' => $this->request->getPost('telefono'),
            'user_civil' => $this->request->getPost('civil'),
            'user_domicilio' => $this->request->getPost('domicilio'),
            'user_domiciliolegal' => $this->request->getPost('domiciliolegal'),
            'user_nacimiento' => $this->request->getPost('nacimiento'),
            'user_ocupacion' => $this->request->getPost('ocupacion'),
            'user_secundaria' => $this->request->getPost('secundaria'),
            'user_secundaria_terminada' => $this->request->getPost('terminada'),
            'user_departamento_id' => $this->request->getPost('user_departamento_id'),
            ]);

        return redirect()->to(base_url().'/home');
    }

    // Login del Sistema
    public function login(){
        echo view('login');
    }

    // Validacion de Login
    public function valida(){

        if ($this->request->getMethod() == "post" && $this->validate($this->reglaslogin)){
            $user=$this->request->getPost('user');
            $pass=$this->request->getPost('pass');

            $persona=$this->personas->where('user_email', $user)->first();

            $passwordHash = new PasswordHash(8, false);

            if($persona != null){
                if ($passwordHash->CheckPassword($pass, $persona['user_pass'])) {

                    $datossesion=[
                        'user_id'=>$persona['id'],
                        'user_email'=>$persona['user_email'],
                        'user_dni'=>$persona['user_dni'],
                    ];
                    $session= session();
                    $session->set($datossesion);
                    return redirect()->to(base_url() . '/home');

                } else {
                    $data['error']="Datos Incorrectos";
                    echo view('/login', $data);
                }
            } else {
                $data['error']="Datos Incorrectos";
                echo view('/login', $data);
            }

        } else {
            $data=['validation' => $this->validator];
            echo view('/login', $data);
        }
    }

    // Salir del Sistema
    public function logout(){
        $session=session();
        $session->destroy();
        return redirect()->to(base_url().'/personas/login');
    }

    // Recuperar Contraseña
	public function password()
	{
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $persona=$this->personas->where('ID',$this->session->user_id)->first();
		$data =['vTITULO' => 'Recuperar Contraseña', 'vPERSONA' => $persona];

		echo view('header');
		echo view('personas/password', $data);
		echo view('footer');
	}

    // Actualizar Contraseña en DB
    public function actualizar_password()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        
        $password = new PasswordHash(8, true);

        $this->personas->update($this->session->user_id, [
            'user_pass' => $password->HashPassword(trim($this->request->getPost('pass')))
            ]);

        return redirect()->to(base_url().'/home');
    }

	public function recuperar()
	{
        echo view('personas/recuperar');
	}

}

