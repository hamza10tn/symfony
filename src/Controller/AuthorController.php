<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/list', name: 'list')]
    public function list(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' =>
                'victor.hugo@gmail.com ', 'nb_books' => 0),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg', 'username' => ' William Shakespeare', 'email' =>
                ' william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' =>
                'taha.hussein@gmail.com', 'nb_books' => 300),
        );

        return $this->render('author/list.html.twig', [
            'tab' => $authors,
        ]);
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function auhtorDetails($id)
    {

        return $this->render('author/detail.html.twig', [
        ]);
    }
    #[Route('/fetch', name: 'fetchone')]
    public function fetchAuthors(ManagerRegistry $mr){
        $repo=$mr->getRepository(Author::class);
        $result=$repo->findAll();
        dd($result);
    }
    #[Route('/fetchtwo', name: 'fetchtwo')]
    public function fetchtwoAuthors(AuthorRepository $repo){
            $result=$repo->findAll();
            return $this->render('author/authors.html.twig',[
                'auth'=>$result
            ]);
}

#[Route('/addauthor', name: 'addAuth')]
public function addAuthor(ManagerRegistry $mr )
{
$author=new Author();
$author->setCin(100);
$author->setUsername("Peter");
$author->setEmail("peter@gmail.com");
$author->setNbBooks(5);
$em=$mr->getManager();
$em->persist($author);
$em->flush();
return $this->redirectToRoute('fetchtwo');
}

#[Route('/deleteauthor/{id}', name: 'deleteauthor')]
public function removeAuthor(ManagerRegistry $mr,$id,AuthorRepository $repo){
    $author=$repo->find($id);
    $em=$mr->getManager();
    if ($author!=null) {
        $em->remove($author);
        $em->flush();
    }else{
        return new Response("id n'existe pas");
    }
    return $this->redirectToRoute("fetchtwo");
    }
}