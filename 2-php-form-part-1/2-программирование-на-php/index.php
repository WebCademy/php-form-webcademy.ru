<?php


if ( !empty($_POST) && trim($_POST['name']) != '' && trim($_POST['email']) != '' && trim($_POST['message']) != ''  ) {

    $message =  "Вам пришло новое сообщение с сайта: \n" .
                "Имя отправителя: " . $_POST['name'] . "\n" .
                "Email отправителя: ". $_POST['email'] . "\n" .
                "Сообщение: ". $_POST['message'];

    mail( 'info@rightblog.ru', "Сообщение с сайта!", $message );

    header('location: thankyou.html');

}



function checkValue($item, $message ) {
    if ( isset($item) && trim($item) == ''  ) {
        echo '<div class="error">' . $message . '</div>';
    }
}

function printPostValue($item){
    if ( isset($item) && strlen(trim($item)) > 0 ) {
        echo $item;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=cyrillic-ext" rel="stylesheet">
</head>
<body>

    <div class="overlay">

        <div class="content-wrapper">
            <h1 class="title">Отправьте нам сообщение</h1>

            <form method="POST" action="index.php" class="form-wrapper">

                <?php
                    // echo "<pre style='font-size: 24px;'>";
                    // print_r($_POST);
                    // echo "</pre>";
                ?>

                <div class="form-group">
                    <label for="name" class="form-label">Ваше имя</label>
                    <?php checkValue($_POST['name'], 'Вы не ввели имя.'); ?>

                    <input
                        name="name"
                        id="name"
                        type="text"
                        class="form-input"
                        placeholder="Введите имя"
                        value="<?php printPostValue($_POST['name']); ?>"
                    >

                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Ваше email</label>
                    <?php checkValue($_POST['email'], 'Вы не ввели email.'); ?>
                    <input
                        name="email"
                        id="email"
                        type="email"
                        class="form-input"
                        placeholder="Введите email"
                        value="<?php printPostValue($_POST['email']); ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="message" class="form-label">Сообщение</label>
                    <?php checkValue($_POST['message'], 'Вы не ввели сообщение.'); ?>
                    <textarea name="message" id="message" placeholder="Напишите пару строк" class="form-message" name="" id="" cols="30" rows="10"><?php printPostValue($_POST['message']); ?></textarea>
                </div>

                <input class="form-submit" type="submit" value="Отправить сообщение">

            </form>

        </div>

    </div>

</body>
</html>