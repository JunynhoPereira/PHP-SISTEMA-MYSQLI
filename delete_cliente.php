<?php require_once("conn.php"); ?>

<?php 

    if (isset($_POST["nomecli"])) {
        $idcli = $_POST["idcli"];

        $exclusao = "DELETE FROM cliente ";
        $exclusao .= "WHERE idcli = {$idcli} ";

        $con_exclusao = mysqli_query($conn, $exclusao);
        if(!$con_exclusao) {
            die("Registro não Excluido");
        } else {
            header("location:listagem_cliente.php");
        }

    }

    // Consultar a tabela Transportadora
    
    $cli = "SELECT * FROM cliente ";
    if (isset($_GET["codigo"])){
        $id = $_GET["codigo"];
    $cli .= "WHERE idcli = {$id} ";
    }

    $con_cliente = mysqli_query($conn, $cli);
    if (!$con_cliente){
        die("Erro na Consulta");
    }

    $info_cliente = mysqli_fetch_assoc($con_cliente);

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Drop Cliente</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/alteracao.css" rel="stylesheet">
    </head>

    <body>
        
        <main>  

            <div id="janela_formulario">
                <form action="delete_cliente.php" method="post">
                    
                    <h2>Exclusão de Cliente</h2>

                <label for="nomecli">Nome do Cliente </label>
                <input type="text" value="<?php echo utf8_encode($info_cliente["nomecli"]) ?>" name="nomecli" id="nomecli">

                <label for="endereco">Endereço </label>
                <input type="text" value="<?php echo utf8_encode($info_cliente["endereco"]) ?>" name="endereco" id="endereco">

                <label for="cidade">Cidade </label>
                <input type="text" value="<?php echo utf8_encode($info_cliente["cidade"]) ?>" name="cidade" id="cidade">

                <input type="hidden" name="idcli" value="<?php echo $info_cliente["idcli"] ?>">

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