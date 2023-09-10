<?php

namespace market\User;

class User {

    protected string $name = '';
    protected int|null $age = null;

    public function __construct($name,$age)
    {   
        $this->name=$name;
        $this->age=$age;
        echo 'MyUser';
    }

    public function setName(string $name):void
    {
        $this->name = $name;
        // to do
    }

    public function getName()
    {
        return $this->name;
    }
}
