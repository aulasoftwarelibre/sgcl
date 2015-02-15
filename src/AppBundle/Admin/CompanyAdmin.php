<?php

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class CompanyAdmin extends Admin
{
    protected $baseRouteName = 'company';

    protected $baseRoutePattern = 'company';

    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'name'  // name of the ordered field
    );

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Crear nueva COMPAÑÍA')
                ->add('name')
                ->add('cif')
                ->add('company_address', 'textarea', array(
                    'label' => 'Dirección',
                ))
                ->add('phone')
                ->setHelps(array(
                    'name'=>'Introduce el nombre de la empresa',
                    'cif'=>'Introduce el NIF de la empresa (recuerde que son nueve caracteres)',
                    'company_address'=>'Introduce la dirección de la empresa',
                    'phone'=>'Introduce el teléfono de la empresa',
                ))
            ->end();
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->add('cif')
            ->add('company_address')
            ->add('phone')
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
            ->add('cif')
        ;
    }

    protected function configureDatagridFilters( DatagridMapper $filter )
    {
        $filter
            ->add('name')
        ;
    }


}

