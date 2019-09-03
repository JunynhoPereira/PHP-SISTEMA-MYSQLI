<?php require_once("conn.php"); ?>

<?php 

    if (isset($_POST["nomeestado"])) {
        $idestado = $_POST["idestado"];

        $exclusao = "DELETE FROM estado ";
        $exclusao .= "WHERE idestado = {$idestado} ";

        $con_exclusao = mysqli_query($conn, $exclusao);
        if(!$con_exclusao) {
            die("Registro não Excluido");
        } else {
            header("location:listagem_estado.php");
        }

    }

    // Consultar a tabela Transportadora
    
    $est = "SELECT * FROM estado ";
    if (isset($_GET["codigo"])){
        $id = $_GET["codigo"];
    $est .= "WHERE idestado = {$id} ";
    }

    $con_estado = mysqli_query($conn, $est);
    if (!$con_estado){
        die("Erro na Consulta");
    }

    $info_estado = mysqli_fetch_assoc($con_estado);

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estado</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/alteracao.css" rel="stylesheet">
    </head>

    <body>
        
        <main>  

            <div id="janela_formulario">
                <form action="delete_estado.php" method="post">
                    
                    <h2>Exclusão de Estado</h2>

                <label for="nomeestado">Nome do Estado </label>
                <input type="text" value="<?php echo utf8_encode($info_estado["nomeestado"]) ?>" name="nomeestado" id="nomeestado">

                <input type="hidden" name="idestado" value="<?php echo $info_estado["idestado"] ?>">

                <input type="submit" value="Confirmar Exclusão">

                </form>
                
            </div>

        </main>

    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conn);
?>