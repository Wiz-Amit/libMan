<?php
include "./user.php";
include "./book.php";

class Database
{
    protected function toArray($result)
    {
        if (is_bool($result)) return $result;

        $rows = [];
        while ($row = mysqli_fetch_array($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    protected function selectAll($tableName, $orderBy = "id")
    {
        $sql = "SELECT * FROM $tableName ";
        $sql = $sql . "ORDER BY `$orderBy` asc;";
        return $this->runSQL($sql);
    }

    protected function runSQL($sql)
    {
        include("../connection.php");
        $result = $conn->query($sql);
        if(!$result) {
            echo("Error description: " . $conn->error);
        }
        return $this->toArray($result);
    }
}

class UserDB extends Database
{
    public function getAll()
    {
        $result = $this->selectAll("users", "name");
        $users = [];
        foreach ($result as $user) {
            $users[] = new User($user["email"], $user["name"]);
        }

        return $users;
    }

    public function add($email, $name)
    {
        $sql = "INSERT INTO `users` (`email`, `name`) VALUES ('" . $email . "', '" . $name . "');";
        return $this->runSQL($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `users` WHERE `users`.`email` = '$id'";
        return $this->runSQL($sql);
    }

    public function update($email, $name)
    {
        $sql = "UPDATE `users` SET `name` = '$name' WHERE `users`.`email` = '$email';";
        return $this->runSQL($sql);
    }
}

class BookDB extends Database
{
    public function getAll()
    {
        $result = $this->selectAll("books", "name");
        $books = [];
        foreach ($result as $user) {
            $books[] = new Book($user["id"], $user["name"], $user["authors"], $user["count"]);
        }

        return $books;
    }

    public function get($id)
    {
        $sql = "SELECT * FROM books WHERE id = $id;";
        return $this->runSQL($sql);
    }

    public function have($id)
    {
        $book = $this->get($id)[0];
        return ($book["count"] > 0);
    }

    public function increaseBookCount($id, $val = 1)
    {
        $sql = "UPDATE books SET count = count + $val WHERE id = $id;";
        return $this->runSQL($sql);
    }

    public function decreaseBookCount($id, $val = 1)
    {
        $sql = "UPDATE books SET count = count - $val WHERE id = $id;";
        return $this->runSQL($sql);
    }

    public function add($name, $authors, $count)
    {
        $sql = "INSERT INTO `books` (`id`, `name`, `authors`, `count`)
        VALUES (NULL, '" . $name . "', '" . $authors . "', '" . $count . "');";
        return $this->runSQL($sql);
    }

    public function getRegister()
    {
        $sql = "SELECT * FROM `register`
        INNER JOIN (SELECT email as user_email, name as username FROM `users`) u
        ON register.user_email = u.user_email
        INNER JOIN (SELECT id as book_id, name as book_name FROM `books`) b
        on register.book_id = b.book_id ORDER BY id desc;";
        return $this->runSQL($sql);
    }

    public function issue($book_id, $user_email)
    {
        $sql = "INSERT INTO `register` (`id`, `book_id`, `user_email`, `issued_on`)
        VALUES (NULL, '" . $book_id . "', '" . $user_email . "', CURRENT_TIMESTAMP);";

        if ($this->have($book_id)) {
            $this->decreaseBookCount($book_id);
            return $this->runSQL($sql);
        }
    }

    public function unissue($id)
    {
        //getting book id
        $sql = "SELECT * FROM `register`WHERE `register`.`id` = $id";
        $issueRecord = $this->runSQL($sql)[0];

        $this->increaseBookCount($issueRecord["book_id"]);

        //deleting issue record
        $sql = "DELETE FROM `register` WHERE `register`.`id` = $id";

        return $this->runSQL($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `books` WHERE `books`.`id` = $id";
        return $this->runSQL($sql);
    }

    public function update($id, $name, $authors, $count)
    {
        $sql = "UPDATE `books` SET `name` = '$name', `authors` = '$authors', `count` = '$count' WHERE `books`.`id` = $id;";
        return $this->runSQL($sql);
    }
}