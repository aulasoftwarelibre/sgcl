<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 8/03/15
 * Time: 18:43
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TableLogisticVariablesAdmin extends Admin
{

    protected $baseRouteName = 'tableLogisticVariables';

    protected $baseRoutePattern = 'tableLogisticVariables';

    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'trademark'  // name of the ordered field
    );

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Añadir una nueva variable logística')
            ->add('logisticIndicator', null, array('label' => 'Dígito logístico'))
            ->add('description', null, array('label' => 'Descripción'))
            //->add('creationDate', null, array('label' => 'Fecha de creación'))
            //->add('lastModificationDate', null, array('label' => 'Fecha de última actualización'))
            ->add('trademark', null, array('label' => 'Marca que corresponde'))
            ->setHelps(array(
                'logisticIndicator'=>'Introduce el dígito logístico',
                'code'=>'Introduce una descripción que explique la correspondencia con la UC',
                'trademark' =>'Selecciona la marca que corresponde este código',
            ))
            ->end();
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('logisticIndicator')
            ->add('description')
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
            ->add('logisticIndicator', 'string', array())
            ->add('description')
            ->add('creationDate')
            ->add('lastModificationDate')
            ->add('trademark')
        ;
    }

    protected function configureDatagridFilters( DatagridMapper $filter )
    {
        $filter
            ->add('logisticIndicator', null, array(
                'label'=> 'Código logístico'),
                null, array(
                    'constraints' => array()
                )
            )
            ->add('description')
            ->add('creationDate')
            ->add('lastModificationDate')
            ->add('trademark')
        ;
    }
}