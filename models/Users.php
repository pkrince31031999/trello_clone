<?php
class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $fullName;

    public function __construct($id = null, $username = null, $email = null, $password = null, $fullName = null) {
        $this->id       = $id;
        $this->username = $username;
        $this->email    = $email;
        $this->password = $password;
        $this->fullName = $fullName;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    public function toArray() {
        return [
            'id'       => '',
            'username' => $this->username,
            'email'    => $this->email,
            'fullName' => $this->username,
            'password' => $this->password
        ];
    }

    public function __toString(): string {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

}
