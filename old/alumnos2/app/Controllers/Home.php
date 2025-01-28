<?php namespace App\Controllers;

Use App\Models\PersonasModel;
Use App\Models\InstitutosModel;
Use App\Models\Gestion_AlumnosModel;

class home extends BaseController
{
	protected $session, $personas, $alumnos, $institutos;
	
	public function __construct()
	{
		$this->session = session();
		$this->personas = new PersonasModel();
		$this->institutos = new InstitutosModel();
		$this->alumnos = new Gestion_AlumnosModel();
	}

	public function index()
	{
		if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
		
		$persona=$this->personas->where('user_email', $this->session->user_email)->first();
		
		// Revisamos si es alumno de algun IES
		$alumno=$this->alumnos
		->join('institutos', 'institutos.id = gestion_alumnos.id_institutos')
		->where('id_personas',$this->session->user_id)
		->findAll();

        $data=['vDATOS' => $persona, 'vALUMNO' => $alumno];

		echo view('header');
		echo view('home',$data);
		echo view('footer');
	}

    // Ayuda
	public function ayuda()
	{
		if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        echo view('header');
        echo view('ayuda');
        echo view('footer');
	}

}
