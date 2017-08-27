<?php
namespace WScore\Enum;

interface EnumInterface
{
    /**
     * @return array
     */
    public function flipped();

    /**
     * @return array
     */
    public function choices();

    /**
     * @param string $value
     * @return bool
     */
    public function isDefined($value);

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
    public function __toString();
}