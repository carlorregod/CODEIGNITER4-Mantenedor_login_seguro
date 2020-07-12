<?php
namespace App\Controllers;
use CodeIgniter\HTTP\Request;
use App\Models\UserModel;

class LoginAuth extends BaseController
{
	protected $session;
	
	public function __construct()
	{
		$this->user = model('UserModel'); //Carga modelo
		$this->session = session();       //Cargando helper session
	}

	public function index()
	{
		return view('Login/login');
	}

	public function register()
	{
		$this->session->remove('vista_login');
		$request = service('request');
		$credential = $request->getPost();


		if($credential['password'] == $credential['password_verify'])
		{
			$usermodel = $this->user;
			//Reglas de validación
			$data = [
		        'firstname' => $credential['firstname'],
		        'lastname'  => $credential['lastname'],
		        'email'  	=> $credential['email'],
		        'username'  => $credential['username'],
		        'password'  => $credential['password'],
		        'password_verify'  => $credential['password_verify'],
		        'active'  	=> 1

	    	];
	    	if($usermodel->insert($data))
	    	{
		    	$data = ['mensaje'=>'Usuario ingresado'];
		    	return view('Login/login',$data);
	    	}else{
	    		//Rescatando el o los errores
	    		$data = $usermodel->errors();
	    		$this->session->setFlashdata('errors',$data);
	    		return redirect()->back()->withInput();
	    	}
		}else{
			$data=['error'=>array("Revise sus datos")];
			return redirect()->back()->withInput()->with('errors', $data);
		}

	}

	public function login()
	{
		//Reglas de validación de formulario antes de efectuar búsqueda alguna
		$rules = [
			'username1'		=> 'required|alpha_numeric|min_length[3]',
			'password1' 	=> 'required|min_length[5]'
		];
		if (! $this->validate($rules)) {
			$this->session->set('vista_login',TRUE); //Esto es para que la vista rediriga automáticamente a esa opción de login
			return redirect()->back()
				->withInput()
				->with('errors', $this->validator->getErrors());
		}

		$request = service('request');
		$credential = $request->getPost();
		$user = $this->user->where('username', $credential['username1'])->first();

		if (is_null($user) ||!password_verify($credential['password1'], $user['password'])) 
		{
			$this->session->set('vista_login',TRUE);
			return redirect()->back()->withInput()->with('errors', ['El usuario o contraseña no existen o son errados, reinténtelo de nuevo']);
		}
		//Ahora hay que activar al usuario pues, pasa la validación
		// login OK, save user data to session
		$this->session->set('isLoggedIn', true);
		$this->session->set('userData', [
            'id' 			=> $user['id'],
            'username' 		=> $user['username'],
            'email' 		=> $user['email'],
            'firstname' 	=> $user['firstname'],
            'lastname' 		=> $user['lastname']
        ]);

        return redirect()->to('main/index');
	}

	public function logout()
	{
		$this->session->remove(['isLoggedIn', 'userData']);
		$this->session->set('vista_login',TRUE);
        return redirect()->to('/');
	}



}
