<?php $title = 'Cursos del Semestre' ?>
<?php ob_start() ?>
<h1 class="estilo2">Cursos del Semestre</h1>
<style>
            .estilo2 {
                background-color:cornflowerblue;
                color:white;
                font-size:30px;
            }
</style>
<ul >
    <?php foreach ($cursos as $curso): ?>
    <li>
        <a href="/read?id=<?php echo $curso['id']?>">
            <?php echo $curso['nombre']?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<?php $content = ob_get_clean() ?>
<?php include 'base.php' ?>
