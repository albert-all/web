<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setName("Albert");
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'Albert2001'
        );
        $user->setPassword($hashedPassword);
        $user->setPatronymic('QQQ');
        $user->setEmail('albert.e.m@mail.ru');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setSurname("Mamedov");
        $manager->persist($user);


        $blog = new Blog();
        $blog->setName("Начало сайта");
        $blog->setTopic("Создание сайта");
        $blog->setAnnotation("Будет много интересного");
        $manager->persist($blog);
        $blog->setCreation(new \DateTime());
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setAnnotation("Анотация № ".$i);
            $post->setContent('Сделали задание № '.$i);
            $post->setHeading('Заголовок № '. $i);
            $post->setBlog($blog);
            $post->setDate(new \DateTime());
            $post->setView(0);
            $manager->persist($post);
            $post->setPhoto('/img/blog-img/'.($i%7+1).'.jpg');
            if ($i%2 == 0){
                $post->setIspublication(false);
            }
            else
                $post->setIspublication(true);
        }
        $manager->flush();
    }
}
