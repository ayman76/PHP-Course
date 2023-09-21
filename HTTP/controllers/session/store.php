<?php

// Login user if credentials is correct

//Get inputs from form
use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;
use HTTP\forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

//validate inputs
$form = new LoginForm();
// Check Validation of inputs
if ($form->validate($email, $password)) {
    //if Validation true
    //Check the credentials of user
    if ((new Authenticator())->attempt($email, $password)) {
        redirect('/');
    }
    //if credentials is false
    //add error to errors
    $form->error("notFound", "No matching account found for that email address and password.");

}

//if validation or credentials is false
//redirect to login page with data and errors
view('session/create.view.php', [
    'email' => $email,
    'password' => $password,
    'errors' => $form->errors(),
]);



