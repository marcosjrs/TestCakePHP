<?php

use Cake\Auth\DefaultPasswordHasher;
use Migrations\AbstractMigration;

class CreateAdminSeedMigration extends AbstractMigration
{
    public function up(){

        //https://github.com/fzaninotto/Faker#populating-entities-using-an-orm-or-an-odm
        //Poblamos la tabla Users con un registro, para hacer pruebas 
        $faker = \Faker\Factory::create();
        $populator = new Faker\ORM\CakePHP\Populator($faker);
        $populator->addEntity('Users', 1, [
            'first_name' => 'Marcos',
            'last_name' => 'JRS',
            'email' => 'marcosjrs@email.com',
            /*'password' => function(){
                $hasher = new DefaultPasswordHasher();
                return $hasher->hash('secret');
            },// Ya lo hace la entidad en el setPassword */
            'password' => function(){
                return 'secret';
            },
            'role' => 'admin',
            'active' => 1,
            // función anonima que usará los recursos de faker para devolver un datetime.
            'created' => function() use($faker){
                return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
            },
            'modified' => function() use($faker){
                return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
            }
        ]);
        $populator->execute();
    }
}
