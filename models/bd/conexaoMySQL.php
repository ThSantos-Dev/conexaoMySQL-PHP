<?php
/*******************************************************************************************
 * Objetivo: Arquivo para criar a conexão com o banco de dados MySQL
 * Autor: Thales Santos
 * Data: 25/02/2022
 * Versão: 1.0
 ******************************************************************************************/


 /**
 * Informações que precisamos para conectar com o banco de dados
 *  1º Local do banco
 *  2º Usuario 
 *  3º Senha
 *  4º Database
*/

//  Constantes para estabelecer a conexão com o BD:
 const SERVER = 'localhost';
 const USER = 'root';
 const PASSWORD = 'bcd127';
 const DATABASE = 'db_contatos';

//  $resultado = conexaoMySQL();
//  echo '<pre>';
//     print_r($resultado);
//  echo '</pre>';

 // Abre a conexão com o banco de dados MySQL
 function conexaoMySQL(){
    $conexao = array();

    // Se a conexão for estabelicida, teremos um array de dados sobre a conexão
    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    // Validação para verificar se a conexão foi realizada com sucesso
    if($conexao)
        return $conexao;
    else
        return false;

 }


/**
 * Existem 3 formas de se conectar com o banco de dados MySQL
 *  mysql_connect() - versão antiga do PHP de fazer a conexão com o BD (não oferece performance e segurança)
 * 
 *  mysqli_connect() - versão mais atualizada do PHP de fazer a conexão com o banco de dados (ela permite ser utilizada para programação estruturada e POO)
 * 
 *  PDO() - versão mais completa e eficiênte para conexão com o banco de dados (é indicada pela segurança e POO)
 */




?>