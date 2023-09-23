<?php

// Login user if credentials is correct

//Get inputs from form
use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Core\Validator;
use HTTP\forms\LoginForm;


$attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
];

//validate inputs
$form = LoginForm::validate($attributes);

//if Validation true
//Check the credentials of user

$signedIn = (new Authenticator())->attempt($attributes['email'], $attributes['password']);

//if Credentials not correct
//it will throw an exception and return to login page
if (!$signedIn) {
    $form->error("notFound", "No matching account found for that email address and password.")->throw();

}

//if signed in it will redirect to Home page
redirect('/');



