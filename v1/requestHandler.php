<?php
//add or update book
if (isset($_POST["save-book"]) && isset($_POST["book-id"]) && isset($_POST["book-name"]) && isset($_POST["book-authors"]) && isset($_POST["book-count"])) {
    if ($_POST["book-id"] == 0) {
        addBook($_POST["book-name"], $_POST["book-authors"], $_POST["book-count"]);
    } else {
        updateBook($_POST["book-id"], $_POST["book-name"], $_POST["book-authors"], $_POST["book-count"]);
    }
}

//add or update user
elseif (isset($_POST["save-user"]) && isset($_POST["user-update"]) && isset($_POST["user-email"]) && isset($_POST["user-name"])) {
    // if (preg_match("/[^A-Za-z'-]/", $_POST["user-name"])) {
    //     die("invalid name and name should be alpha");
    // }
    // echo "email:" . $_POST["user-email"] . "<br> name:" . $_POST["user-name"] . "";
    if ($_POST["user-update"] == "true") {
        updateUser($_POST["user-email"], $_POST["user-name"]);
    } else {
        addUser($_POST["user-email"], $_POST["user-name"]);
    }
}

//issue book
elseif (isset($_POST["issue-book"]) && isset($_POST["book-id"]) && isset($_POST["user-email"])) {
    issueBook($_POST["book-id"], $_POST["user-email"]);
}

// delete book
elseif (isset($_POST["delete-book"])) {
    deleteBook($_POST["book-id"]);
}

//delete user
elseif (isset($_POST["delete-user"])) {
    deleteUser($_POST["user-email"]);
}

//unissue book
elseif (isset($_POST["return-book"]) && isset($_POST["issue-id"])) {
    unissueBook($_POST["issue-id"]);
}
