<?php

namespace App\Controller;
 
use App\Entity\User;
use App\DataPersister\UserDataPersister;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
 
class ClientUserHandler extends UserDataPersister
{
    /**
     * @var \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    private $validator;

    /**
     * @var SerializerInterface
     */
    private $serializer;
 
    /**
     * Constructor
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer, UserDataPersister $userDataPersister)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->userDataPersister = $userDataPersister;
    }

    public function __invoke(Request $request)
    {
        $data = $this->serializer->deserialize($request->getContent(), User::class, 'json');   
        
        $this->userDataPersister->persist($data);
 
        return new JsonResponse(["id" => $data->getId(), "status" => 201, "message" => "L'utilisateur a été créé avec succès !"]);
    }

    // public function delete(Request $request)
    // {
    //     $data = $this->serializer->deserialize($request->getContent(), User::class, 'json');   
        
    //     $data = $this->userDataPersister->remove($data);
 
    //     return new JsonResponse(["id" => $data->getId(), "status" => 204, "message" => "L'utilisateur a été supprimé avec succès !"]);
    // }
}
