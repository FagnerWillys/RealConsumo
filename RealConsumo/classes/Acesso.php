<?php
class Acesso {
//SITE ONLINE
    
    //private $host = "mysql104.prv.f1.k8.com.br"; //Provisorio
    private $host = "mysql.realconsumo.com.br"; //Definitivo
    private $usuario = "realconsumo";
    private $senha = "R&@LC0NSUM0BD_K@TI@";
    private $banco = "realconsumo";
    
    
/*LOCALHOST    
    private $host = 'localhost';
    private $usuario = 'root';
    private $senha = '';
    private $banco = 'realconsumo';
*/
    
    
    public $result;
    public $linha;
	
	
    function __construct() {
//        if (!isset($_SESSION)) {
//            session_start();
//        }
    }

    
    function getHost() {

        return $this->host;

    }



    function getUsuario() {

        return $this->usuario;

    }



    function getSenha() {

        return $this->senha;

    }



    function getBanco() {

        return $this->banco;

    }

    public function conexao() {

        try {
            $host = $this->getHost();
            $banco = $this->getBanco();
            $user = $this->getUsuario();
            $senha = $this->getSenha();
                    
            $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $banco, $user, $senha);
            //$pdo = new PDO('mysql:host=' . $this->getHost() . ';dbname=' . $this->getBanco(), $this->getUsuario(), $this->getSenha());

            return $pdo;

        } catch (PDOException $e) {

            echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();

        }

    }



    public function query($sql) {

	$pdo = $this->conexao();
        $rs = $pdo->query($sql);
        if (!$rs) {

            echo " <b>Reveja a consulta (SQL) : $sql</b>";

        }
        $this->result = $rs->fetchAll();
        $this->linha = $rs->rowCount();
        
    }



    public function execute($sql) {

        $pdo = $this->conexao();

        $rs = $pdo->prepare($sql);

        //$this->linha = $rs->rowCount();        

    }



    public function __destruct() {

        @mysqli_close($this->cnx);

    }

     
     
}
?>