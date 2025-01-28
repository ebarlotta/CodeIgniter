<?php namespace App\Controllers;

Use App\Models\PersonasModel;
Use App\Models\Gestion_AlumnosModel;
Use App\Models\InstitutosModel;
Use App\Models\CarrerasModel;
Use App\Models\Gestion_CarrerasModel;
Use App\Models\Gestion_MesasModel;
Use App\Models\Gestion_ExamenesModel;
use App\Models\SettingsModel;

class alumnos extends BaseController
{
	protected $session, $settings, $personas, $gestion_alumnos, $institutos, $carreras, $gestion_carreras, $gestion_examenes, $gestion_mesas;
	
	public function __construct()
	{
		$this->session = session();
        $this->settings = new SettingsModel();

		$this->personas = new PersonasModel();
		$this->gestion_alumnos = new Gestion_AlumnosModel();
		$this->institutos = new InstitutosModel();
        $this->carreras = new CarrerasModel();
		$this->gestion_carreras = new Gestion_CarrerasModel();
        $this->gestion_mesas = new Gestion_MesasModel();
        $this->gestion_examenes = new Gestion_ExamenesModel();
	}

    // Inscripciones a Carreras
	public function index()
	{
		if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

		$inscripciones=$this->gestion_alumnos
        ->select('gestion_alumnos.*, institutos.numero, carreras.nombre, carreras.resolucion')
		->where('id_personas', $this->session->user_id)
		->join('institutos', 'institutos.id = gestion_alumnos.id_institutos')
		->join('carreras', 'carreras.id = gestion_alumnos.id_carrera')
		->findAll();

		$data =['vTITULO' => 'Inscripciones a Carreras', 'vDATOS' => $inscripciones];

		echo view('header');
		echo view('alumnos/inscripciones', $data);
		echo view('footer');	
	}

    // Nueva Inscripcion a Carrera
    public function nueva_inscripcion()
    {
        echo "entro;";
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        $abierta=$this->settings->where('id',1)->first();

        if ($abierta['inscripciones'] == 'SI'){

            // Institutos y Carreras Asignadas
            $carreras=$this->gestion_carreras
            ->select('gestion_carreras.*, institutos.numero, carreras.nombre, carreras.resolucion')
            ->where('estado','ACTIVO')
            ->where('nueva_cohorte','SI')
            ->join('institutos', 'institutos.id = gestion_carreras.id_institutos')
            ->join('carreras', 'carreras.id = gestion_carreras.id_carrera')
            ->orderBy('institutos.numero','asc')
            ->findAll();

            $data=['vTITULO' => 'Nueva Inscripción a Carrera', 'vCARRERAS' => $carreras];

            echo view('header');
            echo view('alumnos/nueva_inscripcion',$data);
            echo view('footer');

        } else {
            echo view('header');
            // echo view('acceso');
            echo view('footer');
        }
    }

    // Guardar Nueva Inscripcion
    public function inscribir()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $vCARRERA=$this->gestion_carreras->where('id',$this->request->getPost('carreras'))->first();

        if (!empty($vCARRERA) && $vCARRERA['nueva_cohorte'] == 'SI'){

            $this->gestion_alumnos->save([
                'id_personas' => $this->session->user_id,
                'id_institutos' => $vCARRERA['id_institutos'],
                'id_carrera' => $vCARRERA['id_carrera'],
                'anolectivo' => 2025,
            ]);

        }

        return redirect()->to(base_url().'/alumnos/index');
    }

    // Listado General de Examenes
    public function examenes()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        
        $datos=$this->gestion_examenes->select('gestion_examenes.*, gestion_mesas.*, materias.nombre, carreras.nombre AS vCARRERA, institutos.numero')
        ->where('id_persona',$this->session->user_id)
        ->join('gestion_mesas', 'gestion_mesas.id = gestion_examenes.id_mesa')
        ->join('materias', 'materias.id = gestion_mesas.id_materia')
        ->join('carreras', 'carreras.id = gestion_mesas.id_carrera')
        ->join('institutos', 'institutos.id = gestion_mesas.id_instituto')
        ->findAll();
        $data=['vTITULO' => 'Historial General de Exámenes', 'datos' => $datos];

        echo view('header');
        echo view('alumnos/examenes',$data);
        echo view('footer');
    }

    // Listado General de Examenes de carrera
    public function examenes_carrera($id)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        $carrera=$this->carreras->where('id',$id)->first();

        $datos=$this->gestion_examenes->select('gestion_examenes.*, gestion_mesas.*, materias.nombre, institutos.numero')
        ->where('id_persona',$this->session->user_id)
        ->where('gestion_mesas.id_carrera',$id)
        ->join('gestion_mesas', 'gestion_mesas.id = gestion_examenes.id_mesa')
        ->join('materias', 'materias.id = gestion_mesas.id_materia')
        ->join('institutos', 'institutos.id = gestion_mesas.id_instituto')
        ->findAll();
        $data=['vTITULO' => 'Exámenes de Carrera', 'datos' => $datos, 'vCARRERA' => $carrera];

        echo view('header');
        echo view('alumnos/examenes_carrera',$data);
        echo view('footer');
    }

}
