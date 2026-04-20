<?php 

function validateTopic($topic)
{
    $errors=array();

    if(empty($topic['name'])) {
        array_push($errors, 'Wymagana nazwa.');
    }

    $existingTopic= selectOne('topics', ['name' => $topic['name']]);
    if ($existingTopic){
        if (isset($topic['update-topic']) && $existingTopic['id'] != $topic['id']){
        array_push($errors, 'Taki tag już istnieje.');
        }

        if (isset($topic['add-topic'])){
            array_push($errors, 'Taki tag już istnieje.');
        }
    }

return $errors;
}