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
    public function __construct($value, array $choices)
    {
        $this->valueList = $choices;
        $value           = $this->mutate($value);
        if (!$this->isDefined($value)) {
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
        return new static($value, static::$choices);
    }

    /**
     * @return static
     */
    public static function getEmptyInstance()
    {
        return static::constructWoValue(static::$choices);
    }
    
    /**
     * @param mixed $value
     * @return string
     * @Override
     */
    protected function mutate($value)
    {
        return (string) $value;
    }

    /**
     * @param array $choices
     * @return static
     */
    protected static function constructWoValue(array $choices)
    {
        $r = new \ReflectionClass(get_called_class());
        /** @var static $self */
        $self            = $r->newInstanceWithoutConstructor();
        $self->valueList = $choices;

        return $self;
    }

    /**
     * @return array
     */
    public function choices()
    {
        return $this->valueList;
    }

    /**
     * @return array
     */
    public function flipped()
    {
        return $this->flip($this->valueList);
    }

    /**
     * @param array $choices
     * @return array
     */
    protected function flip(array $choices)
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
    public function is($value)
    {
        return $this->value === (string)$value;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function isDefined($value)
    {
        return array_key_exists($value, $this->valueList);
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
        return (string) $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value();
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
        // search value as $choices's key. 
        if (array_key_exists($label, static::$choices)) {
            return $label;
        }
        // search value as $choices's array. 
        if (in_array($label, static::$choices, true)) {
            foreach(static::$choices as $value => $choice) {
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
        throw new \InvalidArgumentException("no such value for: ".$label);
    }
}