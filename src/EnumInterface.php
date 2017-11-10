<?php
namespace WScore\Enum;

interface EnumInterface
{
    // ------------------------------------------------------------------------
    // static methods
    // ------------------------------------------------------------------------
    /**
     * a factory method for the enumerated class.
     *
     * @param string $value
     * @return static
     */
    public static function enum($value);

    /**
     * returns list of enumerated values as defined by static::$choices.
     *
     * @return array
     */
    public static function choices();

    /**
     * returns flipped array of choices(), i.e. keys and values are flipped.
     *
     * @param string $method
     * @return array
     */
    public static function flipped($method = 'choices');

    /**
     * returns keys of choices().
     *
     * @param string $method
     * @return array
     */
    public static function keys($method = 'choices');

    /**
     * flips keys and values for an array.
     *
     * @param array $choices
     * @return array
     */
    public static function flip(array $choices);

    /**
     * returns if $value is defined in the static::$choices.
     *
     * @param string $value
     * @return bool
     */
    public static function isDefined($value);

    // ------------------------------------------------------------------------
    // instance methods
    // ------------------------------------------------------------------------
    /**
     * returns if the enum object IS the value.
     *
     * @param string $value
     * @return bool
     */
    public function is($value);

    /**
     * returns the label of the enum object using static::$choices.
     *
     * @return string
     */
    public function label();

    /**
     * returns the value of the enum object.
     *
     * @return string
     */
    public function value();

    /**
     * returns the value of the enum object. same as value().
     *
     * @return string
     */
    public function __toString();
}