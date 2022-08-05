<?php
namespace wad;
use wad\Comment;
include 'comment.php';

class Post{
    // This is a class to create Post object
    protected string $user;
    protected string $message;
    protected string $image;
    protected string $date;
    protected array $comments;

    function __construct(string $user, string $message, string $image, string $date) {
        // This is the class constructor
        $this -> user = $user;
        $this -> message = $message;
        $this -> image = $image;
        $this -> date = $date;
        $this -> comments = [];
    }

    function getUser(): string {
        // This method will return the post's username
        return $this -> user;
    }

    function getMessage(): string {
        // This method will return the post's message
        return $this -> message;
    }

    function getImage(): string {
        // This method will return the post's image
        return $this -> image;
    }

    function getDate(): string {
        // This method will return the post's date
        return $this -> date;
    }

    function getComment(): array {
        // This method will return the post's comment
        return $this -> comments;
    }

    function addComment(string $user, string $comment) {
        // This method will create a comment to the post
        $this -> comments[] = new Comment($user, $comment);
    }
}
?>