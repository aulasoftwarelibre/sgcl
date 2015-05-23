<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//Para los ASSERT .. las validaciones
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
//Para asignar 'datatime'
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * TableLogisticVariables
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\TableLogisticVariablesRepository")
 * @UniqueEntity(fields={"logisticIndicator", "trademark"})
 */
class TableLogisticVariables
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
     * @var integer
     *
     * @ORM\Column(name="logisticIndicator", type="integer", unique=false, nullable=false)
     * @Assert\Regex(
     *      pattern="/^\d{1}$/",
     *      match=true,
     *      message="Recuerda que es un sólo dígito positivo distinto de cero."
     * )
     * @Assert\Regex(
     *      pattern="/^0{1}$/",
     *      match=false,
     *      message="Recuerda que la variable logística NO puede ser cero."
     * )
     * @Assert\Range(
     *  min=1,
     *  max=9,
     *  minMessage="Recuerda que NO puede ser menor que 1",
     *  maxMessage="Recuerda que NO puede ser mayor de 9"
     * )
     */
    private $logisticIndicator;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

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
     * @ORM\Column(name="lastModificacionDate", type="datetime")
     */
    private $lastModificationDate;

    /**
     * @var Trademark
     *
     * @ORM\ManyToOne(targetEntity="Trademark", inversedBy="tablelogisticvariabless")
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set logisticIndicator
     *
     * @param integer $logisticIndicator
     * @return TableLogisticVariables
     */
    public function setLogisticIndicator($logisticIndicator)
    {
        $this->logisticIndicator = $logisticIndicator;

        return $this;
    }

    /**
     * Get logisticIndicator
     *
     * @return integer 
     */
    public function getLogisticIndicator()
    {
        return $this->logisticIndicator;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TableLogisticVariables
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return TableLogisticVariables
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
     * @return TableLogisticVariables
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
     * @return TableLogisticVariables
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
     * Get is a new entity
     *
     * @return bool
     */
    public function isNew()
    {
        return $this->id === null ? true : false;
    }

    /**
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getLogisticIndicator();
    }
}
