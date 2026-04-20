<?php 

function validateUser($user)
{
    $errors=array();

    if(empty($user['username'])) {
        array_push($errors, 'Wymagana nazwa użytkownika.');
    }

    if(empty($user['password'])) {
        array_push($errors, 'Wymagane hasło.');
    }

return $errors;
}


function validateLogin($user)
{
    $errors=array();

    if(empty($user['username'])) {
        array_push($errors, 'Wymagana nazwa użytkownika.');
    }

    if(empty($user['password'])) {
        array_push($errors, 'Wymagane hasło.');
    }
    
return $errors;
}