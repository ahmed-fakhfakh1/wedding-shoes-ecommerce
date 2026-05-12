<?php
class connexion{
    public function cnxBase(){
        $pdo=new PDO('mysql:host=localhost;dbname=shoesStore', 'root', '');
        return $pdo;
    }
}
?>
