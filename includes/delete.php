<?php
require_once 'dbpdoconnection.inc.php';
session_start();
if (isset($_GET['item'])){
    $item = $_GET['item'];

    switch($as){
        case 'id':
            $doneQuery = $pdo->prepare("
                DELETE FROM items 
                WHERE id= :item
                AND userName = :userName
                ");
            $doneQuery->execute([
                'item' => $item,
                'userName' => $_SESSION['name']
            ]);
        break;
    }
}

header('location: ../index.php');

?>