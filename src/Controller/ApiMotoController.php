<?php

namespace App\Controller;

use App\Repository\MotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiMotoController extends AbstractController
{
    /**
     * @Route("/api/moto", name="api_moto", methods={"GET"})
     */
    public function getListMotos(MotoRepository $motoRepository, SerializerInterface $serializer)
    {
        $motos = $motoRepository->findAll();
        $json = $serializer->serialize($motos, 'json', ['groups' => 'list_moto']);
        return $response = new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/api/moto/{id}", name="api_id_moto" , methods={"GET"})
     */
    public function getMotoById($id, MotoRepository $motoRepository, SerializerInterface $serializer)
    {
        $moto = $motoRepository->find($id);
        $json = $serializer->serialize($moto, 'json', ['groups' => 'show_moto']);
        return $response = new JsonResponse($json, 200, [], true);
    }
}
