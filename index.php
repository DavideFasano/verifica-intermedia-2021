<?php

require "./src/class/user.php";


$prova = new User();
$prova->setUserId(1);
$prova->setFirstName("paolo");
$prova->setLastName("brosio");
$prova->setBirthday("2010-02-16");
$prova->setEmail("cazziemazzi@mail.com");

echo $prova->getAge();
echo "\n";
echo $prova->isAdult();