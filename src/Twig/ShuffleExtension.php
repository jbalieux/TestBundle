<?php

namespace Senapi\TestBundle\Twig;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ShuffleExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('shuffle', [$this, 'shuffle']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('shuffle', [$this, 'shuffle']),
        ];
    }

    public function shuffle($values)
    {
        switch ($values) {
            case $values instanceof Collection:
                return $this->shuffleCollection($values);
            case is_array($values):
                return $this->shuffleArray($values);
            default:
                throw new \Exception("shuffle doesn't support this type");
        }
    }

    private function shuffleCollection(Collection $collection): ArrayCollection
    {
        $array = $collection->toArray();
        return new ArrayCollection($this->shuffleArray($array));
    }

    private function shuffleArray(array $array): array
    {
        shuffle($array);
        return $array;
    }
}
