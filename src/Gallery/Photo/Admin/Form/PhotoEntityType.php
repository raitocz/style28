<?php declare(strict_types=1);

namespace EryseBlog\Gallery\Photo\Admin\Form;

use Doctrine\ORM\EntityRepository;
use EryseBlog\Article\Entity\ArticleEntity;
use EryseBlog\Gallery\Photo\Entity\PhotoEntity;
use EryseBlog\Article\Repository\ArticleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PhotoEntityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('label', TextType::class, ['label' => 'Label']);
        $builder->add('imageFile', VichImageType::class, ['label' => 'Photo']);
        $builder->add(
            'article',
            EntityType::class,
            [
                'class' => ArticleEntity::class,
                'query_builder' => function (EntityRepository $articleRepository) {
                    return $articleRepository->createQueryBuilder('a')
                        ->orderBy('a.datePublished', 'DESC');
                },
                'choice_label' => function (ArticleEntity $article) {
                    return $article->getId() . ' - [' . $article->getDatePublished()
                            ->format(
                                'd. m. Y'
                            ) . '] - ' . $article->getTitle();
                }
            ]
        );
        $builder->add('submit', SubmitType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => PhotoEntity::class,
            )
        );
    }
}
