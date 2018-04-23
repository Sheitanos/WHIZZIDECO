<?php

namespace AppBundle\Form;

use AppBundle\Entity\Production;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductionPictureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class, array(
                'label' => "Votre image",
                'allow_delete' => false,
                'image_uri' => false,
                'download_uri' => false,
            ))
            ->add('beforeProduction', EntityType::class, array(
                'class' => Production::class,
                'choice_label' => 'title',
                'empty_data'  => null,
                'required' => false,
                'label' => 'Attribuer à une Réalisation (avant)',
            ))
            ->add('afterProduction', EntityType::class, array(
                'class' => Production::class,
                'choice_label' => 'title',
                'empty_data'  => null,
                'required' => false,
                'label' => 'Attribuer à une Réalisation (après)',
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ProductionPicture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_productionpicture';
    }


}
