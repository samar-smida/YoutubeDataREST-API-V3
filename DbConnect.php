<?php
   class DbConnect {
       private $host   = "localhost";
       private $dbName = "youtubeapi";
       private $user   = "root" ;
       private $pass   = "" ;


       public function connect() {
           try{
               $conn = new PDO('mysql:host=localhost;dbname=youtubeapi;charset=utf8', 'root','' ) ;
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ; 
               return $conn ;
           }catch( PDOException $e) {
               echo 'DATAbase Error: ' . $e->getMessage() ; 
           }
       }
   }



?>