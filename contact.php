<?php

//Initialisation de l'objet PDO et ouverture de la connexion pour appel à la base de données
$Pdo_Object = new PDO("mysql:host=127.0.0.1;dbname=DataBase","user","password",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION )); 

try {
   //Contrôle de l'éxistance des deux paramètres email et content
   if(!isset($_POST['name'])) throw new Exception("Le paramètre name est absent");
   if(!isset($_POST['email'])) throw new Exception("Le paramètre email est absent");
   if(!isset($_POST['subject'])) throw new Exception("Le paramètre subject est absent");
   if(!isset($_POST['message'])) throw new Exception("Le paramètre message est absent");
 
   //Contrôle des formats des deux paramètres via les expressions régulières
   $Format_Email = '#[a-z0-9]{1,}[\-\_\.a-z0-9]{0,}@[a-z]{2,}[\-\_\.a-z0-9]{0,}\.[a-z]{2,6}$#';
   $Format_Content = '#^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\.\_\-\s]{5,500}$#';
   if(!preg_match($Format_Email, $_POST['email']))  throw new Exception("Le paramètre email ne correspond pas au format attendu");
   if(!preg_match($Format_Content , $_POST['content']))  throw new Exception("Le paramètre content ne correspond pas au format attendu - limite de 500 caractères");
 
  //Tableau associatif pour requête d'insertion 
  $Arr_Key_Value = array(
                         'email' => $_POST['email']
                         'content' => $_POST['content']),
                         'email' => $_POST['email'],
                         'content' => $_POST['content']);
  //Requête d'insertion
  $Sql_Query = "INSERT INTO contact(email,content) VALUES (:email,:content)";
  
  //Préparation de la requête (sécurisation des variables du tableau associatif)
  $Request= $Pdo_Object->prepare($Sql_Query);
  
  //Exécution de la requête 
  $Request->execute($Arr_Key_Value);
} catch (Exception $e) {
   echo $e->getMessage(); 
}
finally{
 //Attention le finaly ne fonctionne que sur php 5.6 et supérieur 
 //Fermeture de la connexion en détruisant la référence mémoire à l'objet PDO
 $Pdo_Object = null;
}

?>