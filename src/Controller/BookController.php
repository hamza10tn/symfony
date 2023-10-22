<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response as FlexResponse;
use DateTime;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request; 
use symfony\Component\Form\FormBuilderInterface;
use symfony\Component\OptionsResolver\OptionsResolver;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }
    #[Route('/addbook', name: 'add_book')]
    public function addbook(ManagerRegistry $mr,AuthorRepository $repo): Response
    {
        $bk= new Book();
        $author=$repo->find(8);
        $publicationDate = new DateTime('2023-10-20');
        $bk->setRef(8);
        $bk->setCategory("Drama");
        $bk->setTitle("80days");
        $bk->setAuth($author);
        $bk->setPublicationDate($publicationDate);
        $bk->setPublished(10);
        $em=$mr->getManager($author);
        $em->persist($bk);
        $em->flush();
        return new Response('added');
    }

    #[Route('/fetchbook', name: 'fetchbook')]
    public function fetchtwoBooks(BookRepository $repo){
$result=$repo->findAll();
return $this->render("book/books.html.twig",['book'=>$result]);

}
#[Route('/addformulaire', name: 'add_forme')]
public function formbook(Request $request, ManagerRegistry $mr): Response
{

$book=new Book();

$form =$this->createForm(BookType::class, $book);
 /*
    $form->handlerequest ($request);
    if($form->isSubmitted()  && $form->isvalid())
    $book = $form->getData();
    //$book->setIsDeleted (false);
    $em = $mr->getManager ();
    $em->persist ($book);
    $em->Flush();
    return $this->redirectToRoute('fetchbook');
*/

return $this->render("book/formbook.html.twig",['form'=>$form->createView()]);
}
}