<?php

namespace App\Controller;

use App\Repository\AdressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiAdressController extends AbstractController
{
    /**
     * @Route("/api/adress", name="api_adress", methods={"GET"})
     */
    public function getListAdress(AdressRepository $adressRepository, SerializerInterface $serializer)
    {
        $adress = $adressRepository->findAll();
        $json = $serializer->serialize($adress, 'json', ['groups' => 'list_adress']);
        return $response = new JsonResponse($json, 200, [], true);
    }


    /**
     * @Route("/api/adress/{id}", name="api_id_adress" , methods={"GET"})
     */
    public function getLivreurById($id, AdressRepository $adressRepository, SerializerInterface $serializer)
    {
        $adress = $adressRepository->find($id);
        $json = $serializer->serialize($adress, 'json', ['groups' => 'show_adress']);
        return $response = new JsonResponse($json, 200, [], true);
    }
}
