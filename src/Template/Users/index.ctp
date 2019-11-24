<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
<div class="col-md-12">
    <div class="page-header"><h2><?= __('Usuarios') ?></h2></div>
    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name',[__('Nombre')]) ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name',[__('Apellidos')]) ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->email) ?></td>
                <td>
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $user->id],["class"=>"btn btn-sm btn-info"]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id],["class"=>"btn btn-sm btn-primary"]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), "class"=>"btn btn-sm btn-danger"]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Primero')) ?>

            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers(['before'=>'','after'=>'']) ?>
            <?= $this->Paginator->next(__('Siguiente') . ' >') ?>

            <?= $this->Paginator->last(__('Último') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, enseñando {{current}} filas de {{count}} en total')]) ?></p>
    </div>
</div>
</div>
