<?php require_once("conn.php"); ?>

<?php 

    if(isset($_POST["idcli"])){
        $nomecli       = utf8_decode($_POST["nomecli"]);
        $endereco      = utf8_decode($_POST["endereco"]);
        $cidade        = utf8_decode($_POST["cidade"]);
        $estado        =             $_POST["estadoid"];
        $idcli         =             $_POST["idcli"];

        // Atualizar Transportadora

        $alterar = "UPDATE cliente ";
        $alterar .= "SET ";
        $alterar .= "nomecli  =   '{$nomecli}', ";
        $alterar .= "endereco =   '{$endereco}', ";
        $alterar .= "cidade   =   '{$cidade}', ";
        $alterar .= "estadoid =   '{$estado}' ";
        $alterar .= "WHERE idcli = {$idcli} ";
        $operacao_alterar = mysqli_query($conn, $alterar);
        if(!$operacao_alterar) {
            die("Erro na alteração");
        } else {
            header("location:listagem_cliente.php");   
        }
        
    }

    // Consulta a tabela de Transporte
    $cli = "SELECT * ";
    $cli .= "FROM cliente ";
    if (isset($_GET["codigo"])){
        $id = $_GET["codigo"];
    $cli .= "WHERE idcli = {$id} ";
    } else {
        $cli .= "WHERE idcli = 1 ";
    }

    $con_cliente = mysqli_query($conn, $cli);
    if (!$con_cliente) {
        die("Erro na Consulta");
    }

    $info_cliente = mysqli_fetch_assoc($con_cliente);

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
        <title>Atu. Cliente</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/alteracao.css" rel="stylesheet">
    </head>

    <body>
        
        <main>  

            <div id="janela_formulario">
                <form action="update_cliente.php" method="post">
                    
                    <h2>Alteração de Clientes</h2>

                <label for="nomecli">Nome do Cliente </label>
                <input type="text" value="<?php echo utf8_encode($info_cliente["nomecli"]) ?>" name="nomecli" id="nomecli">

                <label for="endereco">Endereço </label>
                <input type="text" value="<?php echo utf8_encode($info_cliente["endereco"]) ?>" name="endereco" id="endereco">

                <label for="cidade">Cidade </label>
                <input type="text" value="<?php echo utf8_encode($info_cliente["cidade"]) ?>" name="cidade" id="cidade">

                <label for="estadoid">Estado</label>
                    <select id="estadoid" name="estadoid"> 
                        <?php 
                            $meuestado = $info_cliente["estadoid"];
                            while($linha = mysqli_fetch_assoc($lista_estados)) {
                                $estado_principal = $linha["idestado"];
                                if($meuestado == $estado_principal) {
                ?>
                    <option value="<?php echo $linha["idestado"] ?>" selected>
                        <?php echo utf8_encode($linha["nomeestado"]) ?>
                    </option>

                <?php
                                } else {
                ?>

                    <option value="<?php echo $linha["idestado"] ?>" >
                
                <?php echo utf8_encode($linha["nomeestado"]) ?>
                    </option>                        
                
                <?php 
                        }
                    }
                ?>
                    </select>



                <input type="text" name="idcli" value="<?php echo $info_cliente["idcli"] ?>">

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