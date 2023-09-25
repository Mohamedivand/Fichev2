<?php
    try{
        $pdo=new PDO("mysql:host=localhost;dbname=Fiches","root","");
    }catch(Exception $e){
        die('Erreur de connexion: ' .$e->getMessage());
    }
?>