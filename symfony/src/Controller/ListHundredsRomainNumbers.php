<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\GetRomanNumberCachedResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListHundredsRomainNumbers
{
    private $logger;
    private $romanNumberCachedResponse;

    public function __construct(LoggerInterface $logger, GetRomanNumberCachedResponse $romanNumberCachedResponse)
    {
        $this->logger = $logger;
        $this->romanNumberCachedResponse = $romanNumberCachedResponse;
    }

    /**
     * @Route("/list-hundreds-roman-number", name="listHundredsRomanNumber")
     */
    public function __invoke(): JsonResponse
    {
        $response = [];
        try {
            $response = $this->romanNumberCachedResponse->getRomanNumberFromStartToLimit(
                1,
                10,
                1,
                'get-hundreds-roman'
            );
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }

        return new JsonResponse($response);
    }
}
