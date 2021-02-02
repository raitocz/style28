<?php declare(strict_types=1);

namespace EryseBlog\Article\Frontend\Controller;

use EryseBlog\Article\Frontend\Dto\ViewIndexDto;
use EryseBlog\Article\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ViewController extends AbstractController
{
    /**
     * @Route("/view/{datePublished}/{slug}", name="frontend_article_view")
     *
     * @param ArticleRepository $articleRepository
     *
     * @return Response
     * @throws \Exception
     */
    public function index(ArticleRepository $articleRepository, $datePublished, $slug): Response
    {
        $article = $articleRepository->findOneBy(["datePublished" => new \DateTime($datePublished), "slug" => $slug]);

        $templateDto = new ViewIndexDto();
        $templateDto->setArticle($article);
        $templateDto->setNextArticle($articleRepository->findNext($article));
        $templateDto->setPreviousArticle($articleRepository->findPrevious($article));

        return $this->render('Frontend/Article/view.html.twig', ['dto' => $templateDto]);
    }
}
