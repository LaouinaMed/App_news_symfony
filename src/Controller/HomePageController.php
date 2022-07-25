<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(NewsRepository $newsRepository): Response
    {
        /*
        $user = new User();
        $user->setEmail('simed.laouina@gmail.com');
        $user->setPassword($userPasswordHasher->hashPassword($user,'simoxe'));
        $user->setFirstName("Mohammed");
        $user->setLastName("Laouina");
        $entityManager->persist($user);
        $entityManager->flush();
        */

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'news'=>$newsRepository->findAll(),
        ]);
    }

    #[Route('/news/{id<[0-9]+>}', name: 'app_new_show')]

    public function newShow($id , NewsRepository $newsRepository ): Response
    {
        $newsId = $newsRepository->find($id);
        return $this->render('home_page/news_single.html.twig', [
            'single_news'=>$newsRepository->find($newsId),
        ]);
    }
}
