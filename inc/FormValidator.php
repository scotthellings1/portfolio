<?php

class FormValidator
{
    private static $fields = ['first_name', 'last_name', 'subject', 'email', 'message'];
    private $data;
    private $errors = [];
    private $validated = [];

    /**
     * FormValidator constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validateForm()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field not present");
                exit();
            }
        }

        $this->validateFirstName();
        $this->validateLastName();
        $this->validateEmail();
        $this->validateSubject();
        $this->validateMessage();

        return $this->errors;

    }

    private function validateFirstName()
    {
        $val = trim($this->data['first_name']);
        if (empty($val)) {
            $this->addError('first_name', 'First Name can not be empty');
        } else {
            if (!preg_match('/^[a-zA-Z-]{2,30}$/', $val)) {
                $this->addError('first_name', 'First name must be at least 2 Letters long');
            }
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }


    private function validateLastName()
    {
        $val = trim($this->data['last_name']);
        if (empty($val)) {
            $this->addError('last_name', 'Last Name can not be empty');
        } else {
            if (!preg_match('/^[a-zA-Z-]{2,}$/', $val)) {
                $this->addError('last_name', 'Last name must be at least 2 Letters long');
            }
        }
    }

    private function validateEmail()
    {
        $val = trim($this->data['email']);
        if (empty($val)) {
            $this->addError('email', 'Email can not be empty');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Email format not valid');
            }
        }
    }

    private function validateSubject()
    {
        $val = trim($this->data['subject']);
        if (empty($val)) {
            $this->addError('subject', 'Subject can not be empty');
        } else {
            if (!preg_match('/^[a-zA-Z0-9!_?+-]{5,}$/', $val)) {
                $this->addError('subject', 'Subject must be at least 5 characters long');
            }
        }
    }

    private function validateMessage()
    {
        $val = trim($this->data['message']);
        if (empty($val)) {
            $this->addError('message', 'Message can not be empty');
        }
    }
}
