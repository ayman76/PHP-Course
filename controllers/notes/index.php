<?php

$config = require 'config.php';
$db = new Database($config['database']);

$notes = $db->query('select * from notes where user_id = 4')->get();


$heading = "My Notes";

require 'views\notes\index.view.php';
