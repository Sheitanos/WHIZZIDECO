<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 19/03/18
 * Time: 14:37
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SendMailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => "Votre nom"])
            ->add('firstname', TextType::class, [
                'label' => "Votre Prénom"])
            ->add('email', EmailType::class, [
                'label' => "Votre email"
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => "Votre n° de téléphone"
            ])
            ->add('message', TextareaType::class, [
                'label' => "Votre message",
                'attr' => array('rows' => 9),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_send_mail';
    }
}