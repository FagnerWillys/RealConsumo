<?php

require_once 'Acesso.php';
require_once 'Util.php';

class Conta {

    private $LANT;
    private $LATU;
    private $tpResidencia;
    private $Tarifa;
    private $Economias;
    private $V_AGUA;
    private $RECURSO_HIDROM;
    private $TX_ANUAL;
    private $V_ESGOTO;
    private $ValorConta;
    private $DataConta;

    function __construct() {
        //if (!isset($_SESSION)) {
        //    session_start();
        //}
    }

    function CALCULAR() {
        $this->setV_AGUA(($this->getLATU() - $this->getLANT()) * $this->getTarifa());
        $this->setV_ESGOTO($this->getV_AGUA());
        $this->setRECURSO_HIDROM($this->getV_AGUA() * 0.025);
        $this->setTX_ANUAL($this->getV_AGUA() * 0.01);

        $Total = $this->getV_AGUA() + $this->getRECURSO_HIDROM() + $this->getTX_ANUAL() + $this->getV_ESGOTO();
        return $Total;
    }

    function getDataConta() {
        return $this->DataConta;
    }

    function setDataConta($DataConta) {
        $this->DataConta = $DataConta;
    }

    function getV_AGUA() {
        return $this->V_AGUA;
    }

    function getRECURSO_HIDROM() {
        return $this->RECURSO_HIDROM;
    }

    function getTX_ANUAL() {
        return $this->TX_ANUAL;
    }

    function getV_ESGOTO() {
        return $this->V_ESGOTO;
    }

    function setV_AGUA($V_AGUA) {
        $this->V_AGUA = $V_AGUA;
    }

    function getValorConta() {
        return $this->ValorConta;
    }

    function setValorConta($ValorConta) {
        $this->ValorConta = $ValorConta;
    }

    function setRECURSO_HIDROM($RECURSO_HIDROM) {
        $this->RECURSO_HIDROM = $RECURSO_HIDROM;
    }

    function setTX_ANUAL($TX_ANUAL) {
        $this->TX_ANUAL = $TX_ANUAL;
    }

    function setV_ESGOTO($V_ESGOTO) {
        $this->V_ESGOTO = $V_ESGOTO;
    }

    function getLANT() {
        return $this->LANT;
    }

    function getLATU() {
        return $this->LATU;
    }

    function getTpResidencia() {
        return $this->tpResidencia;
    }

    function getTarifa() {
        return $this->Tarifa;
    }

    function getEconomias() {
        return $this->Economias;
    }

    function setLANT($LANT) {
        $this->LANT = $LANT;
    }

    function setLATU($LATU) {
        $this->LATU = $LATU;
    }

    function setTpResidencia($tpResidencia) {
        $this->tpResidencia = $tpResidencia;
    }

    function setTarifa($Tarifa) {
        $this->Tarifa = $Tarifa;
    }

    function setEconomias($Economias) {
        $this->Economias = $Economias;
    }

    //CRUD
    public function consultar($sql) {
        try {
            if ($sql == null) {
                $sql = 'SELECT * FROM Conta;';
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

    public function incluir($DATACONTA, $CNPJ, $CEP, $LANT, $LATU, $tpResidencia, $Tarifa, $Economias, $V_AGUA, $RECURSO_HIDROM, $TX_ANUAL, $V_ESGOTO, $ValorConta) {
        try {
            $utill = new Util();
            $sql = 'insert into conta(DATACONTA, CNPJ, CEP, LANT, LATU, tpResidencia, Tarifa, Economias, V_AGUA, RECURSO_HIDROM, TX_ANUAL, V_ESGOTO, ValorConta) '
                    . 'values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $DATACONTA);
            $stmt->bindParam(2, $CNPJ);
            $stmt->bindParam(3, $CEP);
            $stmt->bindParam(4, $LANT);
            $stmt->bindParam(5, $LATU);
            $stmt->bindParam(6, $tpResidencia);
            $stmt->bindParam(7, $Tarifa);
            $stmt->bindParam(8, $Economias);
            $stmt->bindParam(9, $V_AGUA);
            $stmt->bindParam(10, $RECURSO_HIDROM);
            $stmt->bindParam(11, $TX_ANUAL);
            $stmt->bindParam(12, $V_ESGOTO);
            $stmt->bindParam(13, $ValorConta);

            $stmt->execute();
        } catch (PDOException $e) {

            echo 'Error: <b>  na tabela conta = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    public function alterara($DATACONTA, $CNPJ, $CEP, $LANT, $LATU, $tpResidencia, $Tarifa, $Economias, $V_AGUA, $RECURSO_HIDROM, $TX_ANUAL, $V_ESGOTO, $ValorConta) {
        try {

            $sql = 'update conta set LANT = ?, LATU = ?, tpResidencia = ?, Tarifa = ?, Economias = ?, V_AGUA = ?, RECURSO_HIDROM = ?, TX_ANUAL = ?, V_ESGOTO = ?, ValorConta = ?'
                    . 'where CNPJ = ? and CEP = ? and DATACONTA = ?';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $LANT);
            $stmt->bindParam(2, $LATU);
            $stmt->bindParam(3, $tpResidencia);
            $stmt->bindParam(4, $Tarifa);
            $stmt->bindParam(5, $Economias);
            $stmt->bindParam(6, $V_AGUA);
            $stmt->bindParam(7, $RECURSO_HIDROM);
            $stmt->bindParam(8, $TX_ANUAL);
            $stmt->bindParam(9, $V_ESGOTO);
            $stmt->bindParam(10, $ValorConta);
            $stmt->bindParam(11, $CNPJ);
            $stmt->bindParam(12, $CEP);
            $stmt->bindParam(13, $DATACONTA);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela conta = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

}
