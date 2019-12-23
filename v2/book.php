<?php
class Book
{
    public $id;
    public $name;
    public $author;
    public $count;

    function __construct($id, $name, $authors, $count)
    {
        $this->id = $id;
        $this->name = $name;
        $this->authors = $authors;
        $this->count = $count;
    }
}