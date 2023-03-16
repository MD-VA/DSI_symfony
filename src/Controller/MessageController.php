<?php
namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/discussions/{discussion_id}/messages", name="message_index", methods={"GET"})
     */
    public function index(int $discussion_id, MessageRepository $messageRepository): JsonResponse
    {
        // Récupérer les messages de la discussion avec l'ID $discussion_id
        $messages = $messageRepository->findBy(['discussion' => $discussion_id]);

        // Renvoyer les messages sous forme de réponse JSON
        return $this->json($messages);
    }

    /**
     * @Route("/discussions/{discussion_id}/messages", name="message_create", methods={"POST"})
     */
    public function create(int $discussion_id, Request $request): JsonResponse
    {
        // Récupérer les données du message à créer depuis la requête HTTP
        $data = json_decode($request->getContent(), true);

        // Créer une nouvelle instance de l'entité Message
        // $message = new Message();
        // $message->setContent($data['content']);
        // $message->setAuthor($this->getUser());
        // $message->setDiscussion($discussion_id);

        // // Enregistrer le message en base de données
        // $entityManager = $this->getDoctrine()->getManager();
        // $entityManager->persist($message);
        // $entityManager->flush();

        // Renvoyer le message créé sous forme de réponse JSON
        // return $this->json($message);
        return $this->json(['error' => 'Not implemented'], 501);
    }

    /**
     * @Route("/discussions/{discussion_id}/messages/{message_id}", name="message_show", methods={"GET"})
     */
    public function show(int $discussion_id, int $message_id, MessageRepository $messageRepository): JsonResponse
    {
        // Récupérer le message avec l'ID $message_id et la discussion avec l'ID $discussion_id
        $message = $messageRepository->findOneBy(['id' => $message_id, 'discussion' => $discussion_id]);

        // Vérifier si le message existe
        if (!$message) {
            return $this->json(['error' => 'Message not found'], 404);
        }

        // Renvoyer le message sous forme de réponse JSON
        return $this->json($message);
    }

    /**
     * @Route("/discussions/{discussion_id}/messages/{message_id}/votes", name="message_vote", methods={"POST"})
     */
    // public function vote(int $discussion_id, int $message_id, Request $request, MessageRepository $messageRepository): JsonResponse
    // {
    //     // Récupérer le message avec l'ID $message_id et la discussion avec l'ID $discussion_id
    //     $message = $messageRepository->findOneBy(['id' => $message_id, 'discussion' => $discussion_id]);

    //     // Vérifier si le message existe
    //     if (!$message) {
    //         return $this->json(['error' => 'Message not found'], 404);
    //     }

    //     // Récupérer l'utilisateur authentifié qui vote
    //     $user = $this->getUser();

    //     // Vérifier si l'utilisateur a déjà voté pour ce message
    //     if ($message->hasVoted($user)) {
    //         return $this->json(['error' => 'User has already voted for this message'], 400);

    //     }

    //     // Ajouter le vote de l'utilisateur au message
    //     $message->addVote($user);
    
    //     // Enregistrer le message en base de données
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $entityManager->flush();
    
    //     // Renvoyer le message mis à jour sous forme de réponse JSON
    //     return $this->json($message);
    // }
}