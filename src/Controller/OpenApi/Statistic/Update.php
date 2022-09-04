<?php

declare(strict_types=1);

namespace App\Controller\OpenApi\Statistic;

use App\Statistic\Repository;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[OA\Response([
    'response' => Response::HTTP_NO_CONTENT,
    'description' => 'Update statistic',
])]
#[OA\Parameter([
    'name' => 'countryCode',
    'in' => 'path',
    'description' => 'Country code in the Alpha-2 code (ISO_3166-1) format . [Больше информации о кодах](https://en.wikipedia.org/wiki/ISO_3166-1#Current_codes).',
    'schema' => new OA\Schema(['type' => 'string']),
])]
#[OA\Tag(['name' => 'Statistic by countries'])]
#[Route('/statistic/{countryCode}', name: 'update_statistic', methods: [Request::METHOD_PUT])]
class Update
{
    public function __construct(
        private readonly Repository $statisticRepository,
        private readonly ValidatorInterface $validator,
    ) {
    }

    public function __invoke(string $countryCode): void
    {
//        $errors = $this->validator->validate($countryCode, new Assert\Country()); // тут ошибка, не разобрался как справиться - "Attempted to load class \"Locale\" from the global namespace.\nDid you forget a \"use\" statement for \"Symfony\\Component\\Validator\\Constraints\\Locale\"?

        // поставил хоть какую-то валидацию
        $errors = $this->validator->validate($countryCode, [
            new Assert\Length(min: 2, max: 2),
        ]);

        if (!$errors->count()) {
            /** @var ConstraintViolationInterface $error */
            foreach ($errors as $error) {
                throw new BadRequestHttpException($error->getMessage());
            }
        }

        $this->statisticRepository->update($countryCode);
    }
}
