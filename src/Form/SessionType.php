<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formation;
use Symfony\Component\Notifier\Texter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule',TextType::class,[
                'label'=>'intitule'
            ])
            ->add('dateDebut',DateType::class,[
                'label' => 'Date de Debut',
                'widget' => 'single_text',
            ])
            ->add('dateFin',DateType::class,[
                'label' => 'Date de Fin',
                'widget' => 'single_text',
            ])
            ->add('nombrePlaces',IntegerType::class,[
                'label'=>'Nombre de places',
            ])
            // ->add('stagiaires')
            
            ->add('formation',EntityType::class,[
                'class'=>Formation::class,
                'choice_label'=> 'nom',
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
