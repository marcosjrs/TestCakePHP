<?php

use Cake\Auth\DefaultPasswordHasher;
use Migrations\AbstractMigration;
/**
 * Clase autogenerada mediante: cake migrations create CreateUsersSeedMigration.
 * Luego vaciada e implementado metodo up, para poblar de datos de prueba la tabla user.
 */
class CreateUsersSeedMigration extends AbstractMigration
{
    public function up()
    {
        $faker = \Faker\Factory::create();
        $populator = new Faker\ORM\CakePHP\Populator($faker);

        $populator->addEntity('Users',50, [
            'first_name' => function() use($faker){
                return $faker->name();
            },
            'last_name' => function() use($faker){
                return $faker->lastName();
            },
            'email' => function() use($faker){
                return $faker->safeEmail();
            },
             /*'password' => function(){
                $hasher = new DefaultPasswordHasher();
                return $hasher->hash('secret');
            }, // Ya lo hace la entidad en el setPassword*/
            'password' => function(){
                return 'secret';
            },
            'role'=> 'user',
            'active' => function(){
                return rand(0,1);
            },
            'created' => function() use($faker){
                return $faker->dateTimeBetween($startDate = 'now', $enDate = 'now');
            },
            'modified' => function() use($faker){
                return $faker->dateTimeBetween($startDate = 'now', $enDate = 'now');
            }            
        ]);
        $populator->execute();
    }
}
