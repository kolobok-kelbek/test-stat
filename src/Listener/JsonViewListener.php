<?php

declare(strict_types=1);

namespace App\Listener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;

#[AsEventListener]
class JsonViewListener
{
    public function __invoke(ViewEvent $event): void
    {
        $value = $event->getControllerResult();

        if ($value instanceof Response) {
            return;
        }

        if (is_int($value)) {
            $event->setResponse(new Response(status: $value));

            return;
        }

        if ($value === null) {
            $event->setResponse(new Response(status: Response::HTTP_NO_CONTENT));

            return;
        }

        $event->setResponse(new JsonResponse($value));
    }
}