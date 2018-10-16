<?php

require_once ('./src/db_data.php');
require_once ('./src/functions.php');
require_once ('./src/mysql_helper.php');


if (isset($_GET['search'])) {

    $search = trim($_GET['search']);

    if (!empty($search)) {
        $result = search_tasks($connect, $search, $user_id);

        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

