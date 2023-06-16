<?php

// Se renderizan los datos en formato JSON
function renderUsers($users) {
    header('Content-Type: application/json');
    echo json_encode($users, JSON_PRETTY_PRINT);
}
