<?php   
class user{
    public $id;
    public $name;
    public $address;
    public $email;
    public $password;
    public $phone;
    public function insert(){
        require_once(__DIR__ . '/../includes/config.php');
        $cnx=new connexion();
        $pdo=$cnx->cnxBase();
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $req="insert into users (name, email, phone, address, password) values ('$this->name','$this->email','$this->phone','$this->address','$hashedPassword') ";
        $pdo->exec($req);
    }
    public function createUser(){
        require_once(__DIR__ . '/../includes/config.php');
        $cnx=new connexion();
        $pdo=$cnx->cnxBase();
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $req="insert into users (name, email, phone, address, password) values ('$this->name','$this->email','$this->phone','$this->address','$hashedPassword') ";
        $pdo->exec($req);
    }
    public function login(){
        require_once(__DIR__ . '/../includes/config.php');
        $cnx=new connexion();
        $pdo=$cnx->cnxBase();
        $req="select * from users where email='$this->email'";
        $result=$pdo->query($req);
        $row=$result->fetch(PDO::FETCH_ASSOC);
        if($row && password_verify($this->password, $row['password'])) {
            return $row;
        } else {
            return false;
        }
    }
}
?>
