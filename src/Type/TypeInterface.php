<?php

namespace MASNathan\Parser\Type;

interface TypeInterface
{

    public static function encode($string);

    public static function decode($string);
}
