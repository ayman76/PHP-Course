<?php

namespace HTTP\forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        //validate email
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = "Please provide valid email";
        }
        //validate password
        if (!Validator::string($attributes['password'], 7, 255)) {
            $this->errors['password'] = "Please provide password with at least 7 characters";
        }

    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        //check if there is an errors from validation or not
        //if there is errors, so it will throw Validation Exception else it will continue sign in process
        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        return ValidationException::throw($this->errors, $this->attributes);
    }

    public function failed()
    {
        return count($this->errors);

    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}