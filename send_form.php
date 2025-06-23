<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Подключаем PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $question = htmlspecialchars($_POST['question']);
    $message = htmlspecialchars($_POST['message']);
    
    // Настройка PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Настройки SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP сервер Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'avrasoa@gmail.com'; // Ваша почта на Gmail (отправитель)
        $mail->Password = 'oygz esrn imwh xiey'; // Ваш пароль приложения (не основной пароль)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Порт для STARTTLS
        
        // Отправитель и получатель
        $mail->setFrom('avrasoa@gmail.com', 'Your Name'); // Почта отправителя
        $mail->addAddress('plucckyd@gmail.com'); // Почта получателя
        
        // Устанавливаем кодировку
        $mail->CharSet = 'UTF-8'; // Указываем кодировку письма
        $mail->Encoding = 'base64'; // Кодировка содержимого письма
        
        // Тема и тело письма
        $mail->isHTML(true); // Убедитесь, что письмо будет в формате HTML
        $mail->Subject = 'Новая заявка на консультацию';
        $mail->Body    = "
        <html>
        <head>
            <title>Новая заявка на консультацию</title>
        </head>
        <body>
            <p><strong>Имя:</strong> $name</p>
            <p><strong>Телефон:</strong> $phone</p>
            <p><strong>Вопрос:</strong> $question</p>
            <p><strong>Сообщение:</strong> $message</p>
        </body>
        </html>
        ";

        // Отправка письма
        if ($mail->send()) {
            // Письмо отправлено успешно, перенаправляем на страницу успеха
            header("Location: success.html");
            exit;
        } else {
            // Если ошибка, перенаправляем на страницу ошибки
            header("Location: error.html");
            exit;
        }

    } catch (Exception $e) {
        // Ошибка при отправке, выводим ошибку и перенаправляем на страницу ошибки
        echo "Ошибка при отправке: {$mail->ErrorInfo}";
        header("Location: error.html");
        exit;
    }
}
?>
