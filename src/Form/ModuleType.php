<?php

namespace App\Form;

use App\Entity\Module;
use App\Form\ModuleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => 'nom',
                ])
            ->add('nombreJours',IntegerType::class,[
                'label' => 'nombreJours',
                ])
            ->add('categorie',EntityType::class,[
                'class'=>Categorie::class,
                'choice_label'=>nom,
                ])
            ->add('submit', SubmitType::class, [
                    'label' => 'Ajouter'
                ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
