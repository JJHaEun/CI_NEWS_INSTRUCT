<?php
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2><?= esc($title)?></h2>
<?= session()->getFlashdata('error')?>
<?= validation_list_errors()?>
<form action="/news" method="post">
    <?= csrf_field()?>
    <label for="title">Title</label>
    <input type="input" name="title" value="<?= set_value('TITLE') ?>">
    <br>

    <label for="body">Text</label>
    <textarea name="content" cols="45" rows="4"><?= set_value('CONTENT') ?></textarea>
    <br>
<button>Create item</button>
</form>
</body>
</html>
