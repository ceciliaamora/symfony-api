<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EventApiController extends AbstractController
{
    public function __construct(
        private EventRepository $repository,
        private SerializerInterface $serializer,
    )    {
    }

    public function getList():Response
    {
        $events = $this->repository->findAll();
        $json = $this->serializer->serialize($events, 'json');

        return new Response($json);
    }

    public function getOne(string $id): Response
    {
        $event = $this->repository->find($id);

        if(!$event) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new Response (
            $this->serializer->serialize($event, 'json')
        );
    }

    public function create(Request $request, ValidatorInterface $validator): Response
    {
        $event = $this->serializer->deserialize(
            $request->getContent(),
            Event::class,
            'json'
        );

        $errors = $validator->validate($event);

        if (count($errors) > 0) {
            // $errorsString = (string) $errors;
            return new Response('Por favor insira uma opção válida para o status. Opções: Agendado, Acontecendo, Finalizado, Cancelado.');
        }

        $this->repository->save($event, true);

        return new JsonResponse([]);
    }

    public function delete(string $id): JsonResponse
    {
        $event = $this->repository->find($id);

        $this->repository->remove($event, true);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    public function update(string $id, Request $request, ValidatorInterface $validator): JsonResponse
    {
        $event = $this->repository->find($id);
        $body = json_decode($request->getContent());

        $errors = $validator->validate($body);

        if (count($errors) > 0) {
            return new Response('Por favor insira uma opção válida para o status. Opções: Agendado, Acontecendo, Finalizado, Cancelado.');
        }

        empty($body->title) ? true : $event->setTitle($body->title);
        empty($body->description) ? true : $event->setDescription($body->description);
        empty($body->startDateTime) ? true : $event->setStartDateTime($body->startDateTime);
        empty($body->endDateTime) ? true : $event->setEndDateTime($body->endDateTime);
        empty($body->status) ? true : $event->setStatus($body->status);

        $updatedEvent = $this->repository->updateEvent($event);

        return new JsonResponse([$updatedEvent],
        Response::HTTP_OK);
    }
}