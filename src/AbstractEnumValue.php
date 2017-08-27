<?php
namespace WScore\Enum;

abstract class AbstractEnumValue implements EnumInterface
{
    /**
     * @Override
     * @var array
     */
    protected $choices = [];

    /**
     * @var string
     */
    protected $value;

    /**
     * TaskStatus constructor.
     *
     * @param string $value
     * @param array  $choices
     */
    public function __construct($value, array $choices)
    {
        $this->choices = $choices;
        $value = $this->mutate($value);
        if (!static::isDefined($value)) {
            throw new \InvalidArgumentException(get_called_class() . ' has no such value: ' . $value);
        }
        $this->value = $value;
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
     * @return array
     */
    public function choices()
    {
        return $this->choices;
    }

    /**
     * @return array
     */
    public function flipped()
    {
        return $this->flip($this->choices);
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
        return array_key_exists($value, $this->choices);
    }
    
    /**
     * @return string
     */
    public function label()
    {
        return $this->choices[$this->value];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

}