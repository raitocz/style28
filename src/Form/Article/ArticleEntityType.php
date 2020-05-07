<?php

namespace EryseBlog\Form\Article;

use DateTime;
use EryseBlog\Entity\Article\ArticleEntity;
use Exception;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleEntityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @throws Exception
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('title');
        $builder->add('author', TextType::class, ['data' => 'raito']);
        $builder->add('public');
        $builder->add('content', TextareaType::class, [
            'attr' => [
                'class' => 'mde-wrapper',
            ],
        ]);
        $builder->add('dateCreated', DateType::class, [
            'data' => new DateTime(),
            'widget' => 'single_text',
        ]);
        $builder->add('datePublished', DateType::class, [
            'data' => new DateTime(),
            'widget' => 'single_text',
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleEntity::class,
        ]);
    }
}
