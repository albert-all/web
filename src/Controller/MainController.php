<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\BlogRepository;
use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'app_main')]
    public function index(PostRepository $postRepository): Response
    {
//        $hasAccess = $this->isGranted('ROLE_USER');
//        if (!$hasAccess)
//            return $this->redirect('/login');
//        if ($this->getUser()!=null){
//            var_dump($this->getUser());
//        }


        $user = new User();
        $post = $postRepository->findBy([], ['date' => 'DESC']);

        if ($this->getUser() == null) {
            return $this->render('main/main_page.html.twig', [
                'posts' => $post, 'userName' => null,
            ]);
        }

        return $this->render('main/main_page.html.twig', [
            'posts' => $post, 'userName' => $user = $this->getUser()->getName(),
        ]);

    }


}
