<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        
            /*  Configuraciones que vamos realizar:
            Autorización a ser manejada por nuestro controlador.
            Autenticación que vamos a utilizar:  Form (basic), 
               mapeando que como username usaremos el campo email 
               (si no hubiera esa diferencia, no haría falta esta configuración) 
            Accion que responderá al intento de login: Users->login
            Acción a redirigir cuando haya logado: Users->home
            Acción a redirigir cuando haya cerrado su sesión: Users->login
            */
            $this->loadComponent('RequestHandler');
            $this->loadComponent('Flash');
            $this->loadComponent('Auth', [
                'authorize' => ['Controller'],
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ],
                        /** filtramos los datos de auth, para que tenga solo 
                         * unos campos determinados en la session, no todos. 
                         * Ver metodo findAuth de UsersTable, creado por nosotros a posteriori */
                        'finder'=> 'auth'
                    ]
                ],
                'loginAction' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ],
                'authError' => 'Ingrese sus datos',
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'home'
                ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ]
            ]);

        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    //Inyectamos el usuario actual, si es que lo tiene, gracias al metodo user de Auth
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->set("current_user",$this->Auth->user());
    }

    public function isAuthorized($user)
    {
        //temporalmente devuelve true para que no dea problemas: Siempre autorizado.
        return true;
    }

}
