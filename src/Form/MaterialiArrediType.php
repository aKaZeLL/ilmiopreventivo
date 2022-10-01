<?php

namespace App\Form;

use App\Entity\MaterialiArredi;
use App\Entity\Preventivo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MaterialiArrediType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tipologia')
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
            'data_class' => MaterialiArredi::class,
        ]);
    }
}
