<?php

namespace Infrastructure\Symfony\Controller;

use Application\Service\ApiResponse;
use Application\Service\Variable\VariableService;
use Application\UseCase\Variable\CreateVariableHandler;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class VariableController extends AbstractController 
{

    public function __construct(
        private ApiResponse $apiResponse,
        private VariableService $variableService,
        private CreateVariableHandler $createVariableHandler
    ){}

    #[Route('/variable/create', name: 'app_variable_create', methods: ['POST'])]
    public function createAction(Request $request): JsonResponse
    {
        if ($this->variableService->requestHasRequiredData($request)) {
            return $this->apiResponse->error('Missing required datas', 400);
        }

        try {
            $payload = $request->getPayload();
            $dto = $this->variableService->buildVariableDTO($payload->all());
            $variable = $this->createVariableHandler->handle($dto);

            return $this->apiResponse->success([
                'varKey' => $variable->getVarKey(),
                'projectSlug' => $variable->getProject()->getSlug()
            ]);
        } catch (UniqueConstraintViolationException $e) {
            return $this->apiResponse->error('Project with this slug already exists', false, 409);
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), false, 500);
        }
    } 
}
