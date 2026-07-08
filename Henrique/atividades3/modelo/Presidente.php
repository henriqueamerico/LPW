<?php

class Presidente{
// Atributos
    private int $numero;
    private $nome;
    private int $inicio;
    private int $fim;


// GETs e SETs
    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getInicio(): int
    {
        return $this->inicio;
    }

    public function setInicio(int $inicio): self
    {
        $this->inicio = $inicio;

        return $this;
    }

    public function getFim(): int
    {
        return $this->fim;
    }

    public function setFim(int $fim): self
    {
        $this->fim = $fim;

        return $this;
    }
}


