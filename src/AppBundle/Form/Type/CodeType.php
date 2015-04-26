<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 1/03/15
 * Time: 17:08
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CodeType extends AbstractType
{
    private $codeTypeChoices;

    public function __construct(array $codeTypeChoices)
    {
        $this->codeTypeChoices = $codeTypeChoices;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
           'choices' => $this->codeTypeChoices
        ]);
    }

    public function getParent()
    {
        return 'choice';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'codeType';
    }

    //public function getDefaultOptions(array $options)
    public function getDefaultOptions()
    {
        //En este método se especifica las opciones por defecto.
        return array(
            //'choice_list' => null,
            'choices' => array(),
        );
    }
}
