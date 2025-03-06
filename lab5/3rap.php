<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обработка формы</title>
</head>
<body>
    <h1>Обработка формы</h1>

    <form action="" method="post">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <label for="try_password">Подтвердите пароль:</label>
        <input type="password" id="try_password" name="try_password" required>
        <br><br>
        <input type="submit" value="Отправить">
    </form>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
        $try_password = trim($_POST['try_password']);

        $errors = [];

        if (empty($name)) {
            $errors[] = 'Имя обязательно';
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors[] = "В имене допускается использовать только символы латинского алфавита и пробел";
        } elseif (mb_strlen($name) < 4) {
            $errors[] = "Минимум 4 символова имя";
        }
    

        if (empty($password)) {
            $errors[] = "Пароль обязательн";
        }

        if (empty($try_password)) {
            $errors[] = "потвердите пароль";
        } elseif ($try_password != $password) {
            $errors[] = "Пароль не совпадает";
        }


        if (empty($errors)) {

            $name = htmlspecialchars($name);
            $password = htmlspecialchars($password);
            $try_password = htmlspecialchars($try_password);


            echo '<h1>Данные обработаны</h1>';
            echo "Имя: {$name}<br>";
        } else {
            foreach ($errors as $error) {
                echo "<p style='color: red;'>{$error}</p>";
            }
        }
    }
    ?>
</body>
<html>