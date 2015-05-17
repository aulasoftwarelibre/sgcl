<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 28/02/15
 * Time: 20:46
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
//Para el uso del tipo de dado "codetype"
use AppBundle\Form\Type;
//Para "query"
use AppBundle\Doctrine\ORM;
use AppBundle\Entity\Barcode;
use Sonata\AdminBundle\Route\RouteCollection;


class BarcodeAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'trademark'  // name of the ordered field
    );

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('trademark_tablelogisticvariables', 'trademark/tablelogisticvariables');
        $collection->add('render_codebar', 'image');
        $collection->add('print_pdfbarcode', 'pdf');
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Generar un nuevo código de barras')
            ->add('trademark', null, array(
                'label' => 'Marca que corresponde este código',
                'placeholder' => 'Selecciona la marca del producto',
            ))
            ->add('type', 'codeType', array('label' => 'Tipo'))
            ->add('tableLogisticVariables', 'entity', array(
                'class' => 'AppBundle:TableLogisticVariables',
                'required' => false,
                'placeholder' => 'Selecciona el código logístico para la Unidad de Venta',
                'label' => 'Número logístico'
            ))
            ->add('withCounter', 'checkbox', array(
                'required'=> false,
                'label' => 'Seleccionar para emplear el contador de productos de la marca, en caso contrario debará introducir los dígitos base manualmente'
            ))
            ->add('basecode', 'text', array(
                'required'=> false,
                'label' => 'código_base'
            ))
            ->add('comment', null, array('label' => 'Comentarios'))
            //->add('code', null, array('label' => 'Código'))
            ->add('code', null, array('mapped'=> false, 'required'=> false, 'label' => 'Código'))
            //->add('creationDate', null, array('label' => 'Fecha de creación'))
            //->add('lastModificationDate', null, array('label' => 'Fecha de última actualización'))
            ->setHelps(array(
                'type'=>'Introduce el tipo de código',
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

        if ($barcode->getWithCounter()) {
            $barcode->getTrademark()->incCounter();
        }
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('code', null, array('label' => 'Código'))
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
