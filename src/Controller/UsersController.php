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
        $users = $this->paginate( $this->Users);
        $this->set("users",$users);
    }

    public function view($parametro=null)
    {
        echo "Detalle de usuario ".$parametro;
        exit();
    }

    public function home()
    {
        $this->render();
    }
    
    public function add()
    {
        $user = $this->Users->newEntity();
        //Se usa la misma acción para renderizar el formulario,
        //y para persistir los datos llegados por el mismo.
        if($this->request->is('post')){
            //debug($this->request->data);
            $user = $this->Users->patchEntity($user, $this->request->data);
            if($this->Users->save($user)){
                $this->Flash->success('El usuario ha sido creado correctamente');
                return $this->redirect(['controller'=>'Users', 'action'=>'index']);
            }
            else{
                $this->Flash->error('El usuario no ha sido creado correctamente');
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Accion usada tanto para mostrar el login, como para comprobar la autenticacion
     */
    public function login()
    {
        if($this->request->is('post')){
            $user = $this->Auth->identify();// datos que el user ha usado para autenticarse
            if($user){
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }else{
                $this->Flash->error('Datos inválidos, inténtelo de nuevo',['key' => 'auth']);
            }
        }
    }

    
    public function logout()
    {
        //Esto cerrará la session y vuelve a la pantalla de login por que está configurada en AppController
        return $this->redirect($this->Auth->logout());
    }

}
