<?php namespace App\Controllers;

Use App\Models\PersonasModel;
use App\Models\TabulacionDetalleModel;
use App\Models\TabulacionPuntosModel;
use App\Models\TabulacionFechasModel;
use App\Models\EspaciosModel;
Use App\Models\TabulacionModel;
use App\Models\CategoriasModel;
use App\Models\TabulacionEspaciosModel;
use App\Models\AgrupamientosModel;
use App\Models\AntiguedadModel;
use PasswordHash;

class Administracion extends BaseController
{
    protected $session, $categorias, $tabulacion_detalle, $tabulacion_puntos, $tabulacion, $personas, $fechas, $espacios, $agrupamientos, $tabulacion_fechas, $tabulacion_espacios, $antiguedad;
	
	public function __construct()
	{
		$this->session = session();
		$this->personas = new PersonasModel();
        $this->categorias = new CategoriasModel();
        $this->tabulacion_espacios = new TabulacionEspaciosModel();
        $this->antiguedad = new AntiguedadModel();
		$this->tabulacion = new TabulacionModel();
        $this->tabulacion_detalle = new TabulacionDetalleModel();
        $this->tabulacion_puntos = new TabulacionPuntosModel();
        $this->tabulacion_fechas = new TabulacionFechasModel();
        $this->espacios = new EspaciosModel();
        $this->agrupamientos = new AgrupamientosModel();        
	}

	public function index()
	{
		if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
	}

    public function password($vID)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        $persona=$this->personas->where('id',$vID)->first();
		$data =['vTITULO' => 'Cambiar Contraseña', 'vPERSONA' => $persona];

        if ($this->session->user_rol == 1){
            echo view('header');
            echo view('administracion/password', $data);
            echo view('footer');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }

    public function actualizar_password()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        
        $password = new PasswordHash(8, true);

        $this->personas->update($this->request->getPost('id'), [
            'user_pass' => $password->HashPassword(trim($this->request->getPost('pass')))
            ]);

        return redirect()->to(base_url().'/home');
    }

    // Editar Datos de Persona por parte del Admin
	public function editar_persona($id)
	{
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $persona=$this->personas->where('ID',$id)->first();
		$data =['vTITULO' => 'Editar Perfil', 'vPERSONA' => $persona];

		echo view('header');
		echo view('administracion/editar_persona', $data);
		echo view('footer');
	}

    public function actualizar_persona()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $this->personas->update($this->request->getPost('id'), [
            'user_apellido' => $this->request->getPost('apellido'),
            'user_nombres' => $this->request->getPost('nombres'),
            'user_email' => $this->request->getPost('email'),
            'user_dni' => $this->request->getPost('dni'),
            'user_cuil' => $this->request->getPost('cuil'),
	        'user_telefono' => $this->request->getPost('telefono'),
	        'user_civil' => $this->request->getPost('civil'),
            'user_domicilio' => $this->request->getPost('domicilio'),
            'user_domiciliolegal' => $this->request->getPost('domiciliolegal'),
            'user_nacimiento' => $this->request->getPost('nacimiento'),
            'user_rol' => $this->request->getPost('rol'),
            ]);

        return redirect()->to(base_url().'/home/personas');
    }

    // Ver Tabulacion del Jurado por parte del Admin
    public function ver_tabulacion_jurado($id)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        if ($this->session->user_rol == 1){

            $tabulacion=$this->tabulacion
            ->select('tabulacion.*, personas.*, tabulacion_puntos.*, agrupamientos.nombre as jAGRU, agrupamientos.zona as jZONA, tabulacion_detalle.*, tabulacion_fechas.*, tabulacion_jurado.*, tabulacion_puntosjurado.*')
            ->where('tabulacion.id',$id)
            ->join('tabulacion_detalle', 'tabulacion_detalle.id_tabulacion ='.$id)
            ->join('tabulacion_puntos', 'tabulacion_puntos.id_tabulacion ='.$id)
            ->join('tabulacion_fechas', 'tabulacion_fechas.id_tabulacion ='.$id)
            ->join('tabulacion_jurado', 'tabulacion_jurado.id_tabulacion ='.$id)
            ->join('tabulacion_puntosjurado', 'tabulacion_puntosjurado.id_tabulacion ='.$id)
            ->join('personas', 'personas.id = tabulacion.id_persona')
            ->join('agrupamientos', 'agrupamientos.id = tabulacion.id_agrupamiento')
            ->first();

            $titulos=$this->categorias->where('categoria','titulos')->findAll();
            $postitulos=$this->categorias->where('categoria','postitulos')->findAll();
            $posgrados=$this->categorias->where('categoria','posgrados')->findAll();
            $otras=$this->categorias->where('categoria','otras')->findAll();
            $actividades=$this->categorias->where('categoria','actividades')->findAll();
            $cursos=$this->categorias->where('categoria','cursos')->findAll();
            $investigacion=$this->categorias->where('categoria','investigacion')->findAll();
            $publicaciones=$this->categorias->where('categoria','publicaciones')->findAll();
            $eventos=$this->categorias->where('categoria','eventos')->findAll();
            $jornadas=$this->categorias->where('categoria','jornadas')->findAll();
            $desempenos=$this->categorias->where('categoria','desempenos')->findAll();
            $antecedentes=$this->categorias->where('categoria','antecedentes')->findAll();
            $congresos=$this->categorias->where('categoria','congresos')->findAll();
            $becas=$this->categorias->where('categoria','becas')->findAll();
            $agrupamientos=$this->agrupamientos->findAll();
            $espacios=$this->tabulacion_espacios->where('id_tabulacion',$id)->join('espacios', 'espacios.id = tabulacion_espacios.id_espacio')->findAll();

            // Tabla Antiguedad - Si no ha cargado la antiguedad agregamos elemento a la matrix 0.00 para que no de error
            $antiguedad=$this->antiguedad->where('id_persona', $tabulacion['id_persona'])->first();
            if (empty($antiguedad)) {
                $antiguedad = array(
                    'anti_final_puntos' => '0.00',
                );
                $data=['vID' => $id, 'vDATOS' => $tabulacion, 'vTITULOS' => $titulos,'vPOSTITULOS' => $postitulos,'vPOSGRADOS' => $posgrados,'vOTRAS' => $otras, 'vACTIVIDADES' => $actividades,
                'vCURSOS' => $cursos, 'vINVESTIGACION' => $investigacion, 'vPUBLICACIONES' => $publicaciones, 'vEVENTOS' => $eventos, 'vDESEMPENOS' => $desempenos, 
                'vANTECEDENTES' => $antecedentes, 'vJORNADAS' => $jornadas, 'vCONGRESOS' => $congresos, 'vBECAS' => $becas, 'vAGRUPAMIENTOS' => $agrupamientos, 'vESPACIOS' => $espacios, 'vANTIGUEDAD' => $antiguedad];
            } else {
                $data=['vID' => $id, 'vDATOS' => $tabulacion, 'vTITULOS' => $titulos,'vPOSTITULOS' => $postitulos,'vPOSGRADOS' => $posgrados,'vOTRAS' => $otras, 'vACTIVIDADES' => $actividades,
                'vCURSOS' => $cursos, 'vINVESTIGACION' => $investigacion, 'vPUBLICACIONES' => $publicaciones, 'vEVENTOS' => $eventos, 'vDESEMPENOS' => $desempenos, 
                'vANTECEDENTES' => $antecedentes, 'vJORNADAS' => $jornadas, 'vCONGRESOS' => $congresos, 'vBECAS' => $becas, 'vAGRUPAMIENTOS' => $agrupamientos, 'vESPACIOS' => $espacios, 'vANTIGUEDAD' => $antiguedad];
            }

                echo view('header');
                echo view('jurado/ver_tabulacion_jurado',$data);
                echo view('footer'); 

        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }

    // Listado Total de Inscripciones
    public function inscripciones()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        $inscripciones=$this->tabulacion
        ->select('tabulacion.*, personas.user_apellido AS cAPE, personas.user_nombres AS cNOM, personas.user_email AS cEMAIL, agrupamientos.zona AS Z, agrupamientos.nombre AS N, antiguedad.anti_final_puntos as ANTI')
        ->join('personas', 'personas.id = tabulacion.id_persona')
        ->join('agrupamientos', 'agrupamientos.id = tabulacion.id_agrupamiento')
        ->join('antiguedad', 'antiguedad.id_persona = tabulacion.id_persona')
        ->findAll();
		$data=['vTITULO' => 'Listado Total de Inscripciones', 'vDATOS' => $inscripciones];

        if ($this->session->user_rol == 1){
            echo view('header');
            echo view('administracion/inscripciones', $data);
            echo view('footer');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }

    // Listado de Inscripciones de una carrera
    public function inscripciones_carrera($id)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        $inscripciones=$this->tabulacion
        ->select('tabulacion.*, personas.user_apellido AS cAPE, personas.user_nombres AS cNOM, personas.user_dni AS cDNI, antiguedad.anti_final_puntos as ANTI')
        ->join('personas', 'personas.id = tabulacion.id_persona')
        ->join('antiguedad', 'antiguedad.id_persona = tabulacion.id_persona')
        ->where('id_agrupamiento', $id)
        ->findAll();
        $agru=$this->agrupamientos->where('id',$id)->first();
		$data=['vTITULO' => 'Listado de Inscripciones', 'vDATOS' => $inscripciones, 'AGRU' => $agru];

        if ($this->session->user_rol == 1){
            echo view('header');
            echo view('administracion/inscripciones_carrera', $data);
            echo view('footer');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }

    // Eliminar desde Listado Total de Inscripciones
    public function eliminar($id)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        if ($this->session->user_rol == 1){
            // Tabla tabulacion
            $this->tabulacion->delete($id);
            // Tabla tabulacion_detalle
            $registro=$this->tabulacion_detalle->where('id_tabulacion',$id)->first();
            if ($registro != null) {
                $this->tabulacion_detalle->delete($registro['id']);
            }
            // Tabla tabulacion_espacios
            $items_borrar=$this->tabulacion_espacios->where('id_tabulacion',$id)->findAll();
            if ($registro != null) {        
                foreach ($items_borrar as $row) {
                    $this->tabulacion_espacios->delete($row['id']);
                }
            }
            // Tabla tabulacion_fechas
            $registro=$this->tabulacion_fechas->where('id_tabulacion',$id)->first();
            if ($registro != null) {        
                $this->tabulacion_fechas->delete($registro['id']);
            }
            // Tabla tabulacion_puntos
            $registro=$this->tabulacion_puntos->where('id_tabulacion',$id)->first();
            if ($registro != null) {
                $this->tabulacion_puntos->delete($registro['id']);
            }

            return redirect()->to(base_url().'/home/inscripciones');
        }
    }

    // Listado de Inscripciones tabuladas por el jurado
    public function inscripciones_tab()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        $inscripciones=$this->tabulacion
        ->select('tabulacion.*, tabulacion.id as cTAB, antiguedad.*, personas.id AS cID, personas.user_apellido AS cAPE, personas.user_nombres AS cNOM, personas.user_dni AS cDNI, personas.user_email AS cEMAIL, agrupamientos.nombre AS N')
        ->join('personas', 'personas.id = tabulacion.id_persona')
        ->join('antiguedad', 'antiguedad.id_persona = tabulacion.id_persona')
        ->join('agrupamientos', 'agrupamientos.id = tabulacion.id_agrupamiento')
        ->where('validado', 1)
        ->findAll();
		$data=['vTITULO' => 'Listado de Inscripciones Tabuladas', 'vDATOS' => $inscripciones];

        if ($this->session->user_rol == 1){
            echo view('header');
            echo view('administracion/inscripciones_tab', $data);
            echo view('footer');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }

}
