<?php

class Pessoa{
    // Atributos
    private $nome;
    private $sobrenome;
    private $idade;

    //Métodos
     public function __toString()
    {
        $html = "<span style='font-weight: bold;'>Nome completo:</span>";
        $html .= $this->nome . " " . $this->sobrenome;
        $html .= "<br>";

        $html .= "<span style='font-weight: bold;'>Idade:</span>";
        $html .= $this->idade;
        return $html;
    }

    // GETs e SETs 
    

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of sobrenome
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * Set the value of sobrenome
     */
    public function setSobrenome($sobrenome): self
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    /**
     * Get the value of idade
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * Set the value of idade
     */
    public function setIdade($idade): self
    {
        $this->idade = $idade;

        return $this;
    }
}