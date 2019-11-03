<?php

namespace CarBundle\Form;

use CarBundle\Models\CarsFilterModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarsFilterType
 * @package CarBundle\Form
 */
class CarsFilterType extends AbstractType
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
            'placeholder' => 'Wszystkie',
            'required' => false
        ])->add('carModel', TextType::class, [
            'label' => 'Model',
            'required' => false
        ])->add('productionYear', IntegerType::class, [
            'label' => 'Rok produkcji',
            'required' => false,
        ])->add('fuelType', ChoiceType::class, [
            'label' => 'Rodzaj paliwa',
            'placeholder' => 'Wszystkie',
            'choices' => [
                'Benzyna' => 'Benzyna',
                'Diesel' => 'Diesel',
                'LPG' => 'LPG'
            ],
            'required' => false
        ])->add('show', SubmitType::class, [
            'label' => 'Szukaj'
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CarsFilterModel::class
        ]);
    }
}
