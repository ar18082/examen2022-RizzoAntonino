<?php

namespace App\Form;

use App\Entity\Chanson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChansonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('nomAlbum')
            ->add('paroles')
            ->add('auteur')
            ->add('votes')
            ->add('genre')
            ->add('save', SubmitType::class, [
                'label' => 'enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chanson::class,
        ]);
    }
}
