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
            new TwigFilter('formatTableData', [$this, 'formatTableData']),
        ];
    }

    public function formatSexe(string $text)
    {
        return $text == 'M' ? 'Mr.' : 'Mme.';
    }

    public function formatTableData(array $array)
    {
        foreach ($array as $item){
            dump($item);
        }
        return json_encode($array);
    }

}