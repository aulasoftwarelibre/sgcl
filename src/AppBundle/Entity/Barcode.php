<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Form\Type;
use Symfony\Component\Validator\Context\ExecutionContextInterface;



/**
 * Barcode
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\BarcodeRepository")
 * @UniqueEntity("code")
 */
class Barcode
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
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     *
     */

    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=128, unique=true, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=false)
     */
    private $comment;

    /**
     * @var string
     *
     * @Assert\Length(
     *      max = "5",
     *      min = "5",
     *      exactMessage = "Recuerde que debe introducir cinco dígitos."
     * )
     */
    private $basecode;

    /**
     * @var boolean
     */
    private $withCounter;

    /***
     * @var TableLogisticVariables
     */
    private $tableLogisticVariables;

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
     * @ORM\ManyToOne(targetEntity="Trademark", inversedBy="barcodes")
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
     * Set comment
     *
     * @param string $comment
     * @return Barcode
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getBasecode()
    {
        return $this->basecode;
    }

    /**
     * @param integer $basecode
     */
    public function setBasecode( $basecode )
    {
        $this->basecode = $basecode;
    }

    /**
     * @return boolean
     */
    public function getWithCounter()
    {
        return $this->withCounter;
    }

    /**
     * @param boolean $withCounter
     */
    public function setWithCounter( $withCounter )
    {
        $this->withCounter = $withCounter;
    }

    /**
     * Set tableLogisticVariables
     *
     * @param TableLogisticVariables $tableLogisticVariables
     * @return Barcode
     */
    public function setTableLogisticVariables( $tableLogisticVariables)
    {
        $this->tableLogisticVariables = $tableLogisticVariables;

        return $this;
    }

    /**
     * Get tableLogisticVariables
     *
     * @return TableLogisticVariables
     */
    public function getTableLogisticVariables()
    {
        return $this->tableLogisticVariables;
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
     * Set trademarkDon't forget to comment out any existing LoadModule php5_module... line that might be present from Yosemite's own PHP version!
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
     * @return string
     *
     * This function generates a barcode.
     * If the counter brand registered as code base is used, this should be increased (and updated).
     * This function only generates GTIN-12, GTIN-13 and GTIN-14 codes.
     *
    */
    public function generateCode()
    {
        $use_counter = true;
        $base_code = '';
        $new_code = '';

        if ($this->getWithCounter())
        {
            $base_code = (string)($this->getTrademark()->getCounter() + 1);
        }
        else
        {
            $base_code = (string)$this->getBasecode();
        }
        $base_code = sprintf("%05d", $base_code);

        switch ($this->getType()) {
            case 'TYPECODE_GTIN_12':
                $codeWithoutChecksum = $this->getTrademark()->getPrefixUPC() . $base_code;
                $options = array('text' => $codeWithoutChecksum);
                $new_code = new \Zend\Barcode\Object\Upca($options);
                break;
            case 'TYPECODE_GTIN_13':
                $codeWithoutChecksum = $this->getTrademark()->getPrefix() . $base_code;
                $options = array('text' => $codeWithoutChecksum);
                $new_code = new \Zend\Barcode\Object\Ean13($options);
                break;
            case 'TYPECODE_GTIN_14':
                $codeWithoutChecksum = ((string)$this->getTableLogisticVariables()->getLogisticIndicator()) . $this->getTrademark()->getPrefix() . $base_code;
                $options = array('text' => $codeWithoutChecksum);
                $new_code = new \Zend\Barcode\Object\Itf14($options);
                break;
            default:
                throw new \InvalidArgumentException("Tipo de código no soportado: " . $this->getType());
        }

        return $new_code->getText();
    }

    /**
     * This function returns the bar code represented in a PNG image.
     * The Zend\Barcode library is used, and receives a string with the barcode
     * excluding the check digit (checksum).
     * This function only generates GTIN-12, GTIN-13 and GTIN-14 codes.
    */
    public function getImage()
    {
        $subCode = substr($this->getCode(), 0, -1 );

        $code_type = '';
        if($this->getType() == 'TYPECODE_GTIN_12') $code_type = 'upca';
        if($this->getType() == 'TYPECODE_GTIN_13') $code_type = 'ean13';
        if($this->getType() == 'TYPECODE_GTIN_14') $code_type = 'itf14';

        //When working with type code ITF, it should be framed.
        if($this->getType() == 'TYPECODE_GTIN_14') $barcodeOptions = array('text' => $subCode, 'withBorder' => true, 'factor' => 1);
        else $barcodeOptions = array('text' => $subCode, 'factor' => 1);
        $rendererOptions = array();
        /** @var Gd $image */
        $image = \Zend\Barcode\Barcode::factory(
            //'ean13', 'image', $barcodeOptions, $rendererOptions
            $code_type, 'image', $barcodeOptions, $rendererOptions
        )->draw();

        ob_start();
        imagepng($image);
        $contents =  ob_get_contents();
        ob_end_clean();

        return $contents;
    }

    /**
     * This function returns a PDF file, where the barcode is shown.
     * This function only generates GTIN-12, GTIN-13 and GTIN-14 codes.
    */
    public function getPDFBarcode()
    {
        $code_type = '';
        $formatted_code = '';
        $scale = 1.0;
        if($this->getType() == 'TYPECODE_GTIN_12'){
            $code_type = 'UPCA'; $formatted_code = sprintf("%012s", $this->getCode());
        }
        if($this->getType() == 'TYPECODE_GTIN_13'){
            $code_type = 'EAN13'; $formatted_code = sprintf("%013s", $this->getCode());
        }
        if($this->getType() == 'TYPECODE_GTIN_14'){
            $code_type = 'DUN14'; $formatted_code = sprintf("%014s", $this->getCode());  $scale = 0.5;
        }

        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setBarcode(date('Y-m-d H:i:s'));
        $pdf->setImageScale($scale);
        $pdf->AddPage();
        $txt1 = "Proyecto Fin de Carrera 'Sistema de Gestión de Códigos Logisticos'.";
        $txt2 = "Escuela Politécnica Superior de Córdoba, Universidad de Cordoba.";
        $txt3 = "Autores: María Jesús León García y Joaquín Millán Blanco.";
        $txt4 = "Código '" . $formatted_code .
            "' de tipo " . substr($this->getType(), 9) . " (". $code_type ."), " .
            "marca '" . $this->getTrademark() . "'.";

        $pdf->Cell(0, 0, $txt1, 0, 1);
        $pdf->Cell(0, 0, $txt2, 0, 1);
        $pdf->Cell(0, 0, $txt3, 0, 1);
        $pdf->Ln(); $pdf->Ln();
        $pdf->Cell(0, 0, $txt4, 0, 1);
        $pdf->Ln();
        $pdf->Image(
            '@'.$this->getImage(),
            '', '', '', '',
            'PNG', '', '', true, 300, '', false, false, 1, false, false, false
        );

        $pdf->Output('example_'. $formatted_code . '.pdf', 'I');

        return $pdf;
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
        return (string) $this->getCode();
    }
}
