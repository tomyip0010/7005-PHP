<?php
namespace wad;

class Post{
    // This is a class to create Post object
    protected $user;
    protected $message;
    protected $image;
    protected $date;

    function __construct($user, $message, $image, $date) {
        // This is the class constructor
        $this -> user = $user;
        $this -> message = $message;
        $this -> image = $image;
        $this -> date = $date;
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
}
?>