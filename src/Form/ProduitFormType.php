<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
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
            ])

            ->add('photo', FileType::class,[
                'label' => "Photo d'illustration",
                # 'data_class' => permet de paramétrer le type de classe de données à null
                    # par défaut data_class = File
                'data_class' => null,
                'attr' => [
                    'data-default-file' => $options['photo'],
                ],
                'constraints' => [
                    new Image([
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => "Les types de photo autorisées sont : .jpg et .png",
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            // 'allow_file_upload' => permet d'autoriser les upload de fichier dans le formulaire
            'allow_file_upload' => true, 
            // 'photo' => permet de récupérer la photo existante lors d'un update
            'photo' => null,
        ]);
    }
}
