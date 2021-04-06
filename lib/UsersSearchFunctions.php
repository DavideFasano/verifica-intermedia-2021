<?php

//funzione unica ricerca nome e cognome
function searchUser($searchArray){

    return function($taskItem) use ($searchArray){

        $sanitizedSearchName = strtolower($searchArray['firstName']);
        $sanitizedItemName = strtolower($taskItem['firstName']);
        $sanitizedSearchLastn = strtolower($searchArray['lastName']);
        $sanitizedItemLastn = strtolower($taskItem['lastName']);

        if ($sanitizedItemName === $sanitizedSearchName) {
            if ($sanitizedItemLastn === $sanitizedSearchLastn){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    };
}

//funzione ricerca solo nome
function searchUserName($search){

    return function($taskItem) use ($search){
        $sanitizedSearchName = strtolower($search['firstName']);
        $sanitizedItemName = strtolower($taskItem['firstName']);

        if ($sanitizedItemName === $sanitizedSearchName) {
            return true;
        }else{
            return false;
        }
    };
}

//funzione ricerca solo cognome
function searchUserLastname($search){

    return function($taskItem) use ($search){
        $sanitizedSearchLastn = strtolower($search['lastName']);
        $sanitizedItemLastn = strtolower($taskItem['lastName']);

        if ($sanitizedItemLastn === $sanitizedSearchLastn) {
            return true;
        }else{
            return false;
        }
    };
}
