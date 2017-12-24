<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Email;
use AppBundle\Entity\Phone;
use AppBundle\Entity\Address;

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

        return $this->render('AppBundle::index.html.twig', array('contacts' => $contacts));
    }


    /**
     * @Route("/new")
     */
    public function newAction()
    {
        return $this->render('AppBundle:New:new_contact.html.twig', array());
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
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:User');
        $contact = $repository->findContactById($id);
        dump($contact);
        return $this->render('AppBundle:AddressProfile:modify.html.twig', array('contact' => $contact));
    }

    /**
     * @Route("/delete/{id}")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:User');
        $user = $repository->find($id);
        $em->remove($user);
        $em->flush();

        return $this->redirect('/');
    }

    /**
     * @Route("/showDetails/{id}")
     */
    public function showDetailsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:User');
        $contact = $repository->findContactById($id);
        dump($contact);
        return $this->render('AppBundle:AddressProfile:show_details.html.twig', array('contact' => $contact));
    }

    /**
     * @Route("/newHomeAddress")
     */
    public function newHomeAddressAction()
    {
        return $this->render('AppBundle:New:new_home_address.html.twig', array());
    }

    /**
     * @Route("/createHomeAddress")
     */
    public function createHomeAddressAction(Request $request)
    {
        $data = $request->request->all();
        $street = $data['street'];
        $homeNumber = $data['homeNumber'];
        $flatNumber = $data['flatNumber'];
        $city = $data['city'];

        $address = new Address();
        $address->setStreet($street);
        $address->setHomeNumber($homeNumber);
        $address->setFlatNumber($flatNumber);
        $address->setCity($city);

        $em = $this->getDoctrine()->getManager();
        $em->persist($address);
        $em->flush();

        return	$this->redirect("/");
    }

    /**
     * @Route("/find")
     */
    public function findAction()
    {
        return $this->render('AppBundle::find.html.twig', array());
    }

}
