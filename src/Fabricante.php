<?php
namespace ExemploCrudPoo;
use Exception, PDO;

final class Fabricante {

    private int $id;
    private string $nome;
    
    /* Esta propriedade receberá os recursos
    PDO através da classe Banco (dependência deste projeto) */
    private PDO $conexao;

    public function __construct() {
        /* No momento em que um objeto Fabricante for
        criado, automaticamente será feita a chamada
        do método "conecta" existente na classe Banco. */
        $this->conexao = Banco::conecta();
    }

    public function lerFabricantes():array {
        $sql = "SELECT * FROM fabricantes ORDER BY nome";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }    
    
        return $resultado;
    } 


    public function inserirFabricante():void {
        $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir: ".$erro->getMessage());
        }
    
    }


    public function lerUmFabricante():array {
        $sql = "SELECT * FROM fabricantes WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar: ".$erro->getMessage());
        }
    
        return $resultado;
    } 

    public function atualizarFabricante():void {
        $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao atualizar: ".$erro->getMessage());
        }
    } 

    public function excluirFabricante():void {
        $sql = "DELETE FROM fabricantes WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao excluir: ".$erro->getMessage());
        }
    } 


    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): self {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }
}