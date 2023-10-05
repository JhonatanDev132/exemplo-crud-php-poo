<?php
namespace ExemploCrudPoo;
use Exception, PDO;

final class Produto{
    private int $id;
    private string $nome;
    private float $preco;
    private int $quantidade;
    private string $descricao;
    private string $fabricante_id;
    private PDO $conexao;


    public function __construct() {
        $this->conexao = Banco::conecta();
    }
    
    public function lerProdutos():array {
    $sql = "SELECT 
                produtos.id,
                produtos.nome AS produto,
                produtos.preco,
                produtos.quantidade,
                fabricantes.nome AS fabricante,
                (produtos.preco * produtos.quantidade) AS total
            FROM produtos INNER JOIN fabricantes
            ON produtos.fabricante_id = fabricantes.id
            ORDER BY produto";

    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar produtos: ".$erro->getMessage());
    }
    
    return $resultado;
}

function inserirProduto():void {

    $sql = "INSERT INTO produtos(
        nome, preco, quantidade, descricao, fabricante_id
    ) VALUES(
        :nome, :preco, :quantidade, :descricao, :fabricanteId
    )";    

    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
        $consulta->bindValue(":preco", $this->preco, PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $this->quantidade, PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
        $consulta->bindValue(":fabricanteId", $this->fabricante_id, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao inserir: ".$erro->getMessage());
    }
}

function lerUmProduto():array {
    $sql = "SELECT * FROM produtos WHERE id = :id";
    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar dados: ".$erro->getMessage());
    }    
    return $resultado;
}

function atualizarProduto():void {

    $sql = "UPDATE produtos SET
        nome = :nome,
        preco = :preco,
        quantidade = :quantidade,
        descricao = :descricao,
        fabricante_id = :fabricanteId WHERE id = :id";
    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
        $consulta->bindValue(":preco", $this->preco, PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $this->quantidade, PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
        $consulta->bindValue(":fabricanteId", $this->fabricante_id, PDO::PARAM_INT);
        $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao atualizar: ".$erro->getMessage());
    }   
}


function excluirProduto():void {
    $sql = "DELETE FROM produtos WHERE id = :id";
    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao excluir: ".$erro->getMessage());
    }
}


public function getNome(): string {
    return $this->nome;
}

public function setNome(string $nome): self {
    $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
    return $this;
}

public function getPreco(): int {
    return $this->preco;
}

public function setPreco(string $preco): self {
    $this->preco = filter_var($preco, FILTER_SANITIZE_NUMBER_INT);
    return $this;
}
public function getQuantidade(): int {
    return $this->quantidade;
}

public function setQuantidade(int $quantidade): self {
    $this->quantidade = filter_var($quantidade, FILTER_SANITIZE_NUMBER_INT);
    return $this;
}

public function getDescricao(): string {
    return $this->descricao;
}

public function setDescricao(string $descricao): self {
    $this->descricao = filter_var($descricao, FILTER_SANITIZE_SPECIAL_CHARS);
    return $this;
}

public function getFabricanteId(): string {
    return $this->fabricante_id;
}

public function setFabricanteId(int $fabricante_id): self {
    $this->fabricante_id = filter_var($fabricante_id, FILTER_SANITIZE_NUMBER_INT);
    return $this;
}

public function getId(): int {
    return $this->id;
}

public function setId(int $id): self {
    $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    return $this;
}
}