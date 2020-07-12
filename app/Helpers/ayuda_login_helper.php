<?php 

function redirigir($url)
{
    if(session()->get('isLoggedIn'))
    {
        return view($url);
    }
    else{
        return redirect()->to('/');
    }
}