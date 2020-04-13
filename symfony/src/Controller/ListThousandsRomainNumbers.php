<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\GetRomanNumberCachedResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListThousandsRomainNumbers
{
    private $logger;
    private $romanNumberCachedResponse;

    public function __construct(LoggerInterface $logger, GetRomanNumberCachedResponse $romanNumberCachedResponse)
    {
        $this->logger = $logger;
        $this->romanNumberCachedResponse = $romanNumberCachedResponse;
    }

    /**
     * @Route("/list-thousands-roman-number", name="listThousandsRomanNumber")
     */
    public function __invoke(): JsonResponse
    {
        $response = [];
        try {
            $response = $this->romanNumberCachedResponse->getRomanNumberFromStartToLimit(
                1000,
                1000000,
                1000,
                'get-thousands-roman'
            );
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }

        return new JsonResponse($response);
    }
}
