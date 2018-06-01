<?php
/**
 * Created by PhpStorm.
 * User: tri.le
 * Date: 4/1/2015
 * Time: 2:52 PM
 */

namespace Application\View\Helper;

use Zend\I18n\View\Helper\CurrencyFormat;
use Zend\View\Helper\AbstractHelper;

class Currency extends CurrencyFormat
{
    public function __invoke(
        $number,
        $currencyCode = null,
        $showDecimals = null,
        $locale = null,
        $pattern = null
    ) {
        $currencyCode = 'VND';
        $showDecimals = false;
        $locale = 'vi_VN';
        $pattern = '#,##0 ';
        $currencyStr = parent::__invoke($number, $currencyCode, $showDecimals, $locale, $pattern);

        return $currencyStr;
    }
}