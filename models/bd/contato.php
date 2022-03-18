<?php
/**********************************************************************************
 * Objetivo: Arquivo responsável por manipular os dados dentro do BD 
 *                                               (Insert, Update, Select e Delete)
 * Autor: Thales Santos
 * Data: 11/03/2022
 * Versão: 1.0
 **********************************************************************************/

// Import do Arquivo que estabelece a conexão com o BD
require_once('conexaoMySQL.php');


// CRUD = CREATE, READ, UPDATE AND DELETE 


// Função para realizar o INSERT no BD
function insertContato($dadosContato) {
    // Abre a conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para inserir os dados no BD
    $sql = "
        insert into tbl_contatos (
            nome,
            telefone,
            celular,
            email,
            obs
        ) 
        values (
            '".$dadosContato['nome']."',
            '".$dadosContato['telefone']."',
            '".$dadosContato['celular']."',
            '".$dadosContato['email']."',
            '".$dadosContato['obs']."'
        );";

    // echo '</br></br></br>Script SQL:</br>';

    // echo '<pre>';
    //     printf($sql);
    // echo '</pre>';

    // echo '</br>dados inseridos com sucesso!';
    
    
    // Executa Script no BD
    // msyqli_query(dados de conexao, script sql)
        // Validação para verificar se o script SQL está correto
    if(mysqli_query($conexao, $sql)) {
        // Validação para verificar se uma linha foi acrescentada no BD
        if(mysqli_affected_rows($conexao))
            return true;
        else 
            return false;
    }
    else 
        return false;
}
 
// Função para realizar o UPDATE no BD
function updateContato() {

}

// Função para realizar o EXCLUIR no BD
function deleteContato() {

}

// Função para realizar o LISTAR TODOS OS CANTATOS do BD
function selectAllContatos() {
    // Abre a conexão com o BD
    $conexao = conexaoMySQL();

    // script para listar todos os dados do BD
    $sql = "select * from tbl_contatos;";
    $result = mysqli_query($conexao, $sql);

    // Valida se o BD retornou registros
    if($result){
        // dentro do while o $rsDados recebe os dados do banco, converte e ainda conta quantos dados tem
        // assim que chega no ultimo elemento do array, automaticamente o loop cessa

        /**
         * mysqli_fetch_assoc() - permite converter os dados do BD em um array para 
         *                          manipulação no PHP 
         * Nesta repetição estamos, convertendo os dados do BD em um array ($rsDados),
         * além de o próprio while conseguir gerenciar a quantidade vezes que deverá ser feita
         * a repetição
         * 
         * vai gerenciar a quantidade de itens no array
         */
        $cont = 0;
        while($rsDados = mysqli_fetch_assoc($result)){
            // Cria um array com dados do BD
            $arrayDados[$cont] = array(
                "nome"      => $rsDados['nome'],
                "telefone"  => $rsDados['telefone'],
                "celular"   => $rsDados['celular'],
                "email"     => $rsDados['email'],
                "obs"       => $rsDados['obs']
            );
            $cont++;
        }

        return $arrayDados;
    }

}

selectAllContatos();
// LEMBRAR O MARCEL DE FECHAR AS CONEXÕES

/**
 * Quando usamos os scripts update, delete e insert não há devolução de dados pelo banco
 * 
 * Agora no select, há dados a serem buscados e devolvidos por ele
 * 
 *  Precisamos converter esses dados para um formato que o php consiga manusear
 * 
 * mysqli_fetch_assoc($result) - converte o $result em um array de dados, que o php consegue armazenar
 *  
 */

?>