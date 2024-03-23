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
    <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
</head>
<body>
<?= csrf_field() ?>

<em><?= esc($news['TITLE'])?></em>
<br>

<em><?= esc($news['CONTENT'])?></em>
<br>
<button><a href="/news/recreate/<?= esc($news['SEQ'], 'url') ?>">수정하기</a></button>
<!--<form action="/news/--><?php //= esc($news['SEQ'], 'url') ?><!--" method="post">-->
<!--    --><?php //= csrf_field() ?>
<!--    <button>삭제하기</button>-->
<!--</form>-->
<button id="deleteButton">삭제하기</button>
<button><a href="/news">목록으로</a></button>
</body>
<script>
    $(document).ready(function(){
        $('#deleteButton').click(function(){
            var seq = <?= $news['SEQ'] ?>; // 게시물의 SEQ 값
            $.ajax({
                type: 'POST',
                url: "/news/" + seq, // 삭제를 처리하는 메서드의 URL
                headers: {
                    'X-Csrf-Token': '<?= csrf_hash() ?>' // CSRF 토큰을 요청 헤더에 포함
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response.status === 'success') {
                        // 성공적으로 삭제되었을 경우, 서버에서 받은 메시지를 출력합니다.
                        alert(response.msg);
                        window.location.href = '/news'
                        // 페이지를 새로고침하거나 다른 동작을 수행할 수 있습니다.
                        // 예: window.location.reload();
                    } else {
                        // 삭제에 실패한 경우, 서버에서 받은 메시지를 출력합니다.
                        alert(response.msg);
                    }
                },
                error: function(result) {
                    alert('삭제실패'); // 삭제 실패 시 사용자에게 알림
                }
            });
        });
    });
</script>
</html>
