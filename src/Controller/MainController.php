<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        return $this->render('main/accueil.html.twig', [
            //'controller_name' => 'MainController',
        ]);
         
    }

    #[Route('/main/contact/ajouter', name: 'main_contact_ajouter')]
    public function ajouter_contacts(Request $request, EntityManagerInterface $manager): Response

    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //dd($request);

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', 'Bonjour' . $contact->getFirstname() . "vous avez bien été ajouté suer la BDD");
            return $this->redirectToRoute('main');
            //dd($contact);
        }


        return $this->render('main/ajouter_contact.html.twig', [

            "formContact" => $form->createView(),
            //"contact"=>$contact
        ]);
    }

}









