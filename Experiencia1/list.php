<?php $title = 'List of Post1' ?>
<?php ob_start() ?>
<h1>List of Post1</h1>
<ul>
    <?php foreach ($posts as $post): ?>
    <li>
        <a href="/read?id=<?php echo $post['id']?>">
            <?php echo $post['title']?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<?php $content = ob_get_clean() ?>
<?php include 'base.php' ?>

