<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//Para los ASSERT .. las validaciones
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trademark
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TrademarkRepository")
 */
class Trademark
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true, nullable=false)
     * @Assert\NotBlank(message="Recuerde introducir el nombre de la marca")
     * @Assert\Length(max="100", maxMessage="No más de 100 caracteres")
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="prefix", type="string", length=7, unique=true, nullable=false)
     * @Assert\Regex(
     *      pattern="/^\d{7}$/",
     *      match=true,
     *      message="Recuerda son SIETE dígitos (positivos) ... rellena con ceros si solo tienes cinco."
     * )
     * @Assert\Regex(
     *      pattern="/^0{7}$/",
     *      match=false,
     *      message="Todos los númros NO pueden ser ceros"
     * )
     */
    private $prefix;

    /**
     * @var integer
     *
     * @ORM\Column(name="prefixUPC", type="string", length=6, unique=true, nullable=true)
     * @Assert\Regex(
     *      pattern="/^\d{6}$/",
     *      match=true,
     *      message="Recuerda son SEIS dígitos (positivos) ... rellena con ceros si solo tienes cinco."
     * )
     * @Assert\Regex(
     *      pattern="/^0{6}$/",
     *      match=false,
     *      message="Todos los númros NO pueden ser ceros"
     * )
     */
    private $prefixUPC;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="trademarks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     * @Assert\Valid()
     */
    private $company;

    /**
     * @var Barcode
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Barcode", mappedBy="trademark")
     */
    private $barcodes;

    /**
     * @var Product
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product", mappedBy="trademark")
     */
    private $products;

    /**
     * @var TableLogisticVariables
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product", mappedBy="trademark")
     */
    private $tablelogisticvariabless;

    /**
     * @var integer
     *
     * @ORM\Column(name="counter", type="integer", nullable=false)
     */
    private $counter = 0;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Trademark
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set prefix
     *
     * @param integer $prefix
     * @return Trademark
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return integer
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set prefixUPC
     *
     * @param integer $prefixUPC
     * @return Trademark
     */
    public function setPrefixUPC($prefixUPC)
    {
        $this->prefixUPC = $prefixUPC;

        return $this;
    }

    /**
     * Get prefixUPC
     *
     * @return integer
     */
    public function getPrefixUPC()
    {
        return $this->prefixUPC;
    }

    /**
     * Set company
     *
     * @param Company $company
     * @return Trademark
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * Get company
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set counter
     *
     * @param integer $counter
     * @return Trademark
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * Get counter
     *
     * @return integer
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->barcodes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add barcodes
     *
     * @param \AppBundle\Entity\Barcode $barcodes
     * @return Trademark
     */
    public function addBarcode(\AppBundle\Entity\Barcode $barcodes)
    {
        $this->barcodes[] = $barcodes;

        return $this;
    }

    /**
     * Remove barcodes
     *
     * @param \AppBundle\Entity\Barcode $barcodes
     */
    public function removeBarcode(\AppBundle\Entity\Barcode $barcodes)
    {
        $this->barcodes->removeElement($barcodes);
    }

    /**
     * Get barcodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */

    public function getBarcodes()
    {
        return $this->barcodes;
    }

    /**
     * Constructor
     */
    public function __constructProduct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add products
     *
     * @param \AppBundle\Entity\Product $products
     * @return Trademark
     */
    public function addProduct(\AppBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \AppBundle\Entity\Product $products
     */
    public function removeProduct(\AppBundle\Entity\Product $products)
    {
        $this->barcodes->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */

    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Constructor
     */
    public function __constructTableLogisticVariables()
    {
        $this->tablelogisticvariabless = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tablelogisticvariabless
     *
     * @param \AppBundle\Entity\TableLogisticVariables $tablelogisticvariabless
     * @return Trademark
     */
    public function addTableLogisticVariables(\AppBundle\Entity\TableLogisticVariables $tableLogisticVariables)
    {
        $this->tablelogisticvariabless[] = $tableLogisticVariables;

        return $this;
    }

    /**
     * Remove tablelogisticvariabless
     *
     * @param \AppBundle\Entity\TableLogisticVariables $tablelogisticvariabless
     */
    public function removeTableLogisticVariables(\AppBundle\Entity\TableLogisticVariables $tablelogisticvariabless)
    {
        $this->tablelogisticvariabless->removeElement($tablelogisticvariabless);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */

    public function getTableLogisticVariables()
    {
        return $this->tablelogisticvariabless;
    }

}
