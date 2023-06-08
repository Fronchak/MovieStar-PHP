<?php

  require_once("models/User.php");
  require_once("dao/users/UserDAOInterface.php");
  require_once("models/Message.php");

  class UserDAO implements UserDAOInterface {

    private PDO $conn;
    private $url;
    private Message $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    public function buildUser($data): User {
      $user = new User();
      $user->id = $data["id"];
      $user->name = $data["name"];
      $user->lastName = $data["last_name"];
      $user->email = $data["email"];
      $user->password = $data["password"];
      $user->image = $data["image"];
      $user->bio = $data["bio"];
      $user->token = $data["token"];

      return $user;
    }

    public function create(User $user, $authUser = false) {
      $stmt = $this->conn->prepare("INSERT INTO users(
        name, last_name, email, password, token) VALUES (
          :name, :last_name, :email, :password, :token
        )");
      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":last_name", $user->lastName);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":token", $user->token);
      $stmt->execute();

      if($authUser) {
        $this->setTokenToSession($user->token);
      }
    }

    public function verifyToken($protected = false) {
      if(!empty($_SESSION["token"])) {
        $token = $_SESSION["token"];
        $user = $this->findByToken($token);
        if($user) {
          return $user;
        }
        else {
          if($protected) {
            $this->message->setMessage("Você precisa fazer login para acessar essa página", "alert-primary", "auth.php");
          }
          return false;
        }
      }
      else {
        if($protected) {
          $this->message->setMessage("Você precisa fazer login para acessar essa página", "alert-primary", "auth.php");
        }
        return false;
      }
    }

    public function setTokenToSession($token, $redirect = true) {
      $_SESSION["token"] = $token;

      if($redirect) {

        $this->message->setMessage("Seja bem-vindo!", "alert-success", "editprofile.php");
      }
    }

    public function authenticateUser($email, $password) {
      $user = $this->findByEmail($email);
      if($user) {
        if(password_verify($password, $user->password)) {
          $token = $user->generateToken();
          $this->setTokenToSession($token, false);
          $user->token = $token;
          $this->update($user, false);
          return true;
        }
        else {
          return false;
        }
      }
      else {
        return false;
      }
    }

    public function findByEmail($email) {
      if($email != "") {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          return $user;
        }
        else {
          return false;
        }
      }
      else {
        return false;
      }
    }


    public function findByToken($token) {
      if($token != "") {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          return $user;
        }
        else {
          return false;
        }
      }
      else {
        return false;
      }
    }

    public function update(User $user, $redirect = true) {
      $stmt = $this->conn->prepare("UPDATE users SET
        name = :name,
        last_name = :lastName,
        image = :image,
        bio = :bio,
        token = :token
        WHERE id = :id
      ");
      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":lastName", $user->lastName);
      $stmt->bindParam(":image", $user->image);
      $stmt->bindParam(":bio", $user->bio);
      $stmt->bindParam(":token", $user->token);
      $stmt->bindParam(":id", $user->id);

      $stmt->execute();

      if($redirect) {
        $this->message->setMessage("Dados atualizados com sucesso!", "alert-success", "index.php");
      }
    }

    public function findById($id) {

    }

    public function changePassword(User $user) {
      $stmt = $this->conn->prepare("UPDATE users SET
        password = :password
        WHERE
        id = :id
      ");
      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":id", $user->id);
      $stmt->execute();

      $this->message->setMessage("Senha atualizada com sucesso", "alert-success", "editprofile.php");
    }

    public function destroyToken() {
      $_SESSION["token"] = null;
      $this->message->setMessage("Logout com sucesso");
    }
  }
?>
