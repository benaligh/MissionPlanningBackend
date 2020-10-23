<?php

namespace App\Controller;

use App\Repository\LivreurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiLivreurController extends AbstractController
{
    /**
     * @Route("/api/livreur", name="api_livreur" , methods={"GET"})
     */
    public function getListLivreurs(LivreurRepository $livreurRepository, SerializerInterface $serializer)
    {
         $livreur = $livreurRepository->findAll();
         $json = $serializer->serialize($livreur, 'json', ['groups' => 'list_livreur']);
         return $response = new JsonResponse($json, 200, [], true);
    }


    /**
     * @Route("/api/livreur/{id}", name="api_id_livreur" , methods={"GET"})
     */
    public function getLivreurById($id, LivreurRepository $livreurRepository, SerializerInterface $serializer)
    {
        $livreur = $livreurRepository->find($id);
        $json = $serializer->serialize($livreur, 'json', ['groups' => 'show_livreur']);
        return $response = new JsonResponse($json, 200, [], true);
    }
}
