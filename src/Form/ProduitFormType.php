<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProduitFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Titre du produit",
                'constraints' => [
                    new NotBlank([
                        'message' => "Ce champ ne peut être vide"
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 255,
                        'minMessage' => "Le nombre de caractères minimal est de {{ limit }}. Votre titre est trop court.",
                        'maxMessage' => "Le nombre de caractères maximal est de {{ limit }}. Votre titre est trop long.",
                    ])
                ],
            ])

            ->add('content', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Ici le contenu du produit"
                ],
                // Les contraintes de validation pour 'content' sont dans Produit Entity (propriété $content)
            ])
        ;
    }
}
