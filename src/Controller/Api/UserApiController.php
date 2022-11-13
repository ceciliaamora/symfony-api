<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserApiController extends AbstractController
{
    public function __construct(
        private UserRepository $repository,
        private SerializerInterface $serializer,
    )
    {
    }

    public function getList(): Response
    {
        $users = $this->repository->findAll();
        $json = $this->serializer->serialize($users, 'json');

        return new Response($json);
    }


    public function getOne(string $id): Response
    {
        $user = $this->repository->find($id);

        if(!$user) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new Response (
            $this->serializer->serialize($user, 'json')
        );
    }

    public function create(Request $request): Response
    {
        $user = $this->serializer->deserialize(
            $request->getContent(),
            User::class,
            'json'
        );

        // $user->setPassword(password_hash($user->password, PASSWORD_ARGON2I));

        $updated = $this->repository->save($user, true);

        return new JsonResponse([]);
    }

    public function delete(string $id): JsonResponse
    {
        $user = $this->repository->find($id);

        $this->repository->remove($user, true);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    public function update(string $id, Request $request): JsonResponse
    {
        $user = $this->repository->find($id);
        $body = json_decode($request->getContent());

        empty($body->name) ? true : $user->setName($body->name);
        empty($body->cpf) ? true : $user->setCpf($body->cpf);
        empty($body->email) ? true : $user->setEmail($body->email);
        empty($body->password) ? true : $user->setPassword($body->password);

        $updatedUser = $this->repository->updateUser($user);

        return new JsonResponse([$updatedUser],
        Response::HTTP_OK);
    }
}