<?php

namespace CarBundle\Form;

use CarBundle\Entity\CarBrand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarBrandType
 * @package CarBundle\Form
 */
class CarBrandType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        parent::buildForm($builder, $options);

        $builder->add('name', TextType::class, [
            'label' => 'Marka',
            'attr' => [
                'placeholder' => 'Marka'
            ]
        ])->add('submit', SubmitType::class, [
            'label' => 'Zapisz'
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CarBrand::class
        ]);
    }
}
