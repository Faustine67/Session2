<?php

namespace App\Form;

use App\Entity\Formateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom',TextType::class, [
            'label' => 'Nom'
        ])
        ->add('prenom',TextType::class, [
            'label' => 'prenom'
        ])
        ->add('dateNaissance',DateType::class, [
            'label' => 'Date de Naissance',
            'widget' => 'single_text',
        ])
        ->add('ville',TextType::class, [
            'label' => 'Ville'
        ])
        ->add('email',TextType::class, [
            'label' => 'Email'
        ])
        ->add('telephone',TextType::class, [
            'label' => 'Telephone'
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Ajouter'
        ]);
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formateur::class,
        ]);
    }
}
