<?php

require_once("inc/config.inc.php");

require_once("inc/Entities/Book.class.php");
require_once("inc/Entities/User.class.php");
require_once("inc/Entities/UserComment.class.php");
require_once("inc/Utilities/Repositories/BookRepository.class.php");

require_once("inc/Utilities/PDOService.class.php");
require_once("inc/Utilities/DAO/BookDAO.class.php");
require_once("inc/Utilities/DAO/UserDAO.class.php");
require_once("inc/Utilities/DAO/UserCommentDAO.class.php");

require_once("inc/Page.class.php");
require_once("inc/PageContent.class.php");


BookDAO::startDb();
UserDAO::startDb();
UserCommentDAO::startDb();


if (!empty($_GET['book'])) {
   $book = BookDAO::getBookById($_GET['book']);
} 

if (!empty($_POST['post_comment'])) {

   session_start();

   $currentDate = date("y-m-d");

   $userComment = new UserComment();
   $userComment->setUserCommentId(1);
   $userComment->setBookCommentId("1000751.Pollyanna");
   $userComment->setCommentDate($currentDate);
   $userComment->setMessage($_POST['post_comment']);

   $lastIdInserted = UserCommentDAO::insertNewComment($userComment);

   if(isset($_POST['submitComment'])) {
      header("Location: index.php");
   }
} 


echo Page::pageHeader();
echo PageContent::pageBookDetail($book);

echo Page::pageFooter();
