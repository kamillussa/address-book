<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AddressProfileController extends Controller
{
    /**
     * @Route("/new")
     */
    public function newAction()
    {
        return $this->render('AppBundle:AddressProfile:new.html.twig', array(
            // ...
        ));
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
