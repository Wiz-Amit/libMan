<?php
$userDB = new UserDB();
$bookDB = new BookDB();
//add or update book
if (isset($_POST["save-book"]) && isset($_POST["book-id"]) && isset($_POST["book-name"]) && isset($_POST["book-authors"]) && isset($_POST["book-count"])) {
    if ($_POST["book-id"] == 0) {
        $bookDB->add($_POST["book-name"], $_POST["book-authors"], $_POST["book-count"]);
    } else {
        $bookDB->update($_POST["book-id"], $_POST["book-name"], $_POST["book-authors"], $_POST["book-count"]);
    }
}

//add or update user
elseif (isset($_POST["save-user"]) && isset($_POST["user-update"]) && isset($_POST["user-email"]) && isset($_POST["user-name"])) {
    // if (preg_match("/[^A-Za-z'-]/", $_POST["user-name"])) {
    //     die("invalid name and name should be alpha");
    // }
    if ($_POST["user-update"] == "true") {
        $userDB->update($_POST["user-email"], $_POST["user-name"]);
    } else {
        $userDB->add($_POST["user-email"], $_POST["user-name"]);
    }
}

//issue book
elseif (isset($_POST["issue-book"]) && isset($_POST["book-id"]) && isset($_POST["user-email"])) {
    $bookDB->issue($_POST["book-id"], $_POST["user-email"]);
}

// delete book
elseif (isset($_POST["delete-book"])) {
    $bookDB->delete($_POST["book-id"]);
}

//delete user
elseif (isset($_POST["delete-user"])) {
    $userDB->delete($_POST["user-email"]);
}

//unissue book
elseif (isset($_POST["return-book"]) && isset($_POST["issue-id"])) {
    $bookDB->unissue($_POST["issue-id"]);
}
