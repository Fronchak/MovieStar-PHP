<?php

include_once("models/User.php");

interface UserDAOInterface {

  public function buildUser($data): User;
  public function create(User $user, $authUser = false);
  public function update(User $user, $redirect = true);
  public function findByToken($token);
  public function verifyToken($protected = false);
  public function setTokenToSession($token, $redirect = true);
  public function authenticateUser($email, $password);
  public function findByEmail($email);
  public function findById($id);
  public function destroyToken();
  public function changePassword(User $user);
}

?>
