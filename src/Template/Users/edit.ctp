<div class="row">
    <div class="col-md-6 col-md-offset-3">
    	<div class="page-header">
    		<h2>Editar usuario</h2>
    	</div>
        <?= $this->Form->create($user, ['novalidate']) ?>
        <fieldset>
        <?php
        echo $this->Form->input('first_name', ['label' => 'Nombre']);
        echo $this->Form->input('last_name', ['label' => 'Apellidos']);
        echo $this->Form->input('email', ['label' => 'Correo electrónico']);
        echo $this->Form->input('password', ['label' => 'Contraseña', 'value' => '']);
         ?>
        </fieldset>
        <?= $this->Form->button('Editar') ?>
        <?= $this->Form->end() ?>
    </div>
</div>