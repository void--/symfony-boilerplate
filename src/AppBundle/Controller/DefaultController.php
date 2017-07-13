<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
}
