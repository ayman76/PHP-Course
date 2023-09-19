<?php

require 'functions.php';
require 'Database.php';
//require 'router.php';

//Connect to our MySQL database


$config = require 'config.php';


$db = new Database($config['database']) ;

$id = $_GET['id'];

//Don't inline user parameter in sql query this will help user to inject sql queries in your query like drop tables
//$query = "select * from posts where  id = {$id}";

//We fix it by adding ? or :nameOfCol that we need to get its value from user and pass it as parameter in execute method in Database class

$query = "select * from posts where id = :id";

$posts = $db->query($query, [':id' => $id])->fetch();

dd($posts);

//foreach ($posts as $post){
//    echo "<li>" . $post['title'] . "</li>";
//}

