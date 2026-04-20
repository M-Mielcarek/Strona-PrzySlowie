<?php

function validateCalendar($event)
{
    $errors = [];

    if (empty($event['title'])) {
        $errors[] = 'Nazwa wydarzenia jest wymagana';
    }

    if (empty($event['start_date'])) {
        $errors[] = 'Data rozpoczęcia jest wymagana';
    }

    if (!empty($event['end_date']) && $event['end_date'] < $event['start_date']) {
        $errors[] = 'Data zakończenia nie może być wcześniejsza niż rozpoczęcia';
    }

    return $errors;
}