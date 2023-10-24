<?php

namespace App\Form;

use App\Entity\Candidat;
use App\Entity\Entretien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
class EntretienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date',DateType::class)
            ->add('etat', CheckboxType::class, [
                'label' => 'Etat', 
                'required' => false,
                'data' => true
            ])
            ->add(
                'type', 
                ChoiceType::class, 
                [
                    'choices' => [
                        'Technique N1' => 'Technique N1',
                        'Technique N2' => 'Technique N2',
                        'Ressources Humaine' => 'Ressources Humaine',
                    ],
                'expanded' => true
                ]
            )
            ->add('candidat',EntityType::class,[
                'class'=>Candidat::class,
                'choice_label'=>'nom',
                'multiple' => false
            ])
            ->add('Submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entretien::class,
        ]);
    }
}
