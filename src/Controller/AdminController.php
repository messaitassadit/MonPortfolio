<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            //'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/contact/afficher', name: 'admin_contact_afficher')]
    public function display_contactss(ContactRepository $truc): Response

    {
        $contacts = $truc->findAll();
        return $this->render('admin/contacts.html.twig', [
            
            "contacts"=>$contacts
        ]);
    }

    #[Route('/admin/supprimer_contact/{id}', name: 'admin_supprimer_contact')]
    public function supprimer_contacts(Contact $contact, EntityManagerInterface $manager): Response
    {
       
        $firstnameContact = $contact->getFirstname();
        $lastnameContact = $contact->getLastname();


            $manager->remove($contact);
            $manager->flush();
            $this->addFlash("success", "le contact a été supprimé" . /*$LastnameContact . $firstnameContact . */"!!");

            return $this->redirectToRoute('admin_contact_afficher');
        }


    
    
}
