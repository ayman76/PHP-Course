<?php

namespace Core;

class Authenticator
{

    public function attempt($email, $password)
    {
        $db = App::resolve(Database::class);

        $user = $db->query('select * from users where email = :email', [
            'email' => $email,
        ])->find();


        //if email founded
        if ($user) {
            //check if the password is correct
            if (password_verify($password, $user['password'])) {
                $this->login($user);
                return true;
            }
        }
        return false;

    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
        ];

        //generate new id for session for user
        session_regenerate_id(true);
    }


    public function logout()
    {
        Session::destroy();
    }

}