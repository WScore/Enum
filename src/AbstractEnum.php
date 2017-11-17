<?php
namespace WScore\Enum;

abstract class AbstractEnum implements EnumInterface
{
    /**
     * @Override
     * @var array
     */
    protected static $choices = [];

    /**
     * @Override
     * @var array
     */
    private $valueList = [];

    /**
     * @var string
     */
    private $value;

    /**
     * TaskStatus constructor.
     *
     * @param string $value
     * @param array  $choices
     */
    public function __construct($value, array $choices = [])
    {
        $this->valueList = $choices ?: static::choices();
        $value           = $this->mutate($value);
        if (!isset($this->valueList[$value])) {
            throw new \InvalidArgumentException(get_called_class() . ' has no such value: ' . $value);
        }
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return static
     */
    public static function enum($value)
    {
        return new static($value, static::choices());
    }

    /**
     * @param mixed $value
     * @return string
     * @Override
     */
    protected function mutate($value)
    {
        return (string)$value;
    }

    /**
     * @return array
     */
    public static function choices()
    {
        return static::$choices;
    }

    /**
     * @param string $method
     * @return array
     */
    public static function flipped($method = 'choices')
    {
        return self::flip(static::$method());
    }

    /**
     * @param string $method
     * @return array
     */
    public static function keys($method = 'choices')
    {
        return array_keys(static::$method());
    }

    /**
     * @param array $choices
     * @return array
     */
    public static function flip(array $choices)
    {
        $flipped = [];
        foreach ($choices as $key => $label) {
            $flipped[$label] = (string)$key;
        }

        return $flipped;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function is($value)
    {
        return $this->value === $this->mutate($value);
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isDefined($value)
    {
        return array_key_exists($value, self::choices());
    }

    /**
     * @return string
     */
    public function label()
    {
        return $this->valueList[$this->value];
    }

    /**
     * @return string
     */
    public function value()
    {
        return (string)$this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }

    /**
     * find value from a string.
     * searches for: key of static::$choices, value of static::$choices, and constant name.
     *
     * @param string $label
     * @return int|string
     */
    public static function findValue($label)
    {
        // search value as $choices's key. 
        if (array_key_exists($label, static::choices())) {
            return $label;
        }
        // search value as $choices's array. 
        if (in_array($label, static::choices(), true)) {
            foreach (static::choices() as $value => $choice) {
                if ($choice === $label) {
                    return $value;
                }
            }
        }
        // maybe $label is the constant name. 
        $const = "static::{$label}";
        if (defined($const)) {
            return constant($const);
        }
        throw new \InvalidArgumentException("no such value for: " . $label);
    }
}