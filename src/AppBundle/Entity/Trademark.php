<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//Para los ASSERT .. las validaciones
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
     * @ORM\Column(name="name", type="string", length=255, unique=true, nullable=false)
     * @Assert\Length(max="255", maxMessage="No más de 255 caracteres")
     */
    private $name;
///*@Assert\Type(type="integer", message="Tienes que introducir SIETE dígitos")
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
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }


}
