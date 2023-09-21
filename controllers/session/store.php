<?php

// Login user if credentials is correct

//Get inputs from form
use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

//validate inputs
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = "Please provide valid email";
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = "Please provide password with at least 7 characters";
}

//Check if email is found in database

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email,
])->find();


//if email founded
if ($user) {
    //check if the password is correct
    if (password_verify($password, $user['password'])) {
        login($user);
        header('location: /');
        exit();
    }
}

view('session/create.view.php', [
    'errors' => [
        'notFound' => "No matching account found for that email address and password.",
    ]
]);


