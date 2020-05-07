<?php declare(strict_types=1);

namespace EryseBlog\Controller\Frontend\Article;

use EryseBlog\Repository\Article\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ListController extends AbstractController
{
    /**
     * @Route("/list", name="frontend_article_list")
     *
     * @param ArticleRepository $articleRepository
     *
     * @return Response
     * @throws \Exception
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAllVisible();

        return $this->render('Frontend/Article/list.html.twig', ['articles' => $articles]);
    }
}
