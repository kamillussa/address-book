<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Email;
use AppBundle\Entity\Phone;

class AddressProfileController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:User');
        $contacts = $repository->findAllContacts();
        dump($contacts);

        return $this->render('AppBundle::index.html.twig', array());
    }


    /**
     * @Route("/new")
     */
    public function newAction()
    {
        return $this->render('AppBundle:AddressProfile:new.html.twig', array());
    }

    /**
     * @Route("/createContact")
     */
    public function createContactAction(Request $request)
    {
        $data = $request->request->all();
        $name = $data['name'];
        $surname = $data['surname'];
        $phoneNumber = new Phone($data['phoneNumber']);
        $email = new Email($data['email']);
        $description = $data['description'];

        $contact = new User();
        $contact->setName($name);
        $contact->setSurname($surname);
        $contact->setPhone($phoneNumber);
        $contact->setEmail($email);
        $contact->setDescription($description);

        $em = $this->getDoctrine()->getManager();
        $em->persist($phoneNumber);
        $em->persist($email);
        $em->persist($contact);
        $em->flush();

        return	$this->redirect("/");
    }

    /**
     * @Route("/modify/{id}")
     */
    public function modifyAction($id)
    {
        return $this->render('AppBundle:AddressProfile:modify.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete/{id}")
     */
    public function deleteAction($id)
    {
        return $this->render('AppBundle:AddressProfile:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/showAll")
     */
    public function showAllAction()
    {
        return $this->render('AppBundle:AddressProfile:show_all.html.twig', array(
            // ...
        ));
    }

}
