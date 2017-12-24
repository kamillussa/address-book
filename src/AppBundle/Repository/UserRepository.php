<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllContacts()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT u.id, u.name, u.surname, p.phoneNumber FROM AppBundle:User u JOIN u.phone AS p WHERE u.id>0");
        $contacts = $query->getResult();
        return $contacts;
    }

    public function findContactById($id)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("Select u, p, e, a FROM AppBundle:User u LEFT OUTER JOIN u.phone p LEFT OUTER JOIN u.email e LEFT OUTER JOIN u.address a WHERE u.id=:id");
        $query->setParameter('id', $id);
        $contact = $query->getResult();
        return $contact;
    }
}
