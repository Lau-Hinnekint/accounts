<?php
session_start();
require 'require/_bdd.php';

var_dump($_REQUEST);
exit;

if (!array_key_exists('HTTP_REFERER', $_SERVER) || str_contains($_SERVER['HTTP_REFERER'], 'http://localhost/todo.php/')) {
    header('Location: todo?php?msg=error_referer');
    exit;
}

else if (!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST) || $_SESSION['token'] !== $_REQUEST['token']) {
        header ('Location: todo.php?msg= error_csrf');
        exit;
}

// #########
// ## ADD ##
// #########

if (isset($_REQUEST) && $_REQUEST['action'] === 'add') {
    $query1 = $dbCo->prepare("INSERT INTO transaction (name, date_transaction, amount, id_category) VALUES (:name, :date, :amount, :category)");
    $addTransaction = $query1->execute([
        'name' => $_REQUEST['name'],
        'date' => $_REQUEST['date'],
        'amount' => $_REQUEST['amount'],
        'category' => $_REQUEST['category']
    ]);
}
header('location: index.php');

// ############
// ## MODIFY ##
// ############

if (isset($_REQUEST) && $_REQUEST['action'] === 'modify') {
    $query2 = $dbCo->prepare("UPDATE transaction SET name = :name, amount = :amount, date_transaction = :date, id_category = :category WHERE t.id_transaction = :idt;  ");
    $modifyTransaction = $query2->execute([
        'name' => $_REQUEST['name'],
        'amount' =>$_REQUEST['amount'],
        'date' => $_REQUEST['date'],
        'category' => $_REQUEST['category'],
        'idt' => $_REQUEST ['ID_transaction'] //Manquant dans la request pas eu le temps de le rajouter
    ]);
}
header('location: index.php');
?>