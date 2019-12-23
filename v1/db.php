<?php

function toArray($result)
{
    if (is_bool($result)) return $result;

    $rows = [];
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function runSQL($sql)
{
    include("../connection.php");
    $result = $conn->query($sql);
    return toArray($result);
}

function getUsers()
{
    $sql = "SELECT * FROM users ORDER BY `name` asc;";
    return runSQL($sql);
}

function addUser($email, $name)
{
    $sql = "INSERT INTO `users` (`email`, `name`) VALUES ('" . $email . "', '" . $name . "');";
    return runSQL($sql);
}

function getBooks()
{
    $sql = "SELECT * FROM books ORDER BY `name` asc;";
    return runSQL($sql);
}

function getBook($id)
{
    $sql = "SELECT * FROM books WHERE id = $id;";
    return runSQL($sql);
}

function haveBook($id)
{
    $book = getBook($id)[0];
    return ($book["count"] > 0);
}

function increaseBookCount($id, $val = 1)
{
    $sql = "UPDATE books SET count = count + $val WHERE id = $id;";
    return runSQL($sql);
}

function decreaseBookCount($id, $val = 1)
{
    $sql = "UPDATE books SET count = count - $val WHERE id = $id;";
    return runSQL($sql);
}

function addBook($name, $authors, $count)
{
    $sql = "INSERT INTO `books` (`id`, `name`, `authors`, `count`)
    VALUES (NULL, '" . $name . "', '" . $authors . "', '" . $count . "');";
    return runSQL($sql);
}

function getRegister()
{
    $sql = "SELECT * FROM `register`
    INNER JOIN (SELECT email as user_email, name as username FROM `users`) u ON register.user_email = u.user_email
    INNER JOIN (SELECT id as book_id, name as book_name FROM `books`) b on register.book_id = b.book_id ORDER BY id desc;";
    return runSQL($sql);
}

function issueBook($book_id, $user_email)
{
    $sql = "INSERT INTO `register` (`id`, `book_id`, `user_email`, `issued_on`) VALUES (NULL, '" . $book_id . "', '" . $user_email . "', CURRENT_TIMESTAMP);";

    if (haveBook($book_id)) {
        decreaseBookCount($book_id);
        return runSQL($sql);
    }
}

function unissueBook($id)
{
    //getting book id
    $sql = "SELECT * FROM `register` WHERE `register`.`id` = $id";
    $issueRecord = runSQL($sql)[0];

    increaseBookCount($issueRecord["book_id"]);

    //deleting issue record
    $sql = "DELETE FROM `register` WHERE `register`.`id` = $id";

    return runSQL($sql);
}

function deleteBook($id)
{
    $sql = "DELETE FROM `books` WHERE `books`.`id` = $id";
    return runSQL($sql);
}

function deleteUser($id)
{
    $sql = "DELETE FROM `users` WHERE `users`.`email` = '$id'";
    return runSQL($sql);
}

function updateBook($id, $name, $authors, $count)
{
    $sql = "UPDATE `books` SET `name` = '$name', `authors` = '$authors', `count` = '$count' WHERE `books`.`id` = $id;";
    return runSQL($sql);
}

function updateUser($email, $name)
{
    $sql = "UPDATE `users` SET `name` = '$name' WHERE `users`.`email` = '$email';";
    return runSQL($sql);
}
