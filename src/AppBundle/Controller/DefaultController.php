<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction() {
        return $this->render('pages/about.html.twig');
    }

    /**
     * @Route("/blog/{slug}", name="blog")
     */
    public function blogAction($slug, EntityManagerInterface $em) {
        $post = $em->getRepository(BlogPost::class)->findOneBy(['slug' => $slug]);

        if (!$post) {
            $this->createNotFoundException('No blog post found at that path');
        }

        return $this->render('pages/blog.html.twig', [
            'slug' => $slug,
            'body' => $post->getBody()
        ]);
    }
}
