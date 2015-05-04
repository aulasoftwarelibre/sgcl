<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//Para los ASSERT .. las validaciones
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
//Para asignar 'datatime'
use Gedmo\Mapping\Annotation as Gedmo;
// Para utilizar búsquedas ... entitymanager ...
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="code", type="string", length=16, unique=true, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=40, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, unique=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="changeHistory", type="text")
     */
    private $changeHistory;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberConsumerUnit", type="integer", nullable=false)
     * @Assert\Range(
     *  min=1,
     *  max=1000,
     *  minMessage="Recuerda que como mínimo tiene que contener una Unidad de Consumo.",
     *  maxMessage="Recuerda que NO puede ser mayor de 9"
     * )
     */
    private $numberConsumerUnit;

    /**
     * @var Barcode
     *
     * @ORM\ManyToOne(targetEntity="Barcode")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="barcode_id_CU", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     * })
     * @Assert\Valid()
     */
    private $barcodeCU;

    /**
     * @var Barcode
     *
     * @ORM\ManyToOne(targetEntity="Barcode")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="barcode_id_SU", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     * @Assert\Valid()
     */
    private $barcodeSU;

    /**
     * @var Trademark
     *
     * @ORM\ManyToOne(targetEntity="Trademark", inversedBy="products")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="trademark_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     * @Assert\Valid()
     */
    private $trademark;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="lastModificationDate", type="datetime")
     */
    private $lastModificationDate;


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
     * Set code
     *
     * @param string $code
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
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
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set changeHistory
     *
     * @param string $changeHistory
     * @return Product
     */
    public function setChangeHistory($changeHistory)
    {
        $this->changeHistory = $changeHistory;

        return $this;
    }

    /**
     * Get changeHistory
     *
     * @return string 
     */
    public function getChangeHistory()
    {
        return $this->changeHistory;
    }

    /**
     * Set numberConsumerUnit
     *
     * @param integer $numberConsumerUnit
     * @return Product
     */
    public function setNumberConsumerUnit($numberConsumerUnit)
    {
        $this->numberConsumerUnit = $numberConsumerUnit;

        return $this;
    }

    /**
     * Get numberConsumerUnit
     *
     * @return integer 
     */
    public function getNumberConsumerUnit()
    {
        return $this->numberConsumerUnit;
    }

    /**
     * Set barcodeCU
     *
     * @param Barcode $barcodeCU
     * @return Product
     */
    public function setBarcodeCU(Barcode $barcodeCU)
    {
        $this->barcodeCU = $barcodeCU;

        return $this;
    }

    /**
     * Get barcodeCU
     *
     * @return Barcode
     */
    public function getBarcodeCU()
    {
        return $this->barcodeCU;
    }

    /**
     * Set barcodeSU
     *
     * @param Barcode $barcodeSU
     * @return Product
     */
    public function setBarcodeSU(Barcode $barcodeSU)
    {
        $this->barcodeSU = $barcodeSU;

        return $this;
    }

    /**
     * Get barcodeSU
     *
     * @return Barcode
     */
    public function getBarcodeSU()
    {
        return $this->barcodeSU;
    }

    /**
     * Set trademark
     *
     * @param Trademark $trademark
     * @return Product
     */
    public function setTrademark(Trademark $trademark)
    {
        $this->trademark = $trademark;

        return $this;
    }

    /**
     * Get trademark
     *
     * @return Trademark
     */
    public function getTrademark()
    {
        return $this->trademark;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Product
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set lastModificationDate
     *
     * @param \DateTime $lastModificationDate
     * @return Product
     */
    public function setLastModificationDate($lastModificationDate)
    {
        $this->lastModificationDate = $lastModificationDate;

        return $this;
    }

    /**
     * Get lastModificationDate
     *
     * @return \DateTime 
     */
    public function getLastModificationDate()
    {
        return $this->lastModificationDate;
    }

    /**
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getCode();
    }
}
