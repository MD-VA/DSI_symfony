<?php

namespace App\Controller;

use App\Entity\GroupRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceptGroupRequestController extends AbstractController
{
    public function __invoke(GroupRequest $groupRequest)
    {
        $user = $this->getUser();
        $group = $groupRequest->getTargetGroup();
        $group->addMember($user);

    }

    #[Route('/accept/group/request', name: 'app_accept_group_request')]
    public function index(): Response
    {
        return $this->render('accept_group_request/index.html.twig', [
            'controller_name' => 'AcceptGroupRequestController',
        ]);
    }
}
