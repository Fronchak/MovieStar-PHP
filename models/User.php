<?php

class User {

  public int $id;
  public string $name;
  public string $lastName;
  public string $email;
  public string $password;
  public string | null $image;
  public string | null $bio;
  public string $token;

  public function generateToken() {
    return bin2hex(random_bytes(50));
  }

  public function generatePassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }

  public function getFullName() {
    return $this->name . " " . $this->lastName;
  }

  public function imageGenerateName() {
    return bin2hex(random_bytes(50)) . ".jpg";
  }

}

?>
