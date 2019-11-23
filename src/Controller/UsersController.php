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
        $users = $this->Users->find("all");
        $this->set("users",$users);
    }

    public function view($parametro=null)
    {
        echo "Detalle de usuario ".$parametro;
        exit();
    }
}
