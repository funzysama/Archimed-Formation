<?php


namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class twigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('formatSexe', [$this, 'formatSexe']),
        ];
    }

    public function formatSexe(string $text)
    {
        return $text == 'M' ? 'Mr' : 'Mme';
    }

}