<?php 

function redirigir($url)
{
    //Hay que buscar el remember_token para comparar
    $db      = db_connect();
    $builder = $db->table('users');
    $query   = $builder->select('remember_token AS rt')->where('id',session()->get('userData.id'))->limit(1)->get();
    $token = $query->getResult()[0]->rt;
    if(session()->get('isLoggedIn') && $token === session()->get('userData.remember_token') ) //Validamos el remember token
    {
        return view($url);
    }
    else{
        return redirect()->to('/');
    }
}