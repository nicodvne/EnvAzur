<?php

namespace Infrastructure\Symfony\Controller;

use Application\Service\ApiResponse;
use Application\Service\User\UserService;
use Application\UseCase\User\CreateUserHandler;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController {

    public function __construct(
        private ApiResponse $apiResponse,
        private UserService $userService,
        private CreateUserHandler $createUserHandler
    ) {}

    #[Route('/user/create', name: 'app_user_create', methods: ['POST'])]
    public function createUser(Request $request): JsonResponse
    {
        $payload = $request->getPayload();

        if (!$this->userService->createRequestHasRequiredData($payload->all())) {
            return $this->apiResponse->error('Missing required datas', 400);
        }

        try {
            $dto = $this->userService->buildUserDTO($payload->all());
            $createdUser = $this->createUserHandler->handle($dto);

            return $this->apiResponse->success([
                'email' => $createdUser->getEmail(),
                'username' => $createdUser->getUsername()
            ]);
        } catch (UniqueConstraintViolationException $e) {
            if (str_contains($e->getMessage(), 'email')) {
                return $this->apiResponse->error('Email already exists', 400);
            } else {
                return $this->apiResponse->error('Username already exists', 400);
            }
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), false, 500);
        }
    }

    #[Route('/user/password/check', name: 'app_user_password_check', methods: ['POST'])]
    public function passwordCheck(Request $request): JsonResponse
    {
        $payload = $request->getPayload();

        if (!$this->userService->checkPasswordRequestHasRequiredData($payload->all())) {
            return $this->apiResponse->error('Missing required datas', 400);
        }

        try {
            $isCorrectPassword = $this->userService->verifyPassword($payload->all());

            if ($isCorrectPassword) {
                return $this->apiResponse->success(['status' => 'Password correct']);
            } else {
                return $this->apiResponse->error('Password incorrect', 400);
            }
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), false, 500);
        }
    }
}
