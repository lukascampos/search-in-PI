<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search in Pi</title>
    <link rel="stylesheet" href="search_style.css">

    <!--adicionando o bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

    <!--CONTEÚDO-->
    <h3 class="main-title" id="titulo"><strong>Search here</strong></h3>
    <div class= "relative meio position-absolute top-50 start-50 translate-middle" id="main_form">
        <div class="container" id="conteudo">
            <div class="col-md-12" id="dnv">
                <form id="input" method="post" action="result_.php">
                    <input name="search" type="text" class="form-control" id="form" required>
                    <input type="submit" id="send-btn" value="Verify">
                </form>

                <input type="submit" id="verify-btn" data-bs-toggle="modal" data-bs-target="#mymodal" data-bs-toggle="modal">

            </div>
            <div>
                <p id="txt1"><strong>Here you can carry out your research in Pi!</strong></p>
                <p id="txt2"><strong>Take a test: type "123456" in the field above and click "verify".</strong></p>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body" id="modal-body">
                    <?php
                        if (isset($_SESSION['numero_pi'])){ //verifica se a SESSION existe

                            echo "<script>
                            window.onload = function(){
                                document.getElementById('verify-btn').click();
                            }</script>";

                            $numero_pi = $_SESSION['numero_pi']; //aloca o valor da SESSION com o número pi em uma variável
                            $pesquisa = $_SESSION['pesquisa']; //aloca o valor da SESSION com a pesquisa em uma variável
                            $local = strpos($numero_pi, $pesquisa); //identifica em qual casa está o valor da pesquisa

                            if($local <= 80){ //condição de exibição de pesquisas com a casa menor ou igual a 40
                                $num_fim = 81 + strlen($pesquisa); //quantidade de caracteres que serão exibidos                             
                                $pai1 = substr($numero_pi, 0, $num_fim);
                                echo (str_replace($pesquisa, " <strong style='font-size: 18px';>$pesquisa</strong> ", $pai1));
                
                            }else if ($local > 80){ //condição de exibição de pesquisas com a casa maior que 40
                                $num_inicio = $local -74; //local inicial da exibição
                                $num_fim1 = 148 + strlen($pesquisa); //quantidade de caracteres que serão exibidos
                                $pai =  substr ($numero_pi, $num_inicio, $num_fim1);

                                echo (str_replace($pesquisa," <strong style='font-size: 18px';>$pesquisa</strong> ", $pai));
                            }

                        }else if (isset ($_SESSION['letras'])){
                            echo "<script>
                            window.onload = function(){
                                document.getElementById('verify-btn').click();
                            }</script>";

                            echo "Please perform your search with numbers only.";

                        }else if (isset ($_SESSION['vazio'])){
                            echo "<script>
                            window.onload = function(){
                                document.getElementById('verify-btn').click();
                            }</script>";
    
                            echo "Unfortunately your research is not present in our database.";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?php session_destroy(); ?>
</html>