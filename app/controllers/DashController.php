<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;

class DashController extends Controller{
    public function dash(){
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $db = Database::connect();

            $original_link = $_POST['link'];

            do {
                $short_code = substr(md5(uniqid(rand(), true)), 0, 6);
                $stmt = $db->prepare("SELECT COUNT(*) FROM links WHERE short_code = :short_code");
                $stmt->execute(['short_code' => $short_code]);
                $exists = $stmt->fetchColumn(); // Retorna o número de registros com esse código
            } while ($exists > 0);
        
            // Salvar o link no banco
            $stmt = $db->prepare("INSERT INTO links (user_id, original_link, short_code) VALUES (:user_id, :original_link, :short_code)");
            $_SESSION['slink'] = $short_code;
            $_SESSION['olink'] = $original_link;
            $stmt->execute([
                'user_id' => $_SESSION['user_id'],
                'original_link' => $original_link,
                'short_code' => $short_code,
            ]);
        
            $_SESSION['shortlink'] = "http://localhost:8000/" . $short_code; // Link final gerado
            $this->redirect('/link');
        }
        $this->view('/links/index');

    }
    public function linkr(){
        $db = Database::connect();
        
        $stm = $db->prepare("SELECT original_link FROM links WHERE {$_SESSION['slink']} == short_code");
        $stm->execute([
            $this->redirect($_SESSION['olink'])
        ]);
    }
    public function link(){
        $this->view('links/link');
    }
}