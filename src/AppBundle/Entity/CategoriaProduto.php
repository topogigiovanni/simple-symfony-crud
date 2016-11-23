<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaProduto
 * @ORM\Entity()
 * @ORM\Table(name="categoria_produto")
 */
class CategoriaProduto
{
    /**
     *
     * @ORM\Column(name="id_categoria_planejamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idCategoriaPlanejamento;

    /**
     *
     * @ORM\Column(name="nome_categoria", type="string", length=150, nullable=false)
     */
    protected $nomeCategoria;


    // outros getters e setters


    /**
     * Set nomeCategoria
     *
     * @param string $nomeCategoria
     *
     * @return CategoriaProduto
     */
    public function setNomeCategoria($nomeCategoria)
    {
        $this->nomeCategoria = $nomeCategoria;

        return $this;
    }

    /**
     * Get nomeCategoria
     *
     * @return string
     */
    public function getNomeCategoria()
    {
        return $this->nomeCategoria;
    }

    /**
     * Get idCategoriaPlanejamento
     *
     * @return integer
     */
    public function getIdCategoriaPlanejamento()
    {
        return $this->idCategoriaPlanejamento;
    }
}
