<?php

namespace App\Controller;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiPostController extends AbstractController
{
    /**
     * @Route("/api/post", name="api_post_index", methods={"GET"})
     */
    public function index(PostRepository $postRepository, SerializerInterface $serializer)
    {
        $posts = $postRepository->findAll();

        $json = $serializer->serialize($posts, 'json', ['groups' => 'post:read']);
        
        $response = new JsonResponse($json, 200, [], true); 
        
        return $response;
    }
}
