<?php

require 'functions.php';
require 'Database.php';
//require 'router.php';

//Connect to our MySQL database

$db = new Database();

$posts = $db->query('select * from posts')->fetchAll(PDO::FETCH_ASSOC);

//dd($posts);

foreach ($posts as $post){
    echo "<li>" . $post['title'] . "</li>";
}

