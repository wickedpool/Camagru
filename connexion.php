<?php
session_start();
include_once 'db.php';

if (empty($_POST[login]) || empty($_POST[passwd])) {
      header("Location: connexion_user.php?msg=Merci de remplir tous les champs.\n");
      exit();
  }
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT COUNT(*) FROM membres WHERE login = :login');
      $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error :'.$e->getMessage();
  }
  if ($user = $sth->fetchColumn()) {
      try {
          $passwd = sha1($_POST[passwd]);

          $sth = $dbh->prepare('SELECT COUNT(*) FROM membres WHERE passwd = :passwd AND login = :login');
          $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
          $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
          $sth->execute();
      } catch (PDOException $e) {
          echo 'Error :'.$e->getMessage();
      }
      if ($sth->fetchColumn()) {
          try {
              $sth = $dbh->prepare("SELECT COUNT(*) FROM membres WHERE passwd = :passwd AND login = :login AND active = '1'");
              $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
              $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
              $sth->execute();
          } catch (PDOException $e) {
              echo 'Error :'.$e->getMessage();
          }
          if ($sth->fetchColumn()) {
              $_SESSION['login'] = $_POST[login];
              header("Location: index.php?msg=Content de vous revoir ".$_POST[login]." !\n");
              exit();
          } else {
              header("Location: index.php?msg=Activer votre compte.\n");
          }
      } else {
          header("Location: connexion_user.php?msg=Mauvais mot de passe.\n");
          exit();
      }
  } else {
      header("Location: connexion_user.php?msg=Le compte n'existe pas.\n");
      exit();
  }
?>
