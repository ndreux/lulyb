<?php
/**
 * Created by PhpStorm.
 * User: ndreux
 * Date: 01/06/2018
 * Time: 15:39
 */

namespace Bully\Utils;


class Logger
{
    public static function log($message, $args = null, $_ = null)
    {
        echo sprintf($message, $args, $_) . "\n";
    }
}