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
                //  Import da controller Contatos
                require_once('./controllers/controllerContatos.php');

                // Validação para identificar o tipo de ação que será realizada
                if($action == 'INSERIR'){

                    // Chama a função de inserir na controller
                    $resposta = inserirContato($_POST);
                    // Valida o tipo de daos que a controller retornou
                    if(is_bool($resposta)){
                        // Verificando se p retorno foi verdadeiro
                        if($resposta)
                        echo "<script>
                                alert('Registro Inserido com Sucesso!')
                                window.location.href = 'index.php'
                             </script>";
                      
                    // Se o retorno for um array significa houve erro no processo de inserção 
                    } elseif(is_array($resposta)){
                        echo "<script>
                                alert('".$resposta['message']."')
                                window.history.back()
                            </script>";
                    }
                } // window.location.href = arquivo
                  // window.history.back()
                break;
                                
            default:                
                break;
        }
    }
