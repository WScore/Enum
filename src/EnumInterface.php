<?php
namespace WScore\Enum;

interface EnumInterface
{
    /**
     * @param string $value
     * @return static
     */
    public static function enum($value);

    /**
     * @return static
     */
    public static function getEmptyInstance();

    /**
     * @return array
     */
    public function choices();

    /**
     * @return array
     */
    public function flipped();

    /**
     * @param string $value
     * @return bool
     */
    public function is($value);

    /**
     * @param string $value
     * @return bool
     */
    public function isDefined($value);

    /**
     * @return string
     */
    public function label();

    /**
     * @return string
     */
    public function value();

    /**
     * @return string
     */
    public function __toString();
}