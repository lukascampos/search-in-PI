<?php 
    session_start(); 

    //inicia a pesquisa no banco
    include_once ("connect.php");
    $pesq = $_POST['search'];

    if (preg_match('/[A-Za-z]/', $pesq)){ //verifica se existe alguma letra na pesquisa
        $_SESSION['letras'] = $pesq; //cria uma SESSION para ser verificada na página de busca
        header ("Location: index.php"); //transfere imediatamente para a página de busca
    }

    else
        $result = "SELECT * FROM digits WHERE pi_numbers LIKE '%$pesq%' LIMIT 1";
        $result_out = mysqli_query ($conn, $result);

        //"gera" os valores pesquisados em uma variável e a deixa em String
        while ($rows_pi = mysqli_fetch_array ($result_out)){
        $num_pi = $rows_pi ['pi_numbers'];

            $_SESSION['numero_pi'] = $num_pi; //conexão com a página de busca
            $_SESSION['pesquisa'] = $pesq;
        }

        if (empty($result_out) === FALSE){ //verifica se a variável é vazia
            $_SESSION['vazio'] = empty($result_out); //cria uma SESSION para ser verificada na página de busca
        }

        header ("Location: index.php"); //transfere imediatamente para a página de busca
?>