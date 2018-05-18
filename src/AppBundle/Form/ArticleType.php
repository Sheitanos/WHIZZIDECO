<?php

namespace AppBundle\Form;

use AppBundle\Entity\Partner;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('price', TextType::class, array(
                    'label' => "Prix"
                ))
                ->add('name', TextType::class, array(
                    'label' => "Nom de l'article"
                ))
                ->add('imageFile', VichImageType::class, array(
                    'label' => "Image de l'article",
                    'allow_delete' => false,
                    'image_uri' => false,
                    'download_uri' => false,
                ))
                ->add('partner', EntityType::class, array(
                    'class' => Partner::class,
                    'label' => "Partenaire",
                    'choice_label' => 'name',
                    'empty_data'  => null,
                    'required' => false
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_article';
    }


}
