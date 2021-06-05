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
            new TwigFilter('base64', [$this, 'twig_base64_filter']),
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

    function twig_base64_filter($source)
    {
        dump($source);
        if($source != null) {
            return base64_encode(stream_get_contents($source));
        }
        return '';
    }

}