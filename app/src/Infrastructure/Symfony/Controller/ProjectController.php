<?php

namespace Infrastructure\Symfony\Controller;

use Application\DTO\Project\CreateProjectDTO;
use Application\UseCase\Project\CreateProjectHandler;
use Application\UseCase\Project\DeleteProjectHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project', methods: ['GET'])]
    public function index(Request $request, CreateProjectHandler $handler): JsonResponse
    {
        $dto = new CreateProjectDTO();
        $dto->name = "Nicolas";

        $project = $handler->handle($dto);

        return new JsonResponse([
            'id' => $project->getId(),
            'name' => $project->getName(),
        ]);
    }

    #[Route('/project/delete', name: 'app_project_delete', methods: ['GET'])]
    public function delete(Request $request, DeleteProjectHandler $handler): JsonResponse
    {
        $projectId = 2;
        $handler->handle($projectId);

        return new JsonResponse(['status' => 'Project deleted']);
    }
}
