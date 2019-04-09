<?php

namespace AppBundle\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class, array(
                'label' => "Entrez votre adresse",
            ))
            ->add('phoneNumber', TextType::class, array(
                'label' => "Entrez votre n° de téléphone",
            ))
            ->add('mail', TextType::class, array(
                'label' => "Entrez votre mail",
            ))
            ->add('schedule', CKEditorType::class, array(
                'label' => "Entrez vos horaire d'ouverture",
                'config_name' => 'my_config_1'
            ));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}