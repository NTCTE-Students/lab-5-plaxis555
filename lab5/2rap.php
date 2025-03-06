<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обработка жалобы</title>
</head>
<body>
    <h1>Обработка жалобы</h1>

    <form action="" method="post">
        <label for="message">Сообщение:</label>
        <input type="text" id="message" name="message" required>
        <br><br>
        <label for="email">Электронная почта:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <input type="submit" value="Отправить">
    </form>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $message = trim($_POST['message']);
        $email = trim($_POST['email']);

        $errors = [];

        if (empty($message)) {
            $errors[] = 'Cообщение обязательно';
        } elseif (mb_strlen($message) < 10) {
            $errors[] = "Минимум 10 символов";
        } 

        if (empty($email)) {
            $errors[] = "Электронная почта обязательна";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "У электронной почты некорректный формат";
        }

        if (empty($errors)) {
            $message = htmlspecialchars($message);
            $email = htmlspecialchars($email);

            echo '<h1>Жалоба отправлена</h1>';
            echo "Сообхение: {$message}<br>";
            echo "Электронная почта: {$email}<br>";
        } else {
            foreach ($errors as $error) {
                echo "<p style='color: red;'>{$error}</p>";
            }
        }
    }
    ?>
</body>
</html>