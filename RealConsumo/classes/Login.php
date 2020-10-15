<?php

require_once 'Acesso.php';
require_once 'Util.php';

class Login {

    private $LOGIN;
    private $SENHA;
    private $Status;

    function __construct() {
        //if (!isset($_SESSION)) {
        //    session_start();
        //}
    }

    function getLOGIN() {
        return $this->LOGIN;
    }

    function getSENHA() {
        return $this->SENHA;
    }

    function getStatus() {
        return $this->Status;
    }

    function setLOGIN($LOGIN) {
        $this->LOGIN = $LOGIN;
    }

    function setSENHA($SENHA) {
        $this->SENHA = $SENHA;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }

    //CRUD
        public function consultar($sql) {
        try {
            if($sql == null){
                $sql = 'SELECT * FROM login;';
            }
            $acesso = new Acesso();
          $pdo = $acesso->conexao();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $data = $pdo->query($sql);

          return $data;  
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }


    public function alterar($LOGIN, $SENHANOVA, $SENHAANTERIOR) {
        try {
            $sql = 'UPDATE login SET SENHA = ? WHERE LOGIN = ? AND SENHA = ?;';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(1, $SENHANOVA);
            $stmt->bindParam(2, $LOGIN);
            $stmt->bindParam(3, $SENHAANTERIOR);


            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela Login = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

}
