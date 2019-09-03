<?php require_once("conn.php"); ?>

<?php 
    
    // Inserção ao banco de dados
    if (isset($_POST["nomecli"])){
        $nomecli       = utf8_decode($_POST["nomecli"]);
        $endereco   = utf8_decode($_POST["endereco"]);
        $cidade     = utf8_decode($_POST["cidade"]);
        $estado     = $_POST["estadoid"];

        $inserir = "INSERT INTO cliente ";
        $inserir .= " (nomecli, endereco, cidade, estadoid) ";
        $inserir .= "VALUES ";
        $inserir .= "('$nomecli', '$endereco', '$cidade', $estado)" ;

        $operacao_inserir = mysqli_query($conn, $inserir);
        if (!$operacao_inserir){
            die("Erro no Insert");
        } else {
            header("location:listagem_cliente.php");
        }

    }


    // Seleção de dados
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

                <form action="inserir_cliente.php" method="post">

                    <input type="text" name="nomecli" placeholder="Nome do Cliente">
                    <input type="text" name="endereco" placeholder="Endereço">
                    <input type="text" name="cidade" placeholder="Cidade">
                    <select name="estadoid">
                        <?php
                            while($linha = mysqli_fetch_assoc($lista_estados)){
                        ?>
                        <option value="<?php echo $linha['idestado']; ?>"> 
                            <?php echo utf8_encode($linha["nomeestado"]); ?>
                        </option>
                        <?php 
                            }
                        ?>
                    </select>
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