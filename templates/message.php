<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style type="text/css">
        table {
            text-align: center;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>На повестке дня новые задачи!</h1>
    <table>
        <h2>Уважаемый, <?= $recipient_name; ?>. Сегодня у вас запланированы задачи: </h2>
        <thead>
            <tr>
                <th style="width: 100px;">Номер</th>
                <th style="width: 300px;">Название задачи</th>
                <th style="width: 150px;">Время</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recipient_tasks as $key => $task): ?>
                <tr>
                    <td style="width: 20px;"><?=$key+1;?></td>
                    <td style="width: 200px;"><?= strip_tags($task['title']); ?></td>
                    <td style="width: 50px;"><?= $task['deadline']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
