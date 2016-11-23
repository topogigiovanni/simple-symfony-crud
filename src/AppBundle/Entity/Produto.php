<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table(name="produto")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ProdutoRepository")
 */
class Produto
{
    /**
     *
     * @ORM\Column(name="id_produto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idProduto;


     /**
     *
     * @ORM\ManyToOne(targetEntity="CategoriaProduto")
     * @ORM\JoinColumn(name="id_categoria_produto", referencedColumnName="id_categoria_planejamento")
     */
    private $categoria;

     /**
     *
     * @ORM\Column(name="data_cadastro", type="datetime")
     */
    protected $dataCadastro;

    /**
     *
     * @ORM\Column(name="nome_produto", type="string", length=150, nullable=false)
     */
    protected $nomeProduto;

    /**
     *
     * @ORM\Column(name="valor_produto", type="decimal", precision=10, scale=2)
     */
    protected $valorProduto;

    /**
     *
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->dataCadastro = new \DateTime();
    }


    // outros getters e setters

    /**
     * @var \AppBundle\Entity\CategoriaProduto
     */
    private $idCategoriaProduto;


    /**
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     *
     * @return Produto
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set nomeProduto
     *
     * @param string $nomeProduto
     *
     * @return Produto
     */
    public function setNomeProduto($nomeProduto)
    {
        $this->nomeProduto = $nomeProduto;

        return $this;
    }

    /**
     * Get nomeProduto
     *
     * @return string
     */
    public function getNomeProduto()
    {
        return $this->nomeProduto;
    }

    /**
     * Set valorProduto
     *
     * @param string $valorProduto
     *
     * @return Produto
     */
    public function setValorProduto($valorProduto)
    {
        $this->valorProduto = $valorProduto;

        return $this;
    }

    /**
     * Get valorProduto
     *
     * @return string
     */
    public function getValorProduto()
    {
        return $this->valorProduto;
    }

    /**
     * Get idProduto
     *
     * @return integer
     */
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * Set idCategoriaProduto
     *
     * @param \AppBundle\Entity\CategoriaProduto $idCategoriaProduto
     *
     * @return Produto
     */
    public function setIdCategoriaProduto(\AppBundle\Entity\CategoriaProduto $idCategoriaProduto = null)
    {
        $this->idCategoriaProduto = $idCategoriaProduto;

        return $this;
    }

    /**
     * Get idCategoriaProduto
     *
     * @return \AppBundle\Entity\CategoriaProduto
     */
    public function getIdCategoriaProduto()
    {
        return $this->idCategoriaProduto;
    }
}
