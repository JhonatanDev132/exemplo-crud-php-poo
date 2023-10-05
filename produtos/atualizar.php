<?php
use ExemploCrudPoo\{Produto, Fabricante};
require_once "../vendor/autoload.php";
$produto = new Produto();
$produto->setId($_GET['id']);

$fabricante = new Fabricante();
$listaDeFabricantes = $fabricante->lerFabricantes();
$dadosProduto = $produto->lerUmProduto();

if(isset($_POST['atualizar'])){
    $produto->setNome($_POST['nome']);
    $produto->setPreco($_POST['preco']);
    $produto->setQuantidade($_POST['quantidade']);
    $produto->setDescricao($_POST['descricao']);
    $produto->setFabricanteId($_POST['fabricante']);
    $produto->atualizarProduto();

    header("location:visualizar.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Atualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Produtos | SELECT/UPDATE</h1>
        <hr>
        <form action="" method="post">
            <p>
                <label for="nome">Nome:</label>
                <input value="<?=$dadosProduto['nome']?>" type="text" name="nome" id="nome" required>
            </p>
            <p>
                <label for="preco">Preço:</label>
                <input value="<?=$dadosProduto['preco']?>"
                type="number" min="10" max="10000" step="0.01"
                 name="preco" id="preco" required>
            </p>
            <p>
                <label for="quantidade">Quantidade:</label>
                <input value="<?=$dadosProduto['quantidade']?>"
                type="number" min="1" max="100"
                 name="quantidade" id="quantidade" required>
            </p>
            <p>
                <label for="fabricante">Fabricante:</label>
                <select name="fabricante" id="fabricante" required>
                    <option value=""></option>
        
                    <?php foreach( $listaDeFabricantes as $fabricante ) { ?>
                        <option <?php if($dadosProduto["fabricante_id"] === $fabricante["id"]) echo " selected "; ?>
                        value="<?=$fabricante['id']?>">
                            <?=$fabricante['nome']?>
                        </option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label for="descricao">Descrição:</label> <br>
                <textarea name="descricao" id="descricao" cols="30" rows="3"><?=$dadosProduto['descricao']?></textarea>
            </p>
            <button type="submit" name="atualizar">Atualizar produto</button>
        </form>
        <hr>
        <p><a href="visualizar.php">Voltar</a></p>
    </div>
    
</body>
</html>