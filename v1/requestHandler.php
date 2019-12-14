<?php
if (isset($_POST["user-email"]) && isset($_POST["user-name"])) {
    // if (preg_match("/[^A-Za-z'-]/", $_POST["user-name"])) {
    //     die("invalid name and name should be alpha");
    // }
    // echo "email:" . $_POST["user-email"] . "<br> name:" . $_POST["user-name"] . "";
    addUser($_POST["user-email"], $_POST["user-name"]);
}

if (isset($_POST["book-name"]) && isset($_POST["author-id"])) {
    addUser($_POST["book-name"], $_POST["author-name"]);
}
