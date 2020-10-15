<?php
/*
$host = "localhost";
$user = "root";
$senha = "";
$banco = "realconsumo";
*/
//*
$host = "mysql104.prv.f1.k8.com.br";
$user = "realconsumo";
$senha = "R&@LC0NSUM0BD_K@TI@";
$banco = "realconsumo";
//*/
try {

    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $banco, $user, $senha);
    echo 'Conectado com Sucesso';
    return $pdo;
} catch (PDOException $e) {

    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}