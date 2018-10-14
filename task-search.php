<?php

require_once ('./root/db_data.php');
require_once ('./root/db_utils.php');
require_once ('./root/functions.php');
require_once ('./root/mysql_helper.php');


if (isset($_GET['search'])) {

    $search = trim($_GET['search']);

    if (!empty($search)) {
        $result = search_tasks($connect, $search);

        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

