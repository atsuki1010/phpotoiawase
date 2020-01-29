<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    //POSTでない時
    $name = '';
    $email = '';
    $subject = '';
    $message = '';
    $err_msg = '';
    $complete_msg = '';
} else {
    //入力された値を取得
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    //エラー、完了メッセージの用意
    $err_msg = '';
    $complete_msg = '';

    //空チェック
    if($name == '' || $email == '' || $subject == '' || $message == '') {
        $err_msg ='全ての項目を入力してください';
    }

    //エラーなし
    if($err_msg == ''){
        $to = 'example@gmail.com'; //送信先のメールアドレス　アプリパスワード　の設定などでローカルホスト上で送信されるのは確認済み
        $headers = "From: " . $email . "\r\n";
        //本文最後に名前追加
        $message .= "\r\n\r\n" . $name;

        //メール送信
        mb_send_mail($to, $subject, $message, $headers);

        //完了メッセージ
        $complete_msg = '送信しました。';

        //全てからにする。
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-4 col-xs-4">
            <h1>お問い合わせ</h1>
            <?php if($err_msg != ''): ?>
                <div class="alert alert-danger">
                    <?php echo $err_msg; ?>
                </div>
            <?php endif; ?>
            
            <?php if($complete_msg != ''): ?>
                <div class="alert alert-success">
                    <?php echo $complete_msg; ?>
                </div>
            <?php endif; ?>

                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="お名前" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="メールアドレス" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="件名" value="<?php echo $subject; ?>">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" row="5" placeholder="本文"><?php echo $message; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">送信する</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>