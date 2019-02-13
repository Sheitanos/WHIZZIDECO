<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HomeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('historyText', CKEditorType::class, array(
            'label' => "Entrez le texte de votre histoire",
            'config_name' => 'ck_home_config'
            ))
            ->add('careerText', CKEditorType::class, array(
                'label' => "Entrez le texte de votre parcours",
                'config_name' => 'ck_home_config'
            ))
            ->add('universText', CKEditorType::class, array(
                'label' => "Entrez le texte de votre univers créatif",
                'config_name' => 'ck_home_config'
            ))
            ->add('imageFile', VichImageType::class, array(
                'label' => "Modifier votre image de profile",
                'allow_delete' => false,
                'image_uri' => false,
                'download_uri' => false,
                'required' =>false
            ))
            ->add('inspirationImageFile', VichImageType::class, array(
                'label' => "Modifier votre image d'inspiration",
                'allow_delete' => false,
                'image_uri' => false,
                'download_uri' => false,
                'required' =>false
            ))
            ->add('favoriteMaterialImageFile', VichImageType::class, array(
                'label' => "Modifier votre image de matières favorites",
                'allow_delete' => false,
                'image_uri' => false,
                'download_uri' => false,
                'required' =>false
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Home'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_home';
    }


}
