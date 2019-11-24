<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="page-header">
            <h2><?= __('Crear Usuario') ?></h2>
        </div>
        <?= $this->Form->create($user) ?>
        <fieldset>
            <?php
                echo $this->Form->control('first_name',['label'=>__('Nombre')]);
                echo $this->Form->control('last_name',['label'=>__('Apellidos')]);
                echo $this->Form->control('email');
                echo $this->Form->control('password',['label'=>__('Contraseña')]);
                echo $this->Form->control('role',['options'=>['admin'=>'Administrador','user'=>'Usuario'], 'label'=>__('Rol')]);
                echo $this->Form->control('active',['label'=>__('Activo')]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Crear')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
