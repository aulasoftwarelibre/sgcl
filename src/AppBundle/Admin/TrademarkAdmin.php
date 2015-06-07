<?php

/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 25/02/15
 * Time: 21:38
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class TrademarkAdmin
 * @package AppBundle\Admin
 */
class TrademarkAdmin extends Admin
{
    /**
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'name'  // name of the ordered field
    );

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Edición de MARCA')
            ->add('name', null, array('label' => 'Nombre'))
            ->add('prefix', null, array('label' => 'Prefijo codificación'))
            ->add('prefixUPC', null, array('label' => 'Prefijo codificación para código UPC'))
            ->add('company', null, array('label' => 'Compañía propietaria de la marca'))
            ->setHelps(array(
                'name'=>'Introduce el nombre de la marca registrada',
                'prefix'=>'Introduce los siete números que identifica la marca',
                'prefixUPC' =>'Introduce, en caso se disponga, de los seis números que identifican la marca para generación de UPC',
            ))
            ->end();
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name', null, array('label' => 'Nombre'))
            ->add('prefix', null, array('label' => 'Prefijo'))
            ->add('prefixUPC', null, array('label' => 'Prefijo UPC'))
            ->add('counter', null, array('label' => 'Contador'))
            ->add('company', null, array('label' => 'Compañía'))
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
            ->add('name', null, array('label' => 'Nombre'))
            ->add('prefix', null, array('label' => 'Prefijo'))
            ->add('prefixUPC', null, array('label' => 'Prefijo UPC'))
            ->add('counter', null, array('label' => 'Contador'))
            ->add('company', null, array('label' => 'Compañía'))
        ;
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters( DatagridMapper $filter )
    {
        $filter
            ->add('name', null, array('label' => 'Nombre'))
            ->add('prefix', null, array('label' => 'Prefijo'))
            ->add('prefixUPC', null, array('label' => 'Prefijo UPC'))
            ->add('company', null, array('label' => 'Compañía'))
        ;
    }
}
