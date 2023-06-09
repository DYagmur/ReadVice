<?php

class UserCommentDAO {
   private static $db;

   public static function startDb() {
      self::$db = new PDOService("UserComment");
   }

   public static function getAllComments() {
      $sql = "SELECT * FROM user_comment";

      self::$db->query($sql);
      self::$db->execute();

      return self::$db->resultSet();
   }

   public static function getCommentById($commentId) {
      $sql = "SELECT * FROM user_comment WHERE commentId = :id";

      self::$db->query($sql);
      self::$db->bind(":commentId", $commentId);

      self::$db->execute();
      
      return self::$db->singleResult();
   } 

   public static function getCommentByBookId($bookId) {
      $sql = "SELECT * FROM user_comment WHERE bookId = :id";

      self::$db->query($sql);
      self::$db->bind(":id", $bookId);

      self::$db->execute();
      
      return self::$db->singleResult();
   } 

   public static function getAllCommentByBookId($bookId) {
      $sql = "SELECT * FROM user_comment WHERE bookId = :id";

      self::$db->query($sql);
      self::$db->bind(":id", $bookId);

      self::$db->execute();
      
      return self::$db->resultSet();
   } 

   public static function insertNewComment($comment) {
    $sql = "INSERT INTO user_comment(userCommentName, bookId, date, message) VALUES (:username, :bookId, :date, :message)";

    self::$db->query($sql);

    self::$db->bind(":username", $comment->getUserCommentName());
    self::$db->bind(":bookId", $comment->getBookCommentId());
    self::$db->bind(":date", $comment->getCommentDate());
    self::$db->bind(":message", $comment->getMessage());
    
    self::$db->execute();

    return self::$db->lastInsertedId();
 }
}