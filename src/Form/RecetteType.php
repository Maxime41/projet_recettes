<?php

namespace App\Form;

use App\Entity\Recette;
use App\Entity\Ingredients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('temps')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('description')
            ->add('prix')
            ->add('difficulte')
            ->add('ingredients', EntityType::class, [
                'class' => Ingredients::class,
                'choice_label' => 'nom',
                 'multiple' => true,
                 'expanded' => false,
            ])
            ->add('save', SubmitType::class, ['label' => $options['submit label']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'submit label' => null,
            // 'data_class' => Recette::class,
        ]);
    }
}
