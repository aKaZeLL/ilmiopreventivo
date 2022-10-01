<?php

namespace App\Form;

use App\Entity\Lavori;
use App\Entity\Preventivo;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LavoriType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('specialista')
            ->add('intervento')
            ->add('prezzo')
            ->add('note')
			->add('preventivo', EntityType::class, [
				'class'=>Preventivo::class
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lavori::class,
        ]);
    }
}
