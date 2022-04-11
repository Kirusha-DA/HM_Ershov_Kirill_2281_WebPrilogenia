<?php
require_once 'dbpdoconnection.inc.php';
session_start();
if (isset($_GET['as'], $_GET['item'])){
    $as = $_GET['as'];
    $item = $_GET['item'];

    switch($as){
        case 'done':
            $doneQuery = $pdo->prepare("
                UPDATE items
                SET done = 1
                WHERE id = :item
                And userName = :userName
            ");

            $doneQuery->execute([
                'item' => $item,
                'userName' => $_SESSION['name']
            ]);
            break;
        case 'undone':
            $doneQuery = $pdo->prepare("
                UPDATE items
                SET done = 0
                WHERE id = :item
                And userName = :userName
            ");

            $doneQuery->execute([
                'item' => $item,
                'userName' => $_SESSION['name']
            ]);
            break;
    }
}
header('location: ../index.php');