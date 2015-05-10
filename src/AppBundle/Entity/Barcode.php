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
 * @ORM\EntityListeners({ "AppBundle\EventListener\BarcodeListener" })
 * @ORM\HasLifecycleCallbacks()
 * @Assert\Callback(methods={"exist_barcode"})
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
     * @Assert\Callback({"Vendor\Package\Validator", "exist_code"})
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

    //****************************************
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


    public function generateCode(Barcode $barcode)
    {
        $use_counter = True;
        $base_code = '';
        $new_code = '';

        if ($barcode->getBasecode()) {
            $base_code = (string)$barcode->getBasecode();
            $use_counter = False;
        } else {
            //Se toma como código base el SIGUIENTE valor del contador de productos de la marca
            $base_code = (string)($barcode->getTrademark()->getCounter() + 1);
            $use_counter = True;
        }
        $base_code = sprintf("%05d", $base_code);

        switch ($barcode->getType()) {
            case 'TYPECODE_GTIN_12':
                $codeWithoutChecksum = $barcode->getTrademark()->getPrefixUPC() . $base_code;
                $options = array('text' => $codeWithoutChecksum);
                $new_code = new \Zend\Barcode\Object\Upca($options);
                break;
            case 'TYPECODE_GTIN_13':
                $codeWithoutChecksum = $barcode->getTrademark()->getPrefix() . $base_code;
                $options = array('text' => $codeWithoutChecksum);
                $new_code = new \Zend\Barcode\Object\Ean13($options);
                break;
            case 'TYPECODE_GTIN_14':
                $codeWithoutChecksum = ((string)$barcode->getTableLogisticVariables()->getLogisticIndicator()) . $barcode->getTrademark()->getPrefix() . $base_code;
                $options = array('text' => $codeWithoutChecksum);
                $new_code = new \Zend\Barcode\Object\Itf14($options);
                break;
            default:
                throw new \InvalidArgumentException("Tipo de código no soportado: " . $barcode->getType());
        }

        return $new_code->getText();
    }

    public function getImage()
    {
        //En primer lugar debemos recuperar el contenido del código sin el dígito de control,
        //ya que este lo generará de nuevo la librería gráfica antes de generar la imagen
        $subCode = substr($this->getCode(), 0, -1 );
        //obtenemos el tipo de código y lo traducimos al parámetro de tipo de código de la librería gráfica
        //ESTO DEBE IMPLEMENTARSE MEDIANTE TRADUCCIÓN DE NOMBRES... ahora mismo solo se puede trabajar con EAN13 y DUN14
        $code_type = '';
        if($this->getType() == 'TYPECODE_GTIN_12') $code_type = 'upca';
        if($this->getType() == 'TYPECODE_GTIN_13') $code_type = 'ean13';
        if($this->getType() == 'TYPECODE_GTIN_14') $code_type = 'itf14';

        //Si se dibuja código tipo ITF debe enmarcarse en un cuadro como indica la norma
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

    public function getPDFBarcode()
    {
        $code_type = '';
        $formatted_code = '';
        if($this->getType() == 'TYPECODE_GTIN_12'){
            $code_type = 'UPCA'; $formatted_code = sprintf("%012s", $this->getCode());
        }
        if($this->getType() == 'TYPECODE_GTIN_13'){
            $code_type = 'EAN13'; $formatted_code = sprintf("%013s", $this->getCode());
        }
        if($this->getType() == 'TYPECODE_GTIN_14'){
            $code_type = 'CODABAR'; $formatted_code = sprintf("%014s", $this->getCode());
        }


        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setBarcode(date('Y-m-d H:i:s'));
        $pdf->AddPage();
        $txt = "Proyecto Fin de Carrera 'SGCL'.\n Se imprime código " . $formatted_code . " de tipo " . $this->getType() . "\n";
        $pdf->MultiCell(70, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
        $pdf->SetY(30);

        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
        $pdf->write1DBarcode( $formatted_code , $code_type, '', '', '', 18, 0.4, $style, 'N');
        $pdf->Ln();
        $pdf->write1DBarcode('1234567890128', 'EAN13', '', '', '', 18, 0.4, $style, 'N');
        $pdf->Ln();
        $pdf->Cell(0, 0, 'UPC-A', 0, 1);
        $pdf->write1DBarcode('12345678901', 'UPCA', '', '', '', 18, 0.4, $style, 'N');

        $pdf->Output('example_'. $formatted_code . '.pdf', 'I');
        return $pdf;
    }

    /**
     * @Assert\Callback
     */
    public function exist_barcode(ExecutionContextInterface $context)
    {
        if ( '078336000018' === $this->generateCode( $this ) )
        {
            $context->buildViolation('¡Este código ya existe en el sistema!')
                ->atPath('code')
                ->addViolation()
            ;
        }
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
