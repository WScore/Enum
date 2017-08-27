<?php
namespace Tests\Enum\Stubs;

use WScore\Enum\AbstractEnumList;

class EnumList extends AbstractEnumList
{
    const ENUM = 'enum';
    const VALUE = 'value';
    
    protected static $choices = [
        self::ENUM => 'enumerated',
        self::VALUE => 'value',
    ];

    /**
     * @param string $value
     * @return EnumVal
     */
    public static function getEnum($value)
    {
        $choices = self::$choices;
        unset($choices[self::VALUE]);
        return new EnumVal($value, $choices);
    }
}