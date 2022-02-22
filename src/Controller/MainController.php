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
    public function ajouter_contacts(Request $request, EntityManagerInterface $manager): Response

    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //dd($request);

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', 'Bonjour' . $contact->getFirstname() . "votre message est bien envoyé!!");
            return $this->redirectToRoute('main');
            //dd($contact);
        }
        return $this->render('main/accueil.html.twig', [

            "formContact" => $form->createView(),
            //"contact"=>$contact
        ]);
    }

    #[Route('/main_a_propos', name: 'a_propos')]
    public function ajouter_contactss(Request $request, EntityManagerInterface $manager): Response

    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //dd($request);

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', 'Bonjour' . $contact->getFirstname() . "vous avez bien été ajouté sur la BDD");
            return $this->redirectToRoute('main');
            //dd($contact);
        }


        return $this->render('main/a_propos.html.twig', [

            "formContact" => $form->createView(),
            //"contact"=>$contact
        ]);
    }






}









