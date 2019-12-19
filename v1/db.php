<?php

function getUsers()
{
    include("../connection.php");
    $sql = "SELECT * FROM users ORDER BY `name` asc;";
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

function getBooks()
{
    include("../connection.php");
    $sql = "SELECT * FROM books ORDER BY `name` asc;";
    $result = $conn->query($sql);

    return $result;
}

function addBook($name, $authors, $count)
{
    include("../connection.php");
    $sql = "INSERT INTO `books` (`id`, `name`, `authors`, `count`)
    VALUES (NULL, '" . $name . "', '" . $authors . "', '" . $count . "');";
    $result = $conn->query($sql);

    return $result;
}

function getRegister() {
    include("../connection.php");
    $sql = "SELECT * FROM `register`
    INNER JOIN (SELECT email as user_email, name as username FROM `users`) u ON register.user_email = u.user_email
    INNER JOIN (SELECT id as book_id, name as book_name FROM `books`) b on register.book_id = b.book_id ORDER BY id desc;";
    $result = $conn->query($sql);

    return $result;
}

function issueBook($book_id, $user_email) {
    include("../connection.php");
    $sql = "INSERT INTO `register` (`id`, `book_id`, `user_email`, `issued_on`) VALUES (NULL, '" . $book_id . "', '" . $user_email . "', CURRENT_TIMESTAMP);";
    $result = $conn->query($sql);

    return $result;
}

function unissueBook($id) {
    include("../connection.php");
    $sql = "DELETE FROM `register` WHERE `register`.`id` = $id";
    $result = $conn->query($sql);

    return $result;
}

function deleteBook($id) {
    include("../connection.php");
    $sql = "DELETE FROM `books` WHERE `books`.`id` = $id";
    $result = $conn->query($sql);

    return $result;
}

function deleteUser($id) {
    include("../connection.php");
    $sql = "DELETE FROM `users` WHERE `users`.`email` = '$id'";
    $result = $conn->query($sql);

    return $result;
}

function updateBook($id, $name, $authors, $count) {
    include("../connection.php");
    $sql = "UPDATE `books` SET `name` = '$name', `authors` = '$authors', `count` = '$count' WHERE `books`.`id` = $id;";
    $result = $conn->query($sql);

    return $result;
}

function updateUser($email, $name) {
    include("../connection.php");
    $sql = "UPDATE `users` SET `name` = '$name' WHERE `users`.`email` = '$email';";
    $result = $conn->query($sql);

    return $result;
}