<?php

class Util {
    function __construct() {
        //if (!isset($_SESSION)) {
        //    session_start();
        //}
    }

    function msgBox($msg) {
        echo '<script>alert("' . $msg . '");</script>';
    }

    public function redirecionamentopage($caminho) {
        echo '<script>window.location="' . $caminho . '";</script>';
    }

    public function redirecionamentopage2($caminho, $var) {
        echo '<script>window.location="' . $caminho . "?ok=" . $var . '";</script>';
    }

    public function redirecionamentopage3($caminho, $var, $var2) {
        echo '<script>window.location="' . $caminho . "?ok=" . $var . "&ok1=" . $var2 . '";</script>';
    }

    function busca_cep($cep) {
        $url = "http://viacep.com.br/ws/$cep/xml/";
        $xml = simplexml_load_file($url);
        return $xml;
    }

    public function maskDataParaSql($dateSql) {
        $ano = substr($dateSql, 6);
        $mes = substr($dateSql, 3, -5);
        $dia = substr($dateSql, 0, -8);
        return $ano . "-" . $mes . "-" . $dia;
    }

    public function RemoveMask($OBJ) {

        // matriz de entrada
        $what = array('ä', '/', '|', '.', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç', ' ', '-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º', '-');

        // matriz de saída
        $by = array('');

        // devolver a string
        return str_replace($what, $by, $OBJ);
    }

    public function PREPARAEXCELPARASQL($OBJ) {
//="DD-MM-AAAA"
        // matriz de entrada
        $what = array('"', '=');

        // matriz de saída
        $by = array('');

        // devolver a string
        $OBJ = str_replace($what, $by, $OBJ);
        $OBJ = $this->MaskDataBrToUsa($OBJ);

        return $OBJ;
    }

    public function MaskDataBrToUsa($dateSql) {
        $ano = substr($dateSql, 6);
        $mes = substr($dateSql, 3, -5);
        $dia = substr($dateSql, 0, -8);
        return $ano . "-" . $mes . "-" . $dia;
    }

    public function VirgulaporPonto($OBJ) {

        // matriz de entrada
        $what = array(',', ';');

        // matriz de saída
        $by = array('.');

        // devolver a string
        return str_replace($what, $by, $OBJ);
    }

    public function PontoporVirgula($OBJ) {

        // matriz de entrada
        $what = array('.', ';');

        // matriz de saída
        $by = array(',');

        // devolver a string
        return str_replace($what, $by, $OBJ);
    }

}
