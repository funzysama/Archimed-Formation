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
            new TwigFilter('initial', [$this, 'get_initial_filter']),
            new TwigFilter('minimize', [$this, 'minimize_text']),
        ];
    }

    public function formatSexe(string $text)
    {
        return $text == 'M' ? 'Mr.' : 'Mme.';
    }

    public function formatAge($date)
    {
        if (!$date instanceof \DateTime) {
            return null;
        }
        $referenceDate = date('01-01-Y');
        $referenceDateTimeObject = new \DateTime($referenceDate);
        $diff = $referenceDateTimeObject->diff($date);
        return $diff->y;
    }

    function get_initial_filter($source)
    {
        if($source != null) {
            return $source[0];
        }
        return '';
    }

    function minimize_text($source)
    {
        if($source != null) {
            return strtolower($source);
        }
        return '';
    }

}