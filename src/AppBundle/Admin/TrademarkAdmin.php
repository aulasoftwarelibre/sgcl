<?php

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;


class TrademarkAdmin extends Admin
{
    protected $baseRouteName = 'trademark';

    protected $baseRoutePattern = 'trademark';

    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'name'  // name of the ordered field
    );

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Crear nueva marca')
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

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->add('prefix')
            ->add('prefixUPC')
            ->add('counter')
            ->add('company')
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
            ->add('name')
            ->add('prefix')
            ->add('prefixUPC')
            ->add('counter')
            ->add('company')
        ;
    }

    protected function configureDatagridFilters( DatagridMapper $filter )
    {
        $filter
            ->add('name')
            ->add('prefix')
            ->add('prefixUPC')
            ->add('company')
        ;
    }
}

