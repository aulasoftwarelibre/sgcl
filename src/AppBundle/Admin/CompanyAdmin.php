<?php

/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 25/02/15
 * Time: 20:44
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class CompanyAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'name'  // name of the ordered field
    );

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Edición de COMPAÑÍA')
                ->add('name', null, array('label' => 'Nombre'))
                ->add('nif', null, array('label' => 'NIF'))
                ->add('company_address', 'textarea', array(
                    'label' => 'Dirección',
                ))
                ->add('phone', null, array('label' => 'Telefono'))
                ->setHelps(array(
                    'name'=>'Nombre de la empresa',
                    'nif'=>'NIF de la empresa (recuerde que son nueve caracteres)',
                    'company_address'=>'Dirección de la empresa',
                    'phone'=>'Número de eléfono de la empresa',
                ))
            ->end();
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name', null, array('label' => 'Nombre'))
            ->add('nif', null, array('label' => 'NIF'))
            ->add('company_address', null, array('label' => 'Dirección'))
            ->add('phone', null, array('label' => 'Teléfono'))
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
            ->add('name', null, array('label' => 'Nombre'))
            ->add('nif', null, array('label' => 'NIF'))
            ->add('company_address', null, array('label' => 'Dirección'))
            ->add('phone', null, array('label' => 'Teléfono'))
        ;
    }

    protected function configureDatagridFilters( DatagridMapper $filter )
    {
        $filter
            ->add('name', null, array('label' => 'Nombre'))
            ->add('nif', null, array('label' => 'NIF'))
        ;
    }
}

