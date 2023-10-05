<?php
use ExemploCrudPoo\Fabricante;
require_once "../vendor/autoload.php";

$fabricante = new Fabricante;

$listaDeFabricantes = $fabricante->lerFabricantes();
$quantidade = count($listaDeFabricantes);
?>
<pre><?=var_dump($fabricante)?></pre>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabricantes - Visualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Fabricantes | SELECT -
            <a href="../index.php">Home</a>
        </h1>
        <hr>
        <h2>Lendo e carregando todos os fabricantes.</h2>
        <p><a href="inserir.php">
            Inserir novo fabricante</a></p>
        <?php if(isset($_GET["status"]) && $_GET["status"] === "sucesso"){ ?>
            <h2 style="color:blue">Fabricante atualizado com sucesso!</h2>
        <?php } ?>
        <table>
            <caption>Fabricantes: <b><?=$quantidade?></b></caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Operações</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach($listaDeFabricantes as $fabricante) { ?>
                <tr>
                    <td> <?=$fabricante["id"]?>  </td>
                    <td> <?=$fabricante["nome"]?> </td>
                    <td>
                        <a href="atualizar.php?id=<?=$fabricante["id"]?>">Editar</a>
                        <a class="excluir" href="excluir.php?id=<?=$fabricante["id"]?>">Excluir</a>
                    </td>
                </tr>
        <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="../js/confirma-exclusao.js"></script>

</body>
</html>