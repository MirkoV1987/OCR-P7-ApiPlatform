<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
// use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class ProductController extends AbstractController
{
    public function create(Request $request, EntityManagerInterface $em)
    {
        $product = new Product();
        $product->setName('Samsung Galaxy')
                ->setBrand('Samsung')
                ->setDescription('Ceci est le nouveau modèle de Samsung Galaxy')
                ->setPrice(450)
                ->setDateAdd(new \Datetime)
                ->setProperties('RAM 250Mo', 'Lithium Battery');

        $em->persist($product);
        $em->flush();

        return new Response(sprintf('Product %s successfully created', $product->getName()));
    }

    public function list(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $roles = $request->request->get('roles');

        if (!$roles) {
            $roles = json_encode([]);
        }

        $user = new User($username);
        $user->setUsername('Mirko Venturi');  
        $user->setEmail('mirkoventuri@gmail.com');
        $user->setDateAdd(new \Datetime);  
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setRoles(($roles));
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }
}
