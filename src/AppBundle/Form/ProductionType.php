<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => "Titre",
            ))
            ->add('address', TextType::class, array(
                'label' => "Adresse",
            ))
            ->add('textBefore', CKEditorType::class, array(
                'label' => "Demande client",
                'config_name' => 'ck_home_config'
            ))
            ->add('textAfter', CKEditorType::class, array(
                'label' => "Missions réalisées",
                'config_name' => 'ck_home_config'
            ))
            ->add('customerReview', CKEditorType::class, array(
                'label' => "Avis client",
                'config_name' => 'ck_home_config',
                'required' =>false
            ))
            ->add('rate', TextType::class, array(
                'label' => "Note (de 0 à 5)",
                'required' =>false
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Production'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_production';
    }


}
