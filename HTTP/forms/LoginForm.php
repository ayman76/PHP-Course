<?php

namespace HTTP\forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($email, $password): bool
    {
        if (!Validator::email($email)) {
            $this->errors['email'] = "Please provide valid email";
        }

        if (!Validator::string($password, 7, 255)) {
            $this->errors['password'] = "Please provide password with at least 7 characters";
        }

        return empty($this->errors);

    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }
}