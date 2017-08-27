<?php
namespace WScore\Enum;

abstract class AbstractEnumList implements EnumListInterface
{
    /**
     * @Override
     * @var array
     */
    protected static $choices = [];

    /**
     * @param string $value
     * @return EnumInterface
     */
    public static function enum($value)
    {
        return new Enum($value, static::$choices);
    }

    /**
     * @return array
     */
    public static function choices()
    {
        return static::$choices;
    }

    /**
     * @return array
     */
    public static function flipped()
    {
        return static::flip(static::$choices);
    }

    /**
     * @param array $choices
     * @return array
     */
    protected static function flip(array $choices)
    {
        $flipped = [];
        foreach($choices as $key => $label) {
            $flipped[$label] = (string) $key;
        }
        return $flipped;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isDefined($value)
    {
        return array_key_exists($value, static::$choices);
    }

    /**
     * 文字列から値を取得する。
     * コンスタント名、値、そして名称から検索する。
     *
     * @param string $label
     * @return int|string
     */
    public static function findValue($label)
    {
        $const = "static::{$label}";
        if (defined($const)) {
            return constant($const);
        }
        elseif (in_array($label, static::$choices, true)) {
            foreach(static::$choices as $value => $choice) {
                if ($choice === $label) {
                    return $value;
                }
            }
        }
        $constants = (new \ReflectionClass(get_called_class()))->getConstants();
        foreach($constants as $value => $choice) {
            if ($choice === $label) {
                return $choice;
            }
        }
        throw new \InvalidArgumentException("no such value for: ".$label);
    }
}