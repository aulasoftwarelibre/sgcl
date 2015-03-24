<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//Para los ASSERT .. las validaciones
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
//Para asignar 'datatime'
use Gedmo\Mapping\Annotation as Gedmo;
//Para el uso del tipo de dado "codetype"
use AppBundle\Form\Type;


/**
 * Barcode
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\BarcodeRepository")
 */
class Barcode
{
    /*const TYPE_GTIN_8 = 'GTIN-8';
    const TYPE_GTIN_12 = 'GTIN-12';
    const TYPE_GTIN_13 = 'GTIN-13';
    const TYPE_GTIN_14 = 'GTIN-14';
    const TYPE_GS1_128 = 'GTIN-128';
    */

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
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     *
     */
//@Assert\Choice(choices={"GTIN-8", "GTIN-12", "GTIN-13", "GTIN-14", "GTIN-128"})
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=128, unique=true, nullable=false)
     * @Assert\NotBlank(message="Recuerde introducir el código")
     * @Assert\Length(max="128", maxMessage="No más de 128 caracteres")
     */
    private $code;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="lastModificationDate", type="datetime")
     */
    private $lastModificationDate;

    /**
     * @var Trademark
     *
     * @ORM\ManyToOne(targetEntity="Trademark", inversedBy="trademarks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trademark_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     * @Assert\Valid()
     */
    private $trademark;

    /**
     * Get id
     *
     * @return integer 
     */

    /**
     * Get all type values
     *
     * @return array
     */

    public static function getTypees()
    {
        return array(self::TYPE_GTIN_8, self::TYPE_GTIN_12, self::TYPE_GTIN_13, self::TYPE_GTIN_14, self::TYPE_GS1_128);
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Barcode
     */
    public function setType($type)
    {
    /*    if (!in_array($type, self::getTypees())) {
            throw new \InvalidArgumentException('Error, es un tipo incorrecto.');
        }
        $this->type = $type;

        return $this;
    */
    /*    $codeType = new Type\CodeType(array());
        if (!in_array($type, $codeType->getDefaultOptions(array())))
        {
            throw new \InvalidArgumentException('Error, es un tipo incorrecto.');
        }
        $this->type = $type;
    */
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Barcode
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Barcode
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
     * @return Barcode
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
     * Set trademark
     *
     * @param Trademark $trademark
     * @return Barcode
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
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getCode();
    }
}
