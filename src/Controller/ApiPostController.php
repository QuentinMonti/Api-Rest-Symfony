<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse ;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


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


    /**
     * @Route("/api/post", name="api_post_store", methods={"POST"})
     */
    public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $jsonRecu = $request->getContent();

        $post = $serializer->deserialize($jsonRecu, Post::class, 'json');
        
        $post->setCreatedAt(new \DateTime());

        $em->persist($post);
        $em->flush();

        dd($post);
    }
}
