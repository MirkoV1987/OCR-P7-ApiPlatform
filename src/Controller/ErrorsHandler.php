<?php
/**
 * Created by PhpStorm.
 * User: philippetraon
 * Date: 22/11/2018
 * Time: 23:04
 */

namespace App\Controller;

use App\Entity\User;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ErrorsController
 * @package App\Controller
 */
class ErrorsHandler extends AbstractController
{
    /**
     * @Route("/api/products/{id}", name="products")
     */
    public function productCheck($id, ProductRepository $productRepository)
    {
        $product = $productRepository->find($id);
        if(!$product)
        {
            $data['@context'] = "/contexts/Error";
            $data['@type'] = "Erreur";
            $data['hydra:title'] = "Une erreur est survenue";
            $data['hydra:description'] = "Le produit $id n'existe pas";
            return $this->json($data, 404);
        }
        return $this->json($product);
    }

    /**
     * @Route("/api/clients/{id}/users", name="client")
     */
    public function clientCheck($id, ClientRepository $clientRepository)
    {
        $client = $clientRepository->find($id);
        if(!$client)
        {
            $data['@context'] = "/contexts/Error";
            $data['@type'] = "Erreur";
            $data['hydra:title'] = "Une erreur est survenue";
            $data['hydra:description'] = "Le client $id n'existe pas";
            return $this->json($data, 404);
        }
        return $this->json($client);
    }

    /*====================================================
    ============Users per Client Errors Handler=========== 
    ====================================================*/

    //**
    // * @Route("/api/clients/{No}/users/{id}", requirements={"No"="\d+"}, name="users")
    // */
    /**
     * @Route("/api/clients/1/users/{id}", name="users")
     */
    // public function userCheck($id, UserRepository $userRepository)
    // {
    //     $user = $userRepository->find($id);
    //     if(!$user)
    //     {
    //         $data['@context'] = "/contexts/Error";
    //         $data['@type'] = "Erreur";
    //         $data['hydra:title'] = "Une erreur est survenue";
    //         $data['hydra:description'] = "L'utilisateur $id n'existe pas";
    //         return $this->json($data, 404);
    //     }
    //     return $this->json($user);
    // }
}