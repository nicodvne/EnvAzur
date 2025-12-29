<?php

namespace Infrastructure\Symfony\Controller;

use Application\DTO\Project\CreateProjectDTO;
use Application\Service\ApiResponse;
use Application\UseCase\Project\CreateProjectHandler;
use Application\UseCase\Project\DeleteProjectHandler;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectController extends AbstractController
{

    public function __construct(
        private CreateProjectHandler $createProjectHandler,
        private DeleteProjectHandler $deleteProjectHandler,
        private ApiResponse $apiResponse,
    ){}

    #[Route('/project/create', name: 'app_project_create', methods: ['POST'])]
    public function createAction(Request $request): JsonResponse 
    {
        $dto = new CreateProjectDTO();
        $payload = $request->getPayload();

        if (!$payload->has('projectName') || !$payload->has('projectSlug')) {
            return $this->apiResponse->error('Missing required datas', 400);
        }

        $dto->name = $payload->get('projectName');
        $dto->slug = $payload->get('projectSlug');
        $dto->description = $payload->get('projectDescription') ?? null;

        try {
            $project = $this->createProjectHandler->handle($dto);

            return $this->apiResponse->success([
                'id' => $project->getId(),
                'name' => $project->getName(),
                'slug' => $project->getSlug(),
                'description' => $project->getDescription(),
            ]);
        } catch (UniqueConstraintViolationException $e) {
            return $this->apiResponse->error('Project with this slug already exists', false, 409);
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), false, 500);
        }
    }

    #[Route('/project/delete', name: 'app_project_delete', methods: ['DELETE'])]
    public function delete(Request $request): JsonResponse
    {
        $payload = $request->getPayload();
        $projectSlug = $payload->get('projectSlug');

        try {
            $this->deleteProjectHandler->handle($projectSlug);

            return $this->apiResponse->success(['status' => 'Project deleted']);
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), false, 500);
        }
    }
}
