<?php

namespace App\Form;

use App\Entity\CartItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;

class CartItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('waist', ChoiceType::class, [
                'choices' => [
                    '38' => 38,
                    '39' => 39,
                    '40' => 40,
                    '41' => 41,
                    '42' => 42,
                    '43' => 43,
                ],
                'multiple' => false,
                'placeholder' => 'Choisir une taille',
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez choisir une taille']),
                    new Choice(['choices' => [38, 39, 40, 41, 42, 43], 'message' => 'Taille invalide']),
                ]
            ])
            ->add('add_to_cart', SubmitType::class, [
                'label' => 'Ajouter au panier',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CartItem::class,
        ]);
    }
}
