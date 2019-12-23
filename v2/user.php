<?php
class User
{
    public $email;
    public $name;

    function __construct($email, $name)
    {
        $this->email = $email;
        $this->name = $name;
    }
}