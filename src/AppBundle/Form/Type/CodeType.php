<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 1/03/15
 * Time: 17:08
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CodeType
 * @package AppBundle\Form\Type
 */
class CodeType extends AbstractType
{
    /**
     * @var array
     */
    private $codeTypeChoices;

    /**
     * @param array $codeTypeChoices
     */
    public function __construct(array $codeTypeChoices)
    {
        $this->codeTypeChoices = $codeTypeChoices;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
           'choices' => $this->codeTypeChoices
        ]);
    }

    /**
     * @return string
     */
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

    /**
     * @return array
     *
     * This is the public method.
     */
    public function getDefaultOptions()
    {
        return array(
            //'choice_list' => null,
            'choices' => array(),
        );
    }
}
