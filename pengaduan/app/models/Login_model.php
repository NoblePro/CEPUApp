<?php

class Login_model
{
    public function check($username)
    {
        $query = 'SELECT * FROM `users` WHERE username="' . $username . '"';
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeSelectQuery($query);
        return $this->memory;
    }
}
