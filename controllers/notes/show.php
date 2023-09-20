<?php

$config = require 'config.php';
$db = new Database($config['database']);
$currentUserId = 4;

$note = $db->query("select * from notes where id = :id", ['id' => $_GET['id']])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$heading = "Note";

require 'views\notes\show.view.php';
