<?php

declare(strict_types=1);

namespace App\Service;

class FindNumberClosest
{
    public function getKeyNumberClosestAndSmallest(int $number, array $array): ?int
    {
        $closest = null;
        foreach ($array as $key => $value) {
            if (null === $closest || $this->isBiggerThan($number, $key, $closest) && $key <= $number) {
                $closest = $key;
            }
        }

        return $closest;
    }

    private function isBiggerThan(int $number, int $key, int $closest = null): bool
    {
        if (null === $closest) {
            $closest = 0;
        }

        return abs($number - $closest) > abs($key - $number);
    }
}
