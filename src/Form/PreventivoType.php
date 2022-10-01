<?php

namespace App\Form;

use App\Entity\Preventivo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\Lavori;

class PreventivoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
			->add('lavori', CollectionType::class, [
				// each entry in the array will be an "email" field
				'entry_type' => Lavori::class,
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Preventivo::class,
        ]);
    }
}
