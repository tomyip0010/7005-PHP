<?php
namespace wad;

class Comment{
    // This is a class to create Comment object
    protected string $user;
    protected string $comment;

    function __construct(string $user, string $comment) {
        // This is the class constructor
        $this -> user = $user;
        $this -> comment = $comment;
    }

    function getUser(): string {
        // This method will return the username of the comment
        return $this -> user;
    }

    function getComment(): string {
        // This method will return the comment content
        return $this -> comment;
    }
}
?>