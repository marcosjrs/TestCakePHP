<h2>Usuarios</h2>
<ul>
    <?php foreach($users as $user): ?>
    <li class="no-decoration"> <?= $user->email ?> </li>   
    <?php endforeach; ?>
</ul>