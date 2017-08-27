<?php
namespace WScore\Enum;

interface EnumListInterface
{
    /**
     * @param string $value
     * @return EnumInterface
     */
    public static function enum($value);

    /**
     * @return array
     */
    public static function flipped();

    /**
     * @return array
     */
    public static function choices();

    /**
     * @param string $value
     * @return bool
     */
    public static function isDefined($value);
}