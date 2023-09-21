<?php

// Get values from form

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

if ($errors) {
    view('registration\create.view.php', [
        'email' => $email,
        'password' => $password,
        'errors' => $errors,
    ]);
}

$db = App::resolve(Database::class);
//Check if the account is already exist

$user = $db->query("select * from users where email = :email", [
    'email' => $email,
])->find();

if ($user) {
    // if found redirect to login page
    header('location: /');
    exit();
} else {
    //if not found create new user and log the user in and redirect
    $db->query("INSERT INTO users(email, password) VALUES (:email, :password)", [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]);

    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();
}

