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
    if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){
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
                
                elseif($action == 'DELETAR') {
                    /**
                     * Recebe o ID do registro que deverá ser excluído,
                     * que foi enviado pela url no link da imagem
                     * do excluir que foi acionado na index
                     */
                    $idContato = $_GET['id'];

                    // Chama a função de exluir na Controller
                    $resposta = excluirContato($idContato);

                    // Valida o tipo de daos que a controller retornou
                    if(is_bool($resposta)){
                        // Verificando se p retorno foi verdadeiro
                        if($resposta)
                        echo "<script>
                                alert('Registro Excluido com Sucesso!')
                                window.location.href = 'index.php'
                             </script>";
                      
                    // Se o retorno for um array significa houve erro no processo de inserção 
                    } elseif(is_array($resposta)){
                        echo "<script>
                                alert('".$resposta['message']."')
                                window.history.back()
                            </script>";
                    }
                }

                elseif($action == 'BUSCAR') {
                    /**
                     * Recebe o ID do registro que deverá ser editado,
                     * que foi enviado pela url no link da imagem
                     * do editar que foi acionado na index
                     */
                    $idContato = $_GET['id'];

                    // Chama a função de buscar na Controller
                    $dados = buscarContato($idContato);

                    // Ativa a utilização de variáveis de SESSÃO no SERVIDOR
                    session_start();

                    // Guarda em uma varíavel de sessão os dados que o BD retornou para a busca do ID
                    // Obs.: essa variável de sessão será utilizada na index.php, para colocar os DADOS
                    // nas caixas de texto
                    $_SESSION['dadosContato'] = $dados;

                    /**
                     * Utilizando o header, o navegador abre um nova instância da 
                     * página indicada
                     * 
                     * Utilizando o header, também poderemos chamar a index.php, porém
                     * haverá uma ação de carregamento no navegador (piscando a tela)
                     * header('location: index.php')
                     */


                    // Importa o arquivo de index.php, renderizando-o na tela
                    /**
                     * Utilizando o require, iremos apenas importar a tela da index, assim, não 
                     * havendo um novo carregamento da página
                     */
                    require_once('index.php');
                }

                break;

            default:                
                break;
        }
    }
