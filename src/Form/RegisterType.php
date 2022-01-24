<?php

namespace App\Form;

use App\Entity\Register;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,  ["label"=>"identifiant mail :"])
            ->add('nom', TextType::class,  ["label"=>"Nom :"])
            ->add('prenom', TextType::class,  ["label"=>"Prenom :"])
            ->add('password', PasswordType::class, ["label"=>"Nouveau mot de passe :"])
            ->add('ConfirmPassword', PasswordType::class , ["label"=>"confirmation du mot de passe :"])
            ->add('save', SubmitType::class, ["label"=>"confirmer"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Register::class,
        ]);
    }
}
