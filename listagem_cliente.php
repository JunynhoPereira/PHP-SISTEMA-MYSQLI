<?php require_once("conn.php"); ?>

<?php
    // tabela de transportadoras
    $cli = "SELECT * FROM cliente ";
    $consulta_cliente = mysqli_query($conn, $cli);
    if(!$consulta_cliente) {
        die("Erro no Banco");
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cliente</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        
        <style>
            div#janela_transportadoras {
                width:700px;
                margin:60px auto 0;
                border:1px solid #EDEDDC;
                font-family:sans-serif;
                font-size:13px;
                color:#9A9668;
            }
            
            div#janela_transportadoras ul {
                margin:0;padding:0; 
                border-bottom:1px solid #EDEDDC;
            }
            
            div#janela_transportadoras ul:last-child {
                border-bottom:none;
            }
            
            div#janela_transportadoras ul:nth-child(odd) {
                background:#EDEDDC;   
            }
            
            div#janela_transportadoras li {
                list-style:none;
                display:inline-block;
                
            }
            
            div#janela_transportadoras li:nth-child(1) {
                width:380px; 
                padding:8px 4px;
            }

            div#janela_transportadoras li:nth-child(2) {
                width:140px;  
                padding:5px 2px;
            }    
            
            div#janela_transportadoras li:nth-child(3) a {
                color:#9A9668;
                text-align:center;
                padding:0 10px;
            }
            
            div#janela_transportadoras li:nth-child(4) a {
                color:#9A9668;
                text-align:center;
                padding:0 10px;
            }            
        </style>
    </head>

    <body>
        
        <main>  
            <div id="janela_transportadoras">
                <?php
                    while($linha = mysqli_fetch_assoc($consulta_cliente)) {
                ?>
                <ul>
                    <li><?php echo utf8_encode($linha["nomecli"]) ?></li>
                    <li><?php echo utf8_encode($linha["endereco"]) ?></li>
                    <li><?php echo utf8_encode($linha["cidade"]) ?></li>
                    <li><a href="update_cliente.php?codigo=<?php echo $linha["idcli"] ?>">Alterar</a> </li>
                    <li><a href="delete_cliente.php?codigo=<?php echo $linha["idcli"] ?>">Excluir</a> </li>
                </ul>
                <?php
                    }
                ?>
            </div>
        </main>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conn);
?>