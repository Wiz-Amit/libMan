<?php
function getUsers()
{
    include("../connection.php");
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    return $result;
}

function addUser($email, $name)
{
    include("../connection.php");
    $sql = "INSERT INTO `users` (`email`, `name`) VALUES ('" . $email . "', '" . $name . "');";
    $result = $conn->query($sql);

    return $result;
}
