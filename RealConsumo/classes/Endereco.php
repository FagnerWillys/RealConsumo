<?php
require_once 'Acesso.php';
require_once 'Util.php';
class Endereco {

    private $CNPJ;
    private $CEP;
    private $N_Predio;
    private $Complemento;
    private $Endereco;
    private $Bairro;
    private $Municipio;
    private $UF;

    function __construct() {
        //if (!isset($_SESSION)) {
        //    session_start();
        //}
    }

    function getEndereco() {
        return $this->Endereco;
    }

    function setEndereco($Endereco) {
        $this->Endereco = $Endereco;
    }

    function getCNPJ() {
        return $this->CNPJ;
    }

    function getCEP() {
        return $this->CEP;
    }

    function getN_Predio() {
        return $this->N_Predio;
    }

    function getComplemento() {
        return $this->Complemento;
    }

    function getBairro() {
        return $this->Bairro;
    }

    function getMunicipio() {
        return $this->Municipio;
    }

    function getUF() {
        return $this->UF;
    }

    function setCNPJ($CNPJ) {
        $this->CNPJ = $CNPJ;
    }

    function setCEP($CEP) {
        $this->CEP = $CEP;
    }

    function setN_Predio($N_Predio) {
        $this->N_Predio = $N_Predio;
    }

    function setComplemento($Complemento) {
        $this->Complemento = $Complemento;
    }

    function setBairro($Bairro) {
        $this->Bairro = $Bairro;
    }

    function setMunicipio($Municipio) {
        $this->Municipio = $Municipio;
    }

    function setUF($UF) {
        $this->UF = $UF;
    }

    //FUNÇÕES UTEIS
    public function maskCEP($CEP) {
        $CEP1 = substr($CEP, 0, -3);
        $CEP2 = substr($CEP, 5);
        return $CEP1 . "-" . $CEP2;
    }

//CRUD
        public function consultar($sql) {
        try {
            if($sql == null){
                $sql = 'SELECT * FROM endereco;';
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

    public function incluirEXP($CNPJ, $CEP, $N_Predio, $Complemento, $Endereco, $Bairro, $Municipio, $UF) {
        try {

            $sql = 'insert into endereco(CNPJ, CEP, N_Predio, Complemento, Endereco, Bairro, Municipio, UF) values(?, ?, ?, ?, ?, ?, ?, ?);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

          
            $Endereco = utf8_decode($Endereco);
            $Bairro = utf8_decode($Bairro);
            $Municipio = utf8_decode($Municipio);
            $UF = utf8_decode($UF);

            $stmt->bindParam(1, $CNPJ);
            $stmt->bindParam(2, $CEP);
            $stmt->bindParam(3, $N_Predio);
            $stmt->bindParam(4, $Complemento);
            $stmt->bindParam(5, $Endereco);
            $stmt->bindParam(6, $Bairro);
            $stmt->bindParam(7, $Municipio);
            $stmt->bindParam(8, $UF);


            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela endereco = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    public function alterarEXP($CNPJ, $CEP, $N_Predio, $Complemento, $Endereco, $Bairro, $Municipio, $UF) {
        try {

            $sql = 'update endereco set N_Predio=?, Complemento=?, Endereco = ?, Bairro=?, Municipio=?, UF=? where CNPJ=? and CEP=?;';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $Endereco = utf8_decode($Endereco);
            $Bairro = utf8_decode($Bairro);
            $Municipio = utf8_decode($Municipio);
            $UF = utf8_decode($UF);

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $N_Predio);
            $stmt->bindParam(2, $Complemento);
            $stmt->bindParam(3, $Endereco);
            $stmt->bindParam(4, $Bairro);
            $stmt->bindParam(5, $Municipio);
            $stmt->bindParam(6, $UF);
            $stmt->bindParam(7, $CNPJ);
            $stmt->bindParam(8, $CEP);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela endereco = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    public function incluir2($CNPJ, $CEP, $NPredio, $Complemento) {
        try {
            
            $util = new Util();
            $XML = $util->busca_cep($CEP);

            $Endereco = $XML->logradouro;
            $Bairro = $XML->bairro;
            $Municipio = $XML->localidade;
            $UF = $XML->uf;

            $Endereco = utf8_decode($Endereco);
            $Bairro = utf8_decode($Bairro);
            $Municipio = utf8_decode($Municipio);
            $UF = utf8_decode($UF);
           
            
            $sql = 'insert into endereco(CNPJ, CEP, N_Predio, Complemento, Endereco, Bairro, Municipio, UF) values(?, ?, ?, ?, ?, ?, ?, ?);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(1, $CNPJ);
            $stmt->bindParam(2, $CEP);
            $stmt->bindParam(3, $NPredio);
            $stmt->bindParam(4, $Complemento);
            $stmt->bindParam(5, $Endereco);
            $stmt->bindParam(6, $Bairro);
            $stmt->bindParam(7, $Municipio);
            $stmt->bindParam(8, $UF);


            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela endereco = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    public function alterar($CNPJ, $CEP, $N_Predio, $Complemento) {
        try {
            $util = new Util();
            $XML = $util->busca_cep($CEP);

            $Endereco = $XML->logradouro;
            $Bairro = $XML->bairro;
            $Municipio = $XML->localidade;
            $UF = $XML->uf;

            $Endereco = utf8_decode($Endereco);
            $Bairro = utf8_decode($Bairro);
            $Municipio = utf8_decode($Municipio);
            $UF = utf8_decode($UF);
            
            $sql = 'update endereco set N_Predio=?, Complemento=?, Endereco = ?, Bairro=?, Municipio=?, UF=? where CNPJ=? and CEP=?;';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $N_Predio);
            $stmt->bindParam(2, $Complemento);
            $stmt->bindParam(3, $Endereco);
            $stmt->bindParam(4, $Bairro);
            $stmt->bindParam(5, $Municipio);
            $stmt->bindParam(6, $UF);
            $stmt->bindParam(7, $CNPJ);
            $stmt->bindParam(8, $CEP);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela endereco = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }


}
