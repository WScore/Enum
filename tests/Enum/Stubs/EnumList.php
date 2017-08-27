<?php
namespace Tests\Enum\Stubs;

use WScore\Enum\AbstractEnum;

class EnumList extends AbstractEnum
{
    const ENUM = 'enum';
    const VALUE = 'value';
    
    protected static $choices = [
        self::ENUM => 'enumerated',
        self::VALUE => 'value',
    ];

    /**
     * @param string $value
     * @return EnumList
     */
    public static function getEnum($value)
    {
        $choices = self::$choices;
        unset($choices[self::VALUE]);
        return new EnumList($value, $choices);
    }

    /**
     * @return bool
     */
    public function isEnum()
    {
        return $this->is(EnumList::ENUM);
    }
}