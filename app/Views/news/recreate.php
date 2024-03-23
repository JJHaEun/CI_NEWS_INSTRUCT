<!-- news/recreate.php -->

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update News</title>
</head>
<body>
<h2>Update News</h2>
<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>
<form action="/news/recreate/<?= esc($news['SEQ'], 'url') ?>" method="post">
    <?= csrf_field() ?>
    <label for="title">Title</label><br>
    <input type="text" id="title" name="title" value="<?= esc($news['TITLE']) ?>"><br>

    <label for="content">Text</label><br>
    <textarea id="content" name="content" cols="45" rows="4"><?= esc($news['CONTENT']) ?></textarea><br>

    <button type="submit">Update item</button>
</form>
<button type="button"><a href="/news">Go to List</a></button>
</body>
</html>
