<?php
/**************************************************************************************
 * Objetivo: Arquivo de rota, para segmentar as ações encaminhadas pela View 
 *              (dados de um form, listagem de dados, ação de excluir ou atualizar)
 *              Esse arquivo será responsável por encaminhar as solicitações para a 
 *              Controller
 * Autor: Thales Santos
 * Data: 04/03/2022
 * Versão: 1.0
 *************************************************************************************/

 $action = (string) null;
 $component = (string) null;
 

//  Validação para verificar se a requisição é um POST de um formulário
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Resgatando dados para as variáveis de ambiente - via URL
        // Para saber quem esta solicitando e qual ação será executada
        $action = strtoupper($_GET['action']);
        $component = strtoupper($_GET['component']);

        # Estrutura condicional para validar quem esta solicitando algo para o Router
        switch ($component) {
            // Resgatando os valores que o usuário digitou de acordo com o COMPONENT que solicitou
            case 'CONTATOS':
                echo('Chamando a controller de CONTATOS');
                break;
                                
            default:
                
                break;
        }
    }


















?>