<?php

namespace CarBundle\Form;

use CarBundle\Entity\CarModel;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            'placeholder' => 'Wybierz markę'
        ])->add('name', TextType::class, [
            'label' => 'Nazwa',
            'require' => true
        ])->add('productionDate', DateType::class, [
            'label' => 'Data produkcji',
            'require' => true
        ])->add('engineType', ChoiceType::class, [
            'label' => 'Data produkcji',
            'require' => true
        ])->add('submit', SubmitType::class, [
            'label' => 'Dodaj'
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CarModel::class
        ]);
    }
}