<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 8/03/15
 * Time: 18:43
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class TableLogisticVariablesAdmin
 * @package AppBundle\Admin
 */
class TableLogisticVariablesAdmin extends Admin
{
    /**
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC') ... ASC or DESC
        '_sort_by' => 'logisticIndicator'  // name of the ordered field
    );

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $disabled = $this->getSubject()->isNew() ? false : true;

        $form
            ->with('Edición de VARIABLE LOGÍSTICA')
            ->add('trademark', null, array(
                'label' => 'Marca que corresponde',
                'placeholder' => 'Selecciona la marca',
                'disabled' => $disabled,
            ))
            ->add('logisticIndicator', null, array('label' => 'Dígito logístico'))
            ->add('description', null, array('label' => 'Descripción'))
            //->add('creationDate', null, array('label' => 'Fecha de creación'))
            //->add('lastModificationDate', null, array('label' => 'Fecha de última actualización'))
            ->setHelps(array(
                'logisticIndicator'=>'Introduce el dígito logístico',
                'description'=>'Introduce una indicación que explique la correspondencia con la UC',
                'trademark' =>'Selecciona la marca que corresponde este código',
            ))
            ->end();
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('logisticIndicator', null, array('label' => 'Dígito logístico'))
            ->add('description', null, array('label' => 'Descripción'))
            ->add('creationDate', null, array('label' => 'Fecha de creación'))
            ->add('lastModificationDate', null, array('label' => 'Fecha de última modificación'))
            ->add('trademark', null, array('label' => 'Marca'))
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
            ->add('logisticIndicator', 'string', array('label' => 'Dígito logístico'))
            ->add('description', null, array('label' => 'Descripción'))
            ->add('trademark', null, array('label' => 'Marca'))
            ->add('creationDate', null, array('label' => 'Fecha de Creación'))
            ->add('lastModificationDate', null, array('label' => 'Fecha de última modificación'))
        ;
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters( DatagridMapper $filter )
    {
        $filter
            ->add('logisticIndicator', null, array(
                'label'=> 'Dígito logístico'),
                null, array(
                    'constraints' => array()
                )
            )
            ->add('description', null, array('label' => 'Descripción'))
            ->add('trademark', null, array('label' => 'Marca'))
            ->add('creationDate', null, array('label' => 'Fecha de creación'))
            ->add('lastModificationDate', null, array('label' => 'Fecha de última modificación'))
        ;
    }
}
