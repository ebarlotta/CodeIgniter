<?php namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Models\PersonasModel;
use App\Models\PersonasModel;
use App\Models\DepartamentosModel;
use CodeIgniter\Model;

// use PasswordHash;

class PasswordHash {
	var $itoa64;
	var $iteration_count_log2;
	var $portable_hashes;
	var $random_state;

	function __construct($iteration_count_log2, $portable_hashes)
	{
		$this->itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		if ($iteration_count_log2 < 4 || $iteration_count_log2 > 31)
			$iteration_count_log2 = 8;
		$this->iteration_count_log2 = $iteration_count_log2;

		$this->portable_hashes = $portable_hashes;

		$this->random_state = microtime();
		if (function_exists('getmypid'))
			$this->random_state .= getmypid();
	}

	function PasswordHash($iteration_count_log2, $portable_hashes)
	{
		self::__construct($iteration_count_log2, $portable_hashes);
	}

	function get_random_bytes($count)
	{
		$output = '';
		if (@is_readable('/dev/urandom') &&
		    ($fh = @fopen('/dev/urandom', 'rb'))) {
			$output = fread($fh, $count);
			fclose($fh);
		}

		if (strlen($output) < $count) {
			$output = '';
			for ($i = 0; $i < $count; $i += 16) {
				$this->random_state =
				    md5(microtime() . $this->random_state);
				$output .= md5($this->random_state, TRUE);
			}
			$output = substr($output, 0, $count);
		}

		return $output;
	}

	function encode64($input, $count)
	{
		$output = '';
		$i = 0;
		do {
			$value = ord($input[$i++]);
			$output .= $this->itoa64[$value & 0x3f];
			if ($i < $count)
				$value |= ord($input[$i]) << 8;
			$output .= $this->itoa64[($value >> 6) & 0x3f];
			if ($i++ >= $count)
				break;
			if ($i < $count)
				$value |= ord($input[$i]) << 16;
			$output .= $this->itoa64[($value >> 12) & 0x3f];
			if ($i++ >= $count)
				break;
			$output .= $this->itoa64[($value >> 18) & 0x3f];
		} while ($i < $count);

		return $output;
	}

	function gensalt_private($input)
	{
		$output = '$P$';
		$output .= $this->itoa64[min($this->iteration_count_log2 +
			((PHP_VERSION >= '5') ? 5 : 3), 30)];
		$output .= $this->encode64($input, 6);

		return $output;
	}

	function crypt_private($password, $setting)
	{
		$output = '*0';
		if (substr($setting, 0, 2) === $output)
			$output = '*1';

		$id = substr($setting, 0, 3);
		# We use "$P$", phpBB3 uses "$H$" for the same thing
		if ($id !== '$P$' && $id !== '$H$')
			return $output;

		$count_log2 = strpos($this->itoa64, $setting[3]);
		if ($count_log2 < 7 || $count_log2 > 30)
			return $output;

		$count = 1 << $count_log2;

		$salt = substr($setting, 4, 8);
		if (strlen($salt) !== 8)
			return $output;

		# We were kind of forced to use MD5 here since it's the only
		# cryptographic primitive that was available in all versions
		# of PHP in use.  To implement our own low-level crypto in PHP
		# would have resulted in much worse performance and
		# consequently in lower iteration counts and hashes that are
		# quicker to crack (by non-PHP code).
		$hash = md5($salt . $password, TRUE);
		do {
			$hash = md5($hash . $password, TRUE);
		} while (--$count);

		$output = substr($setting, 0, 12);
		$output .= $this->encode64($hash, 16);

		return $output;
	}

	function gensalt_blowfish($input)
	{
		# This one needs to use a different order of characters and a
		# different encoding scheme from the one in encode64() above.
		# We care because the last character in our encoded string will
		# only represent 2 bits.  While two known implementations of
		# bcrypt will happily accept and correct a salt string which
		# has the 4 unused bits set to non-zero, we do not want to take
		# chances and we also do not want to waste an additional byte
		# of entropy.
		$itoa64 = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

		$output = '$2a$';
		$output .= chr(ord('0') + $this->iteration_count_log2 / 10);
		$output .= chr(ord('0') + $this->iteration_count_log2 % 10);
		$output .= '$';

		$i = 0;
		do {
			$c1 = ord($input[$i++]);
			$output .= $itoa64[$c1 >> 2];
			$c1 = ($c1 & 0x03) << 4;
			if ($i >= 16) {
				$output .= $itoa64[$c1];
				break;
			}

			$c2 = ord($input[$i++]);
			$c1 |= $c2 >> 4;
			$output .= $itoa64[$c1];
			$c1 = ($c2 & 0x0f) << 2;

			$c2 = ord($input[$i++]);
			$c1 |= $c2 >> 6;
			$output .= $itoa64[$c1];
			$output .= $itoa64[$c2 & 0x3f];
		} while (1);

		return $output;
	}

	function HashPassword($password)
	{
		$random = '';

		if (CRYPT_BLOWFISH === 1 && !$this->portable_hashes) {
			$random = $this->get_random_bytes(16);
			$hash =
			    crypt($password, $this->gensalt_blowfish($random));
			if (strlen($hash) === 60)
				return $hash;
		}

		if (strlen($random) < 6)
			$random = $this->get_random_bytes(6);
		$hash =
		    $this->crypt_private($password,
		    $this->gensalt_private($random));
		if (strlen($hash) === 34)
			return $hash;

		# Returning '*' on error is safe here, but would _not_ be safe
		# in a crypt(3)-like function used _both_ for generating new
		# hashes and for validating passwords against existing hashes.
		return '*';
	}

	function CheckPassword($password, $stored_hash)
	{
		$hash = $this->crypt_private($password, $stored_hash);
		if ($hash[0] === '*')
			$hash = crypt($password, $stored_hash);

		# This is not constant-time.  In order to keep the code simple,
		# for timing safety we currently rely on the salts being
		# unpredictable, which they are at least in the non-fallback
		# cases (that is, when we use /dev/urandom and bcrypt).
		return $hash === $stored_hash;
	}
}


class personas extends BaseController
{

	public $ModelHome=NULL;
	
    protected $personas, $session, $reglaslogin, $departamentos, $secundarias;

    public function __construct()
    {

		$this->session = session();
        $this->reglaslogin=['user'=>'required', 'pass'=>'required'];
        $this->personas= new PersonasModel();
        $this->departamentos = new DepartamentosModel();

		$this->ModelHome = model('PersonasModel');

    }

    public function index()
    {

    }

    // Editar datos personales por parte del usuario
	public function perfil()
	{
		if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
		
		// echo  $this->session;
        $persona=$this->personas->where('ID',$this->session->user_id)->first();
        $deptos=$this->departamentos->findAll();

		$data =['vTITULO' => 'Editar datos Personales', 'vPERSONA' => $persona, 'vDEPARTAMENTOS' => $deptos];

        echo view('header');
        echo view('personas/perfil');
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

		$data = $this->ModelHome->usuarios_lst( );
		// echo var_dump($data);
		echo var_dump($_SERVER['REQUEST_METHOD']);
		
		
		print_r('Enzo Resultado:' );
		// exit;
		if ($_SERVER['REQUEST_METHOD']=="GET"){
		
		// if ($this->request->getPost() && $this->validate($this->reglaslogin)){
            $user=$this->request->getPost('user');
            $pass=$this->request->getPost('pass');
			// echo var_dump("Nada:" . $this->request);
			exit;
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

