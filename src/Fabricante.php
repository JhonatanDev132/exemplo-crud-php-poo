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





    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): self {
        $this->nome = $nome;
        return $this;
    }
}