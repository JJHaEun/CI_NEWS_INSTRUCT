<?php
/**
 * 뉴스 리스트 페이지
 */
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
<h2><?= esc($title) ?></h2>
<button><a href="/news/new">Create</a></button>
<?php if (! empty($news) && is_array($news)): ?>
    <?php foreach ($news as $news_item): ?>

        <h3><?= $news_item['TITLE'] ?></h3>

        <div class="main">
            <?= $news_item['CONTENT'] ?>
        </div>
        <p><a href="/news/<?= esc($news_item['SEQ'], 'url') ?>">View article</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>
</body>
</html>
