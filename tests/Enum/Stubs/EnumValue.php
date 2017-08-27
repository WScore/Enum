<?php
namespace Tests\Enum\Stubs;

use WScore\Enum\AbstractEnumList;
use WScore\Enum\Enum;

class EnumValue extends AbstractEnumList
{
    const ENUM = 'enum';
    const VALUE = 'value';
    
    protected static $choices = [
        self::ENUM => 'enumerated',
        self::VALUE => 'value',
    ];

    /**
     * @param string $value
     * @return Enum
     */
    public static function getEnum($value)
    {
        $choices = self::$choices;
        unset($choices[self::VALUE]);
        return new Enum($value, $choices);
    }
}