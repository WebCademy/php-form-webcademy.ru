<?php

    // Если заполненны все поля формы тогда готовим письмо и отпраляем
    if ( !empty($_POST) && trim($_POST['name']) != '' && trim($_POST['email']) != '' && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && trim($_POST['message']) != ''  ) {

        // Формируем текст письма
        $message =  "Вам пришло новое сообщение с сайта: <br><br>\n" .
                    "<strong>Имя отправителя:</strong>" . strip_tags($_POST['name']) . "<br>\n" .
                    "<strong>Email отправителя: </strong>". strip_tags($_POST['email']) . "<br>\n" .
                    "<strong>Сообщение: </strong>". strip_tags($_POST['message']);

        // Формируем тему письма, специально обрабатывая её
        $subject = "=?utf-8?B?".base64_encode("Сообщение с сайта!")."?=";

        // Указываем от кого будет отправлено письмо
        $email_from = "info@webcademy.ru";
        $name_from = "Личный сайт портфолио";

        // Формируем заголовки письма
        $headers = "MIME-Version: 1.0" . PHP_EOL .
                    "Content-Type: text/html; charset=utf-8" . PHP_EOL .
                    "From: " . "=?utf-8?B?".base64_encode($name_from)."?=" . "<" . $email_from . ">" .  PHP_EOL .
                    "Reply-To: " . $email_from . PHP_EOL;

        // Выполняем отправку письма
        $sendResult = mail('vogihet837@fft-mail.com', $subject, $message, $headers);

        if ( $sendResult ) {
            // Перенаправляем на страницу "Спасибо"
            header('location: thankyou.html');
        } else {
            $failure = "<div class=\"error\">Письмо не было отправлено. Повторите отправку еще раз.</div>";
        }

    }


    // Проверка переменной на ее наличие и на заполненность
    function checkValue($item, $message ) {
        if ( isset($item) && trim($item) == ''  ) {
            echo '<div class="error">' . $message . '</div>';
        }
    }

    // Распечатка заполненных полей из формы, если произошел вывод ошибок
    function printPostValue($item){
        if ( isset($item) && strlen(trim($item)) > 0 ) {
            echo $item;
        }
    }

    // Проверка email на наличие, заполненность и корректность email формата
    function checkEmail($email){
        if ( isset($email) && trim($email) == '' ) {
            echo '<div class="error">Email не может быть пустым. Введите email.</div>';
        } else if ( isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) ){
            echo '<div class="error">Введите корректный адрес email.</div>';
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
                    if (isset($failure)) {
                        echo $failure;
                    }
                ?>

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
                    <?php checkEmail($_POST['email']); ?>
                    <input
                        name="email"
                        id="email"
                        type="text"
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