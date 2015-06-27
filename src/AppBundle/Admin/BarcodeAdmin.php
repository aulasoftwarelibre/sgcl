<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 28/02/15
 * Time: 20:46
 */

namespace AppBundle\Admin;

use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\Query;
use AppBundle\Form\Type;
use AppBundle\Doctrine\ORM;
use AppBundle\Entity\Barcode;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Class BarcodeAdmin
 * @package AppBundle\Admin
 */
class BarcodeAdmin extends Admin
{
    /**
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'code'  // name of the ordered field
    );

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('trademark_tablelogisticvariables', 'trademark/tablelogisticvariables');
        $collection->add('render_codebar', 'image');
        $collection->add('print_pdfbarcode', 'pdf');
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $disabled = $this->getSubject()->isNew() ? false : true;

        $form
            ->with('Edición de CÓDIGO DE BARRAS')
            ->add('trademark', null, array(
                'label' => 'Marca que corresponde este código',
                'placeholder' => 'Selecciona la marca del producto',
                'disabled' => $disabled,
            ))
            ->add('type', 'codeType', array(
                'label' => 'Tipo',
                'placeholder' => 'Selecciona el tipo de código logístico',
                'disabled' => $disabled
            ))
            ->add('tableLogisticVariables', 'entity', array(
                'class' => 'AppBundle:TableLogisticVariables',
                'required' => false,
                'placeholder' => 'Selecciona el código logístico para la Unidad de Venta',
                'label' => 'Número logístico',
                'disabled' => $disabled,
            ))
            ->add('withCounter', 'checkbox', array(
                'required'=> false,
                'label' => 'Seleccionar para emplear el contador de productos de la marca,
                    en caso contrario debará introducir los dígitos base manualmente',
                'disabled' => $disabled,
            ))
            ->add('basecode', 'text', array(
                'required'=> false,
                'label' => 'código_base',
                'disabled' => $disabled,
            ))
            ->add('comment', null, array('label' => 'Comentarios'))
            ->add('code', null, array(
                'mapped'=> false,
                'required'=> false,
                'label' => 'Código',
                'disabled' => $disabled,
            ))
            //->add('creationDate', null, array('label' => 'Fecha de creación'))
            //->add('lastModificationDate', null, array('label' => 'Fecha de última actualización'))
            ->setHelps(array(
                'type'=>'Selecciona el tipo de código',
                'basecode'=>'Introduce los cinco dígitos qué servirán de código_base',
                'code'=>'Introduce el código (incluido el dígito del control)',
                'trademark' =>'Selecciona la marca que corresponde este código',
                'comment' => 'Indicación breve sobre el motivo de este código',
            ))
            ->end();
    }

    /**
     * @param Barcode $barcode
     */
    public function prePersist($barcode)
    {
        $barcode->setCode( $barcode->generateCode() );
    }

    /**
     * @param ErrorElement $errorElement
     * @param Barcode $object
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        if (!$object->getWithCounter()) {
            if($object->getBasecode() < 0 || $object->getBasecode() > 99999){
                $errorElement
                    ->with('basecode')
                    ->addViolation('Recuerde que son cinco dígitos desde 00000 a 99999')
                    ->end()
                ;
            }else {
                /** @var QueryBuilder $query */
                $query = $this->getModelManager()->createQuery($this->getClass(), 'o');
                $barcode = $query
                    ->where('o.code = :code')
                    ->setParameter('code', $object->generateCode())
                    ->getQuery()
                    ->execute()
                ;

                if (!empty($barcode)) {
                    $errorElement
                        ->with('basecode')
                        ->addViolation('El código está en uso')
                        ->end()
                    ;
                }
            }
        } else {
            do {
                $object->getTrademark()->incCounter();
                $query = $this->getModelManager()->createQuery($this->getClass(), 'o');
                $barcode = $query
                    ->where('o.code = :code')
                    ->setParameter('code', $object->generateCode())
                    ->getQuery()
                    ->execute()
                ;
            } while (!empty($barcode));
        }
    }


    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('code', null, array('label' => 'Código', 'route' => array('name' => 'show')))
            ->add('type', null, array('label' => 'Tipo'))
            ->add('trademark', null, array('label' => 'Marca'))
            ->add('comment', null, array('label' => 'Comentario'))
            ->add('creationDate', null, array('label' => 'Fecha de creación'))
            ->add('lastModificationDate', null, array('label' => 'Fecha de última modificación'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param ShowMapper $filter
     */
    protected function configureShowFields(ShowMapper $filter)
    {
        $filter
            ->add('type', 'string', array('label' => 'Tipo'))
            ->add('code', null, array('label' => 'Código'))
            ->add('comment', null, array('label' => 'Comentarios'))
            ->add('trademark', null, array('label' => 'Marca'))
            ->add('creationDate', null, array('label' => 'Fecha de creación'))
            ->add('lastModificationDate', null, array('label' => 'Fecha de última modificación'))
        ;
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters( DatagridMapper $filter )
    {
        $filter
            ->add('type', null, array(
                    'label'=> 'Tipo'),
                null, array(
                    'constraints' => array()
                )
            )
            ->add('code', null, array('label' => 'Código'))
            ->add('trademark', null, array('label' => 'Marca'))
            ->add('comment', null, array('label' => 'Comentarios'))
            ->add('creationDate', null, array('label' => 'Fecha de creación'))
            ->add('lastModificationDate', null, array('label' => 'Fecha de última modificación'))
        ;
    }

}
