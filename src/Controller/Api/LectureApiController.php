<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Lecture;
use App\Repository\LectureRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class LectureApiController extends AbstractController
{
    public function __construct(
        private LectureRepository $repository,
        private EventRepository $eventRepository,
        private SerializerInterface $serializer,
    )    {
    }

    public function getList():Response
    {
        $lectures = $this->repository->findAll();
        $json = $this->serializer->serialize($lectures, 'json');

        return new Response($json);
    }

    public function getOne(string $id): Response
    {
        $lecture = $this->repository->find($id);

        if(!$lecture) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new Response (
            $this->serializer->serialize($lecture, 'json')
        );
    }

    public function create(Request $request): Response
    {
        $lecture = $this->serializer->deserialize(
            $request->getContent(),
            Lecture::class,
            'json'
        );

        $body = json_decode($request->getContent());

        $event = $this->eventRepository->find(
            $body->event
        );

        $lecture->setEventId($event);


        $this->repository->save($lecture, true);

        return new Response(
            $this->serializer->serialize($lecture, 'json')
        );    
    }

    public function delete(string $id): JsonResponse
    {
        $lecture = $this->repository->find($id);

        $this->repository->remove($lecture, true);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    public function update(string $id, Request $request): JsonResponse
    {
        $lecture = $this->repository->find($id);
        $body = json_decode($request->getContent());

        empty($body->title) ? true : $lecture->setTitle($body->title);
        empty($body->date) ? true : $lecture->setDate($body->date);
        empty($body->start_time) ? true : $lecture->setStartTime($body->start_time);
        empty($body->end_time) ? true : $lecture->setEndTime($body->end_time);
        empty($body->description) ? true : $lecture->setDescription($body->description);

        $updatedLecture = $this->repository->updateLecture($lecture);

        return new JsonResponse([$updatedLecture],
        Response::HTTP_OK);
    }
}