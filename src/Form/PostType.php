<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('heading', TextType::class, [
                'attr' => ['class' => 'form-control', 'maxlength' => '70', 'type' => 'text', 'id' => 'HeaderAdd'],
            ])
            ->add('annotation', TextareaType::class, [
                'attr' => ['class' => 'form-control TextareaAnnotation',
                    'maxlength' => '255', 'required',
                    'placeholder' => 'Введите текст', 'id' => 'TextareaAnnotation'],
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control TextareaPost',
                    'required',
                    'placeholder' => 'Введите текст', 'id' => 'TextareaPost'],
            ])
            ->add('photo', FileType::class, [
                'attr' => ['class' => 'main_input_file', 'type' => 'file', 'name' => 'file',
                    'accept' => 'image/*'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
