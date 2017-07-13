<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller {

    /**
     * @Route("/login", name="login"))
     */
    public function loginAction(Request $request, AuthenticationUtils $auth_utils) {
        $error = $auth_utils->getLastAuthenticationError();
        $lastUsername = $auth_utils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction() {
        // Nothing needed here, @see logout key in security.yml
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/admin/user/add", name="create_user")
     */
    public function createUser() {
        return $this->render('security/login.html.twig');
    }
}