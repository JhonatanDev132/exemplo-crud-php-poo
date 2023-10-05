<?php
    use ExemploCrudPoo\Fabricante;
    require_once "../vendor/autoload.php";

if( isset($_POST['inserir']) ){
    $fabricante = new Fabricante;
    $fabricante->setNome($_POST['nome']);
    $fabricante->inserirFabricante($conexao, $nome);
    header("location:visualizar.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabricantes - Inserção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Fabricantes | INSERT</h1>
        <hr>
        <form action="" method="post">
            <p>
                <label for="nome">Nome:</label>
                <input required type="text" name="nome" id="nome">
            </p>
            <button type="submit" name="inserir">Inserir fabricante</button>
        </form>
        <hr>
        <p><a href="visualizar.php">Voltar</a></p>
    </div>
</body>
</html>