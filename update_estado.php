<?php require_once("conn.php"); ?>

<?php 

    if(isset($_POST["idestado"])){
        $nomeestado       = utf8_decode($_POST["nomeestado"]);
        $idestado         =             $_POST["idestado"];

        // Atualizar Transportadora

        $alterar = "UPDATE estado ";
        $alterar .= "SET ";
        $alterar .= "nomeestado =   '{$nomeestado}' ";
        $alterar .= "WHERE idestado = {$idestado} ";
        $operacao_alterar = mysqli_query($conn, $alterar);
        if(!$operacao_alterar) {
            die("Erro na alteração"); 
        } else {
            header("location:listagem_estado.php");   
        }
        
    }

    // Consulta a tabela de Transporte
    $est = "SELECT * ";
    $est .= "FROM estado ";
    if (isset($_GET["codigo"])){
        $id = $_GET["codigo"];
    $est .= "WHERE idestado = {$id} ";
    } else {
        $est .= "WHERE idestado = 1 ";
    }

    $con_estado = mysqli_query($conn, $est);
    if (!$con_estado) {
        die("Erro na Consulta");
    }

    $info_estado = mysqli_fetch_assoc($con_estado);

    // Consulta aos estados
    $estados = "SELECT * ";
    $estados .= "FROM estado ";
    $lista_estados = mysqli_query($conn, $estados);
    if(!$lista_estados){
        die("Erro no Banco");
    }

?>


<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Atu. Estado</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/alteracao.css" rel="stylesheet">
    </head>

    <body>
        
        <main>  

            <div id="janela_formulario">
                <form action="update_estado.php" method="post">
                    
                    <h2>Alteração de Estado</h2>

                <label for="nomeestado">Nome do Estado </label>
                <input type="text" value="<?php echo utf8_encode($info_estado["nomeestado"]) ?>" name="nomeestado" id="nomeestado">

                <input type="hidden" name="idestado" value="<?php echo $info_estado["idestado"] ?>">

                <input type="submit" value="Confirmar Alteração">

                </form>
                
            </div>
            
        </main>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conn);
?>