<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category_{id}", name="category")
     */
    public function index(Category $category) :Response
    {
        return $this->render('category/index.html.twig', [
            'category'=>$category,
            'articles'=>$category->getArticles()
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function show(Category $category) :Response
    {
        return $this->render('category/show.html.twig', [
            'category'=>$category
        ]);
    }
}
