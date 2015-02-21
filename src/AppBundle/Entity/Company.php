<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//Para los ASSERT .. las validaciones
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Company
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CompanyRepository")
 */
class Company
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
     * @Assert\Length(max="255", maxMessage="No más de 255 caracteresssss")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="nif", type="string", length=9, unique=true, nullable=false)
     * @Assert\Regex(
     * pattern="/^[abcdefghjnpqrsuvwABCDEFGHJNPQRSUVW]\d{8}$/",
     * match=true,
     * message="Revisa el NIF"
     * )
     * @Assert\Regex(
     * pattern="/^[abcdefghjnpqrsuvwABCDEFGHJNPQRSUVW]0{8}$/",
     * match=false,
     * message="Todos los númros NO pueden ser ceros"
     * )
     */
    private $nif;

    /**
     * @var string
     * @ORM\Column(name="company_address", type="string", length=255, nullable=true)
     */
    private $company_address;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=30, nullable=true)
     */
    private $phone;

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
     * @return Company
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
     * Set nif
     *
     * @param string $nif
     * @return Company
     */
    public function setNif($nif)
    {
        $this->nif = strtoupper( $nif );

        return $this;
    }

    /**
     * Get nif
     *
     * @return string 
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set company_address
     *
     * @param string $company_address
     * @return Company
     */
    public function setCompanyAddress($company_address)
    {
        $this->company_address = $company_address;

        return $this;
    }

    /**
     * Get company_address
     *
     * @return string
     */
    public function getCompanyAddress()
    {
        return $this->company_address;
    }


    /**
     * Set phone
     *
     * @param string $phone
     * @return Company
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
