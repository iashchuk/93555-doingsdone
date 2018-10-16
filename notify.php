<?php
require_once ('vendor/autoload.php');
require_once ('./config.php');
require_once ('./src/functions.php');
require_once ('./src/db_connect.php');
require_once ('./src/db_queries.php');
require_once ('./src/db_data.php');


$result = '';

$transport = new Swift_SmtpTransport('smtp.mailtrap.io', 465);
$transport->setUsername('8d4ac1cd9d2225');
$transport->setPassword('62c3bf51b8a0a4');

$mailer = new Swift_Mailer($transport);

$logger = new Swift_Plugins_Loggers_ArrayLogger();
$mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

$res = get_expire_tasks($connect);


if ($res && mysqli_num_rows($res)) {

    $expire_tasks = mysqli_fetch_all($res, MYSQLI_ASSOC);

    foreach ($expire_tasks as $user) {
        $users[$user['user_id']] [] =
        [
            'name' => $user['name'],
            'email' => $user['email'],
            'title' => $user['title'],
            'deadline' => $user['deadline']
        ];
    }

    foreach ($users as $key => $value) {
        $recipient_tasks = $value;
        $recipient_email = $value[0]['email'];
        $recipient_name = $value[0]['name'];

        $message = new Swift_Message();
        $message->setSubject('Уведомление от сервиса «Дела в порядке»');
        $message->setFrom(['keks@phpdemo.ru' => 'Keks']);
        $message->setTo([$recipient_email => $recipient_name]);

        $message_template = include_template(
            'message',
            [
                'recipient_name' => $recipient_name,
                'recipient_tasks' => $recipient_tasks
            ]
        );

        $message->setBody($message_template, 'text/html');
        $result = $mailer->send($message);

    }
}

if ($result) {
    print('Рассылка успешно отправлена');
} else {
    print('Не удалось отправить рассылку: ' . $logger->dump());
}
