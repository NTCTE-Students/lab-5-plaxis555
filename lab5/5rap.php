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
        <label for="Date">Дата:</label>
        <input type="date" id="Date" name="Date" required>
        <br><br>
        <label for="Time">Время:</label>
        <input type="time" id="Time" name="Time" required>
        <br><br>
        <input type="submit" value="Отправить">
    </form>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $Date = trim($_POST['Date']);
        $Time = trim($_POST['Time']);


        $errors = [];

        if (empty($Date)) {
            $errors[] = 'Дата обязательна';
        } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $Date)) {
            $errors[] = "Некорректный формат даты";
        }

        if (empty($Time)) {
            $errors[] = "Время обязательно";
        } elseif (!preg_match("/^\d{2}:\d{2}$/", $Time)) {
            $errors[] = "Некорректный формат времени";
        }

        if (empty($errors)) {
            $Date = htmlspecialchars($Date);
            $Time = htmlspecialchars($Time);

            echo '<h1>Данные обработаны</h1>';
            echo "Дата: {$Date}<br>";
            echo "Время: {$Time}<br>";
        } else {

            foreach ($errors as $error) {
                echo "<p style='color: red;'>{$error}</p>";
            }
        }
    }
    ?>
</body>
</html>