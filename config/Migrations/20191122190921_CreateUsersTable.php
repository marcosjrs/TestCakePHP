<?php
use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     * Ejecutar en consola: bin\cake migrations migrate
     * Para hacer efectivos los cambios expuesto en este método.
     * Para revertirla (cuando no importe los datos contenicos), ejecutar 
     * en consola: bin\cake migracion rollback
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        // creación de la tabla users
        $table = $this->table('users');
        $table->addColumn('first_name','string',array('limit' => 100))
            ->addColumn('email','string',array('limit' => 100))
            ->addColumn('password','string')
            ->addColumn('role','enum',array('values'=>'admin,user'))
            ->addColumn('active','boolean')
            ->addColumn('created','datetime')
            ->addColumn('modified','datetime')
            ->create();
    }
}
