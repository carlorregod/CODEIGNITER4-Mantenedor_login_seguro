<?php
namespace App\Controllers;
use CodeIgniter\HTTP\Request;
use App\Models\UserModel;

class LoginAuth extends BaseController
{
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
	    		//return view('Login/login',['errors' => $usermodel->errors()]);
	    		$data = $usermodel->errors();
	    		$this->session->setFlashdata('errors',$data);
	    		return redirect()->back()->withInput();
	    	}
		}else{
			echo "pasa2";
			$data=['error'=>array("Revise sus datos")];
			return redirect()->back()->withInput()->with('errors', $data);
		}

	}

	public function login()
	{
		$request = service('request');
		$credential = $request->getPost();


		//Trae las cosas como un array
		echo $credential['username1'];
	}



}
