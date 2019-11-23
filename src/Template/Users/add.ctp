<div class="form-basico" >
<?php 
    //Renderizamos un formulario POST con action /pocake/user/add
    echo $this->Form->create($user);
    echo $this->Form->input('first_name');
    echo $this->Form->input('last_name');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->input('role',['options' => ['admin'=>'administrador', 'user'=>'usuario']]);
    echo $this->Form->input('active');
    echo $this->Form->button('Crear usuario');
    echo $this->Form->end();

?>
</div>