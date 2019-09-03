<?php require_once("conn.php"); ?>

<?php 
    
    // Inserção ao banco de dados
    if (isset($_POST["nomeestado"])){
        $nomeestado = utf8_decode($_POST["nomeestado"]);
        
        $inserir = "INSERT INTO estado ";
        $inserir .= " (nomeestado) ";
        $inserir .= "VALUES ";
        $inserir .= "('$nomeestado') " ;

        $operacao_inserir = mysqli_query($conn, $inserir);
        if (!$operacao_inserir){
            die("Erro no Insert");
        } else {
            header("location:listagem_estado.php");
        }

    }

    // Seleção de dadso
    $select = "SELECT idestado, nomeestado ";
    $select .= "FROM estado ";
    $lista_estados = mysqli_query($conn, $select);
    if (!$lista_estados) {
        die("Erro na Consulta");
    }

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Insert</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/crud.css" rel="stylesheet">
    </head>

    <body>
        <main>  

            <div id="janela_formulario">

                <form action="inserir_estado.php" method="post">

                    <input type="text" name="nomeestado" placeholder="Nome do Estado">

                    <input type="submit" name="inserir">
                    
                </form>
                
            </div>
            
        </main>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conn);
?>