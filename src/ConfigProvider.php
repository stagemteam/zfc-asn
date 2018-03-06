<?php
/**
 * ASN object
 *
 * @category Stagem
 * @package Stagem_ZfcAsn
 * @author Kozak Vlad <vlad.gem.typ@gmail.com>
 * @datetime: 20.02.18 21:16
 */

namespace Stagem\ZfcAsn;

class ConfigProvider
{
    public function __invoke()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}