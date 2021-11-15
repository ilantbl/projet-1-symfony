<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);

    }

    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title' => "Bienvenue les amis",
            'age' => 17
        ]);
    }

    /**
     * @Route ("/blog/new", name="blog_create")
     */
    public function create(Request $request, ObjectManager $manager) {

        $article = new Article();
        $form = $this->createFormBuilder($article)
                     ->add('title')
                     ->add('content')
                     ->add('content')
                     ->getForm();

        return $this-> render('blog/create.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }

    /**
     * @Route ("/blog/{id}" , name="blog_show" )
     */
    public function show(Article $article) {

        return $this-> render('blog/show.html.twig', [
            'article' => $article
        ]);
    }
    
}
