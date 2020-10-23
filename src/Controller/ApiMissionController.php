<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiMissionController extends AbstractController
{
    /**
     * @Route("/api/mission", name="api_mission", methods={"GET"})
     */
    public function getListMotos(MissionRepository $missionRepository, SerializerInterface $serializer)
    {
        $missions = $missionRepository->findAll();
        $json = $serializer->serialize($missions, 'json', ['groups' => 'list_missions']);
        return $response = new JsonResponse($json, 200, [], true);
    }


    /**
     * @Route("/api/mission/{id}", name="api_id_mission", methods={"GET"})
     */
    public function getMissionById($id, MissionRepository $missionRepository, SerializerInterface $serializer)
    {
        $mission = $missionRepository->find($id);
        $json = $serializer->serialize($mission, 'json', ['groups' => 'show_mission']);
        return $response = new JsonResponse($json, 200, [], true);
    }



    /**
     * @Route("/api/mission", name="api_mission_create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $jsonRecu = $request->getContent();
        try {
            $mission = $serializer->deserialize($jsonRecu, Mission::class, 'json');
            $errors = $validator->validate($mission);

            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }
            $entityManager->persist($mission);
            $entityManager->flush();
            return $this->json($mission, 201, [], ['groups' => 'list_missions']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }


    /**
     * @Route("/api/misstoday", name="api_nbr_mission_today", methods={"GET"})
     */
    public function getNbrMissionToday(MissionRepository $missionRepository, SerializerInterface $serializer)
    {
        $mission = $missionRepository->nbrMissionToday();
        $json = $serializer->serialize($mission, 'json');
        return $response = new JsonResponse($json, 200, [], true);
    }


    /**
     * @Route("/api/misscome", name="api_nbr_mission_come", methods={"GET"})
     */
    public function getNbrMissionCome(MissionRepository $missionRepository, SerializerInterface $serializer)
    {
        $mission = $missionRepository->nbrMissionCome();
        $json = $serializer->serialize($mission, 'json');
        return $response = new JsonResponse($json, 200, [], true);
    }




}
