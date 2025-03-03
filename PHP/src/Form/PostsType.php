<?php

namespace App\Form;

use App\Entity\Hashtags;
use App\Entity\Posts;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content_text')
            ->add('content_multimedia', FileType::class, [
                'label' => 'Image du post (PNG, JPEG)',
                'mapped' => false, // Non lié directement à l'entité
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Erreur de upload',
                    ]),
                ],
            ])
            ->add('metadata', EntityType::class, [
                'class' => Hashtags::class,
                'choice_label' => 'name',
            ])
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('fk_user', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}
