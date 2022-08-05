<?php
namespace wad;
use wad\Comment;
include 'comment.php';

class Post{
    // This is a class to create Post object
    protected $user;
    protected $message;
    protected $image;
    protected $date;
    protected $comments;

    function __construct($user, $message, $image, $date) {
        // This is the class constructor
        $this -> user = $user;
        $this -> message = $message;
        $this -> image = $image;
        $this -> date = $date;
        $this -> comments = [];
    }

    function getUser() {
        // This method will return the post's username
        return $this -> user;
    }

    function getMessage() {
        // This method will return the post's message
        return $this -> message;
    }

    function getImage() {
        // This method will return the post's image
        return $this -> image;
    }

    function getDate() {
        // This method will return the post's date
        return $this -> date;
    }

    function getComment() {
        return $this -> comments;
    }

    function addComment($user, $comment) {
        $this -> comments[] = new Comment($user, $comment);
    }
}
?>