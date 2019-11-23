<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{
    public function index()
    {
        echo "Listado de usuarios";
        exit();
    }

    public function view($parametro=null)
    {
        echo "Detalle de usuario ".$parametro;
        exit();
    }
}
