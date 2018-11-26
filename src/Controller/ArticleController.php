<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show(Article $article) :Response
    {
        return $this->render('article/show.html.twig', [
            'article'=>$article
        ]);
    }

    /**
     * @Route("/article_search", name="article_search")
     */
    public function search(Request $request): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        $article = new Article();
        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }
        $form = $this->createForm(
            ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }
        return $this->render(
            'article/search.html.twig', [
                'articles' => $articles,
                'category' => $article->getCategory(),
                'categories'=> $categories,
                'form' => $form->createView(),
            ]
        );
    }
}
