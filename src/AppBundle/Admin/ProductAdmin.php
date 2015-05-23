<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 8/03/15
 * Time: 22:51
 */

namespace AppBundle\Admin;

//use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
//Para "query"
//use Doctrine\ORM\QueryBuilder;
use AppBundle\Doctrine\ORM;
Use AppBundle\Entity;
use Sonata\AdminBundle\Route\RouteCollection;

class ProductAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'trademark'  // name of the ordered field
    );

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('trademark_barcode', 'trademark/barcode');
        //$collection->add('product_list', 'text');
    }


    protected function configureFormFields(FormMapper $form)
    {
        $disabled = $this->getSubject()->isNew() ? false : true;

        $form
            ->with('Edición de PRODUCTO')
            ->add('code', null, array(
                'label' => 'Código del producto',
                'disabled' => $disabled,
            ))
            ->add('name', null, array('label' => 'Descripción'))
            ->add('description', null, array('label' => 'Descripción completa'))
            ->add('changeHistory', null, array('label' => 'Historíal de modificaciones'))
            ->add('numberConsumerUnit', null, array('label' => 'Número de UC por Unidad de Venta'))
            ->add('trademark', null, array(
                'label' => 'Marca que corresponde',
                'placeholder' => 'Selecciona la marca del producto',
                'disabled' => $disabled,
            ))
            ->add('barcodeCU', null, array(
                'placeholder' => 'Selecciona el código de barras para la UNIDAD DE CONSUMO',
                'label' => 'Código de barras para la Unidad de Consumo',
                //'class' => 'AppBundle:Barcode',
                //'query' => $this->getConfigurationPool()->getContainer()->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:Barcode')->getBarcodeAsList('TYPECODE_GTIN_8'),
                //'attr'=>array('data-sonata-select2'=>'false'),
                'required' => false
            ))
            ->add('barcodeSU', null, array(
                'placeholder' => 'Selecciona el código de barras para la UNIDAD DE VENTA',
                'label' => 'Código de barras para la Unidad de Venta',
            ))
            //->add('creationDate', null, array('label' => 'Fecha de creación'))
            //->add('lastModificationDate', null, array('label' => 'Fecha de última actualización'))
            ->setHelps(array(
                'code'=>'Introduce el código del producto',
                'name'=>'Introduce la descripción breve del producto (máximo 40 caracteres)',
                'description'=>'Introduce la descripción completa del producto',
                'changeHistory'=>'Introduce cualquier información útil sobre los cambios que sufra el producto',
                'numberConsumerUnit'=>'Introduce el número de UC que agrupa la Unidad de Venta',
                'barcodeCU'=>'Código de barras para la UNIDAD DE CONSUMO',
                'barcodeSU'=>'Código de barras para la UNIDAD DE VENTA',
                'trademark' =>'Selecciona la marca que corresponde este código',
            ))
            ->end();
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('code', null, array('label' => 'Código producto'))
            ->add('name', null, array('label' => 'Descripción'))
            ->add('description', null, array('label' => 'Descripción completa'))
            ->add('changeHistory', null, array('label' => 'Historial'))
            ->add('numberConsumerUnit', null, array('label' => 'Número de UC por UV'))
            ->add('trademark', null, array('label' => 'Marca'))
            ->add('barcodeCU', null, array('label' => 'Código de UC'))
            ->add('barcodeSU', null, array('label' => 'Código de UV'))
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
            ->add('code', null, array('label' => 'Código producto'))
            ->add('name', null, array('label' => 'Descripción'))
            ->add('description', null, array('label' => 'Descripción completa'))
            ->add('changeHistory', null, array('label' => 'Historial de modificaciones'))
            ->add('numberConsumerUnit', null, array('label' => 'Número de UC por Unidad de Venta'))
            ->add('trademark', null, array('label' => 'Marca'))
            ->add('barcodeCU', null, array('label' => 'Código de barras para la UC'))
            ->add('barcodeSU', null, array('label' => 'Código de barras para la UV'))
            ->add('creationDate', null, array('label' => 'Fecha de Creación'))
            ->add('lastModificationDate', null, array('label' => 'Fecha de última modificación'))
        ;
    }

    protected function configureDatagridFilters( DatagridMapper $filter )
    {
        $filter
            ->add('code', null, array('label' => 'Código producto'))
            ->add('name', null, array('label' => 'Descripción'))
            ->add('description', null, array('label' => 'Descripción completa'))
            ->add('changeHistory', null, array('label' => 'Historial'))
            ->add('numberConsumerUnit', null, array('label' => 'Número de UC por Unidad de Venta'))
            ->add('trademark', null, array('label' => 'Marca'))
            ->add('barcodeCU', null, array('label' => 'Código de barras para la UC'))
            ->add('barcodeSU', null, array('label' => 'Código de barras para la UV'))
            ->add('creationDate', null, array('label' => 'Fecha de Creación'))
            ->add('lastModificationDate', null, array('label' => 'Fecha de última modificación'))
        ;
    }
}
