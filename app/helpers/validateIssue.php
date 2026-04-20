<?php

function validateIssue($data) {
$errors = [];

if (empty($data['name'])) {
$errors[] = 'Tytuł wydania jest wymagany.';
}

if (empty($data['description'])) {
$errors[] = 'Opis wydania jest wymagany.';
}


return $errors;
}