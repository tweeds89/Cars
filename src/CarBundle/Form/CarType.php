<?php

namespace CarBundle\Form;

use CarBundle\Entity\Car;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarType
 * @package CarBundle\Form
 */
class CarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        parent::buildForm($builder, $options);

        $builder->add('carBrand', EntityType::class, [
            'label' => 'Marka',
            'class' => 'CarBundle\Entity\CarBrand',
        ])->add('model', TextType::class, [
            'label' => 'Model',
            'required' => true
        ])->add('productionYear', IntegerType::class, [
            'label' => 'Data produkcji',
            'required' => true
        ])->add('fuelType', ChoiceType::class, [
            'label' => 'Typ paliwa',
            'required' => true,
            'choices' => [
                'Benzyna' => 'Benzyna',
                'Diesel' => 'Diesel',
                'LPG' => 'LPG'
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
            'data_class' => Car::class
        ]);
    }
}
