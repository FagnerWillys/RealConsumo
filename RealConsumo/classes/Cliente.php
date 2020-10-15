<?php

require_once 'Acesso.php';

class Cliente {

    private $CNPJ;
    private $Email;
    private $DataReg;

    function __construct() {
//        if (!isset($_SESSION)) {
//            session_start();
 //       }
    }

    function getCNPJ() {
        return $this->CNPJ;
    }

    function getEmail() {
        return $this->Email;
    }


    function getDataReg() {
        return $this->DataReg;
    }

    function setCNPJ($CNPJ) {
        $this->CNPJ = $this->maskcnpj($CNPJ);
    }

    function setEmail($Email) {
        $this->Email = $Email;
    }


    function setDataReg($DataReg) {
        $this->DataReg = $DataReg;
    }

    //FUNÇÕES UTEIS
    public function maskcnpj($value) {
        $cnpj_cpf = preg_replace("/\D/", '', $value);

        if (strlen($cnpj_cpf) === 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    public function maskDataParaSql($dateSql) {
        $ano = substr($dateSql, 6);
        $mes = substr($dateSql, 3, -5);
        $dia = substr($dateSql, 0, -8);
        return $ano . "-" . $mes . "-" . $dia;
    }
    public function maskDataParaHTML($dateSql) {
        $ano = substr($dateSql, 0, -6);
        $mes = substr($dateSql, 5,-3);
        $dia = substr($dateSql, 8);
        
        return $dia . "-" . $mes . "-" . $ano;
    }

    //CRUD
        public function consultar($sql) {
        try {
            if($sql == null){
                $sql = 'SELECT * FROM clientes;';
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

    public function incluirEXP($CNPJ, $Email, $DataReg) {
        try {

            $sql = 'insert into clientes(CNPJ, Email, DataReg) values(?, ?, ?);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $CNPJ);
            $stmt->bindParam(2, $Email);
            $stmt->bindParam(3, $DataReg);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela clientes = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }
    public function incluir($CNPJ, $Email) {
        try {

            $sql = 'insert into clientes(CNPJ, Email, DataReg) values(?, ?, NOW());';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $CNPJ);
            $stmt->bindParam(2, $Email);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela clientes = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    public function alterarEXP($CNPJ, $Email, $DataReg) {
        try {

            $sql = 'update clientes set Email=?, DataReg=? where CNPJ=?;';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $Email);
            $stmt->bindParam(2, $$DataReg);
            $stmt->bindParam(3, $CNPJ);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela clientes = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }
    public function alterar($CNPJ, $Email) {
        try {

            $sql = 'update clientes set Email=?, DataReg=NOW() where CNPJ=?;';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $Email);
            $stmt->bindParam(2, $CNPJ);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela clientes = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }
    
    public function Limpar() {
        try {
                $sql = 'DELETE FROM clientes where cnpj != "" limit 100000;';
                $sql = str_replace("'", "\'", $sql);

            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt1 = $pdo->prepare($sql);
            $stmt1->execute();

        } catch (PDOException $e) {
            echo 'Error: <b>  no delete = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

}



            