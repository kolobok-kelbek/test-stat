<?php

declare(strict_types=1);

namespace App\Controller\OpenApi\Statistic;

use App\Statistic\Repository;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Аннотация, потому что с аттрибутом не получись сделать....
 * @OA\Response(
 *     response=200,
 *     description="Get statistic by countries",
 *     @OA\JsonContent(
 *              type="object",
 *              example={
 *                    "ru": 12,
 *                    "en": 1,
 *             }
 *          ),
 *  )
 */
#[OA\Tag(['name' => 'Statistic by countries'])]
#[Route('/statistic', name: 'get_statistic', methods: [Request::METHOD_GET])]
class Get
{
    public function __construct(
        private readonly Repository $statisticRepository,
    ) {
    }

    public function __invoke(): array
    {
        return $this->statisticRepository->getAll();
    }
}
