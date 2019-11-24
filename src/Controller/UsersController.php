<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{
    /**
     *  Se ejecuta antes que cualquier otra acción del controlador.
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        //añadimos los accesos que podrá tener aunque no esté logado, 
        //es decir sin necesidad de otros permisos.
        $this->Auth->allow(['add']);
    }

    public function isAuthorized($user)
    {
        if(isset($user['role']) and $user['role'] == 'user'){
            //Si es de tipo user, se mira si la accion pedida está entre las que permitimos
            //para ese tipo de usuario, que solo son: home y logout.
            if(in_array($this->request->action, ['home','view','logout'])){
                return true;
            }
            
        }

        return parent::isAuthorized($user);
    }

    public function index()
    {
        $users = $this->paginate( $this->Users);
        $this->set("users",$users);
    }

    /**
     * Ver perfil de usuario
     */
    public function view($id)
    {
       $user = $this->Users->get($id);
       $this->set('user',$user);
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
            $userLogado = $this->Auth->user();
            if(!isset($userLogado['role']) || $userLogado['role'] != 'admin'){
                $user->role = 'user';
                $user->active = true;
            }
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

    public function delete($id = null)
    {
        //métodos que van a ser permitidos dentro de esta acción
        $this->request->allowMethod(['post', 'delete']);
        //recuperamos el usuario según el identificador
        $user = $this->Users->get($id);
        if ($this->Users->delete($user))
        {
            $this->Flash->success('El usuario ha sido eliminado');
        }
        else
        {
            $this->Flash->error('El usuario no pudo ser eliminado.');
        }
        return $this->redirect(['action' => 'index']);
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
        if($this->Auth->user()){
            $this->redirect(['controller'=>'users','action'=>'home']);
        }
    }

    
    public function logout()
    {
        //Esto cerrará la session y vuelve a la pantalla de login por que está configurada en AppController
        return $this->redirect($this->Auth->logout());
    }

}
