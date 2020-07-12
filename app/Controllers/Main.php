<?php
namespace App\Controllers;

class Main extends BaseController
{
    protected $session;
    public function __construct()
	{
		$this->session = session();       //Cargando helper session
	}

    public function index()
    {
        return redirigir('main/index'); //Redirección a ruta protegida
        
    }
}