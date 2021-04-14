<?php

require "./src/class/user.php";
require "./lib/JSONReader.php";
require "./lib/UsersSearchFunctions.php";

/*
$prova = new User();
$prova->setUserId(1);
$prova->setFirstName("paolo");
$prova->setLastName("brosio");
$prova->setBirthday("2010-02-16");
$prova->setEmail("cazziemazzi@mail.com");

echo $prova->getAge();
echo "\n";
echo $prova->isAdult();
*/

$usersList = JSONReader("./dataset/users-management-system.json");
$userListDisplay = [];

foreach ($usersList as $user) {
    $userObj = new User();
    $userObj->setUserId($user['id']);
    $userObj->setFirstName($user['firstName']);
    $userObj->setLastName($user['lastName']);
    $userObj->setBirthday($user['birthday']);
    $userObj->setEmail($user['email']);
    $userListDisplay[] = $userObj;
}
//print_r($userListDisplay);

if (isset($_GET['search_name']) && ($_GET['search_name'] != '')) {
    //$searchTextName = trim(filter_var($_GET['search_name'], FILTER_SANITIZE_STRING));
    $userListDisplay = array_filter($userListDisplay, _searchUserName($_GET['search_name']));
    //echo $_GET['search_name'];
}
//else{
    //$searchTextName = '';
//}
if (isset($_GET['search_lastname']) && ($_GET['search_lastname'] != '')) {
    //$searchTextLastname = trim(filter_var($_GET['search_lastname'], FILTER_SANITIZE_STRING));
    $userListDisplay = array_filter($userListDisplay, _searchUserLastname($_GET['search_lastname']));
    //echo $_GET['search_lastname'];
}
//else{
    //$searchTextLastname = '';
//}
//echo $_GET['search_name'];
if (isset($_GET['search_age']) && ($_GET['search_age'] >= 0)){
    $userListDisplay = array_filter($userListDisplay, _searchUserAge($_GET['search_age']));
    echo $_GET['search_age'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
        input.form-control {
            padding: 2px;
            line-height: 100%;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <header class="container-fluid bg-secondary text-light p-2">
        <div class="container">
            <h1 class="display-3 mb-0">
                User management system
            </h1>
            <h2 class="display-6">user list</h2>
        </div>
    </header>
    <div class="container">
        <table class="table">
            <tr>
                <th>Id</th>
                <th>nome</th>
                <th>cognome</th>
                <th>email</th>
                <th cellspan="2">età</th>
            </tr>
            <form action="./index.php">
                <tr>
                    <th>
                        <input class="form-control" type="text" id="search_id">
                    </th>

                    <th>
                        <input class="form-control" type="text" id="search_name" name="search_name">
                    </th>

                    <th>
                        <input class="form-control" type="text" id="search_lastname" name="search_lastname">
                    </th>

                    <th>
                        <input class="form-control" type="text" id="search_email">
                    </th>

                    <th>
                        <input class="form-control" type="text" id="search_age" name="search_age">
                    </th>
                    <th>
                        <button class="btn btn-primary" type="submit">cerca</button>
                    </th>
                </tr>
            </form>

            <?php
            foreach ($userListDisplay as $row) {
                $id = $row->getUserId();
                $nome = $row->getFirstName();
                $cognome = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($row->getLastName()))));
                $mail = $row->getEmail();
                $eta = $row->getAge();
            ?>
                <tr>
                    <td> <?= $id ?> </td>
                    <td> <?= $nome ?> </td>
                    <td> <?= $cognome ?> </td>
                    <td> <?= $mail ?> </td>
                    <td> <?= $eta ?> </td>
                </tr>

            <?php } ?>





        </table>

    </div>
</body>