<?php
namespace WScore\Enum;

interface EnumInterface
{
    // ------------------------------------------------------------------------
    // static methods
    // ------------------------------------------------------------------------
    /**
     * @param string $value
     * @return static
     */
    public static function enum($value);

    /**
     * @return array
     */
    public static function choices();

    /**
     * @return array
     */
    public static function flipped();

    /**
     * @param array $choices
     * @return array
     */
    public static function flip(array $choices);

    /**
     * @param string $value
     * @return bool
     */
    public static function isDefined($value);

    // ------------------------------------------------------------------------
    // instance methods
    // ------------------------------------------------------------------------
    /**
     * @param string $value
     * @return bool
     */
    public function is($value);

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