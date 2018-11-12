<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
//    /**
//     * @Route("/blog", name="blog")
//     */
//    public function index()
//    {
//        return $this->render('blog/index.html.twig', [
//            'controller_name' => 'BlogController',
//        ]);
//    }

    /**
     * @Route("/blog/{slug}", name="blog_show", requirements={"slug"="([a-z-0-9]+)"})
     */
    public function show($slug = "Article Sans Titre")
    {
        $slug = ucwords(str_replace("-", " ", $slug), " ");
        return $this->render('blog/show.html.twig', ['slug' => $slug]);
    }
}
