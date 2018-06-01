<?php
namespace Application\View\Helper;


use IntlDateFormatter;
use Zend\I18n\View\Helper\DateFormat;

class Date extends DateFormat
{
    public function __invoke()
    {
        return $this;
    }

    public function dateFormat($date, $dateType = IntlDateFormatter::NONE, $timeType = IntlDateFormatter::NONE, $locale = null, $pattern = null)
    {
        $locale = 'vi_VN';
        $pattern = 'dd/MM./Y';

        return parent::__invoke(new \DateTime($date), $dateType, $timeType, $locale, $pattern);
    }

    public function dateTimeFormat($date, $dateType = IntlDateFormatter::MEDIUM, $timeType = IntlDateFormatter::MEDIUM, $locale = null, $pattern = null)
    {
        $locale = 'vi_VN';
        $pattern = 'dd/MM/Y HH:mm:ss';

        return parent::__invoke(new \DateTime($date), $dateType, $timeType, $locale, $pattern);
    }

}