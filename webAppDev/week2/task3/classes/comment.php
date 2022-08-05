<?php
namespace wad;

class Comment{
    // This is a class to create Comment object
    protected $user;
    protected $comment;

    function __construct($user, $comment) {
        // This is the class constructor
        $this -> user = $user;
        $this -> comment = $comment;
    }

    function getUser() {
        // This method will return the post's username
        return $this -> user;
    }

    function getComment() {
        return $this -> comment;
    }
}
?>