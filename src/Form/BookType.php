<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref')
            ->add('title', null,[
                'label'=>'title',
                'help' =>'metter le titre',
                'attr'=>[
                    'placeholder'=>'titre'
                ]

            ])
            ->add('category')
            ->add('published')
            ->add('publicationDate',DateType::class,[
                'widget'=>'single_text'
            ])
           ->add('auth', EntityType::class,[
            'placeholder'=>'select an author',
            'class' =>Author::class,
            'choice_label' => 'username'
           ])
           ->add('save',SubmitType::class,['label'=>'save'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
