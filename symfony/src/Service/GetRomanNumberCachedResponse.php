<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Contracts\Cache\CacheInterface;

class GetRomanNumberCachedResponse
{
    private $arrayRomanNumbersFromStartToLimit;
    private $stopwatch;
    private $cache;
    private $start;
    private $limit;
    private $step;

    public function __construct(GetArrayRomanNumbersFromStartToLimit $getArrayRomanNumbersFromStartToLimit, Stopwatch $stopwatch, CacheInterface $cache)
    {
        $this->arrayRomanNumbersFromStartToLimit = $getArrayRomanNumbersFromStartToLimit;
        $this->stopwatch = $stopwatch;
        $this->cache = $cache;
        $this->start = 1;
        $this->limit = 1000;
        $this->step = 1;
    }

    public function getRomanNumberFromStartToLimit(int $start, int $limit, int $step, string $cacheName): ?array
    {
        $this->stopwatch->start($cacheName);
        $this->start = $start;
        $this->limit = $limit;
        $this->step = $step;

        $cachedResponse = $this->cache->get($cacheName, function () {
            return $this->arrayRomanNumbersFromStartToLimit->createArrayConvertedNumber($this->start, $this->limit, $this->step);
        });

        $this->stopwatch->stop($cacheName);

        return  $cachedResponse;
    }
}
