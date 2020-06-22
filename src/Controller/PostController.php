<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $posts = $entityManager->getRepository(BlogPost::class)->findAll();
        dump($posts);die;
        return $this->render('post/index.html.twig', [
            'post' => $posts,
        ]);
    }
}
