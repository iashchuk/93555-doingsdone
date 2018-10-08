<?php

function get_projects_query() {
    $sql_projects = "SELECT `id`, `title` FROM projects";
    return $sql_projects;
}

function get_user_project_query($user_id) {
    $sql_projects = "SELECT `id`, `title` FROM projects WHERE `user_id` = $user_id";
    return $sql_projects;
}

function get_select_project_query($project_id) {
    $sql_active_project = "SELECT `id`, `title` FROM projects WHERE `id` = $project_id";
    return $sql_active_project;
}

function get_tasks_query() {
    $sql_tasks = "SELECT `id`, `title`, `created`, `status`, `deadline`, `user_id`, `project_id` FROM tasks";
    return  $sql_tasks;
}

function get_active_tasks_query($project_id) {
    $sql_active_tasks = "SELECT `id`, `title`, `created`, `status`, `deadline`, `user_id`, `project_id` FROM tasks WHERE project_id = $project_id";
    return $sql_active_tasks;
}
