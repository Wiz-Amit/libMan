<?php
//add book
if (isset($_POST["book-name"]) && isset($_POST["book-authors"]) && isset($_POST["book-count"])) {
    addBook($_POST["book-name"], $_POST["book-authors"] , $_POST["book-count"]);
}

//add user
if (isset($_POST["user-email"]) && isset($_POST["user-name"])) {
    // if (preg_match("/[^A-Za-z'-]/", $_POST["user-name"])) {
    //     die("invalid name and name should be alpha");
    // }
    // echo "email:" . $_POST["user-email"] . "<br> name:" . $_POST["user-name"] . "";
    addUser($_POST["user-email"], $_POST["user-name"]);
}

//issue book
if (isset($_POST["book-id"]) && isset($_POST["user-email"])) {
    issueBook($_POST["book-id"], $_POST["user-email"]);
}
?>