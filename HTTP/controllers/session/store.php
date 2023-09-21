<?php

// Login user if credentials is correct

//Get inputs from form
use Core\App;
use Core\Database;
use Core\Validator;
use HTTP\forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

//validate inputs
$form = new LoginForm();

if (!$form->validate($email, $password)) {
    view('session/create.view.php', [
        'email' => $email,
        'password' => $password,
        'errors' => $form->errors(),
    ]);
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


