<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\BookmarksTable&\Cake\ORM\Association\HasMany $Bookmarks
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Bookmarks', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 100)            
            /**Presencia requerida en creacion */
            ->requirePresence('first_name', 'create')
            /**Indica que no puede ser un string vacio, 
             * el segundo parámetro será el texto mostrado solo si tenemos novalidate en el form,
             * ya que sino, no lo permite el navegador, por ser required */
            ->notEmptyString('first_name','Rellene este campo');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 100)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name','Rellene este campo');

        $validator
            /**Valida que sea un email válido */
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email','Rellene este campo');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password','Rellene este campo');

        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role','Rellene este campo');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmptyString('active','Rellene este campo');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //Aquí ponemos los campos que deben ser únicos
        $rules->add($rules->isUnique(['email'],'Ya existe un usuario con ese email'));

        return $rules;
    }

    /**
     * Devuelve ciertos campos de los usuarios que tengan el campo active = true.
     * Antes se instanció  'finder'=> 'auth' en la configuración de autentificación Form 
     * en AppController, con esto se filtran a la sesión, solo los campos que le pongamos.
     * 
     * Por convención es find+Algo(Query $query, array $arraySegundoParametro).
     * Y el uso sería algo como $users->find('algo', $arraySegundoParametroDelFind), 
     * pero este es un caso particular.
     */
    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        
        return $query
            ->select(['id','first_name','last_name','email','password','role'])
            ->where(['Users.active' =>true]);
    }
}
