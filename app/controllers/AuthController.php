<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;

class AuthController extends Controller
{

  public function register(){

    if($_SERVER['REQUEST_METHOD'] === "POST"){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $vpassword = $_POST['vpassword'];

      if($password === $vpassword){
        $db = Database::connect();

        $stm = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $stm->bindParam(":username", $username);
        $stm->bindParam(":password", $hash_password);
        
          if($stm->execute()) {
            $this->redirect('/login');
          }
      }else{
        echo "Senhas diferentes";
      }

    }
    $this->view('/auth/register');
  }

  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $db = Database::connect();
      $stm = $db->prepare("SELECT * FROM users WHERE username = :username");

      $stm->bindParam(":username", $username);
      $stm->execute();

      $user = $stm->fetch();

      if($user && password_verify($password, $user['password'])){

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        $this->redirect('/dash');

      }
    }
    $this->view('auth/login');
  }
}