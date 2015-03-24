<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 8/03/15
 * Time: 22:51
 */

namespace AppBundle\Admin;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
//Para "query"
use Doctrine\ORM\QueryBuilder;
use AppBundle\Doctrine\ORM;
Use AppBundle\Entity;


class ProductAdmin extends Admin
{

    protected $baseRouteName = 'product';

    protected $baseRoutePattern = 'product';

    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'trademark'  // name of the ordered field
    );

    // aquí va funcion -> public function createQuery($context = 'list')

    /*
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('createProduct', $this->getRouterIdParameter().'/newproduct');
    }
    */

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Datos del producto')
            ->add('code', null, array('label' => 'Código del nuevo producto'))
            ->add('name', null, array('label' => 'Descripción breve'))
            ->add('description', null, array('label' => 'Descripción completa'))
            ->add('changeHistory', null, array('label' => 'Historíal de modificaciones'))
            ->add('numberConsumerUnit', null, array('label' => 'Número de UC por Unidad de Venta'))
            ->add('barcodeCU', 'sonata_type_model', array(
                'label' => 'Código de barras para la Unidad de Consumo',
                'class' => 'AppBundle:Barcode',
                'query' => $this->getConfigurationPool()->getContainer()->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:Barcode')->getBarcodeAsList('TYPECODE_GTIN_8'),
                'required' => false,
            ))
            ->add('barcodeSU', null, array('label' => 'Código de barras para la Unidad de Venta'))
            //->add('creationDate', null, array('label' => 'Fecha de creación'))
            //->add('lastModificationDate', null, array('label' => 'Fecha de última actualización'))
            ->add('trademark', null, array('label' => 'Marca que corresponde'))
            ->setHelps(array(
                'code'=>'Introduce el código del nuevo producto',
                'name'=>'Introduce la descripción breve del producto',
                'description'=>'Introduce la descripción del producto',
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
            ->addIdentifier('code')
            ->add('name')
            ->add('description')
            ->add('changeHistory')
            ->add('numberConsumerUnit')
            ->add('barcodeCU')
            ->add('barcodeSU')
            ->add('creationDate')
            ->add('lastModificationDate')
            ->add('trademark')
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
            ->add('code')
            ->add('name')
            ->add('description')
            ->add('changeHistory')
            ->add('numberConsumerUnit')
            ->add('barcodeCU')
            ->add('barcodeSU')
            ->add('creationDate')
            ->add('lastModificationDate')
            ->add('trademark')
        ;
    }

    protected function configureDatagridFilters( DatagridMapper $filter )
    {
        $filter
            ->add('code')
            ->add('name')
            ->add('description')
            ->add('changeHistory')
            ->add('numberConsumerUnit')
            ->add('barcodeCU')
            ->add('barcodeSU')
            ->add('creationDate')
            ->add('lastModificationDate')
            ->add('trademark')
        ;
    }
}
