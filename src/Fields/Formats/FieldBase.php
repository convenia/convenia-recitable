<?php

namespace Convenia\PayrollFileReader\Fields\Formats;

use Convenia\PayrollFileReader\Interfaces\FieldInterface;
use Stringy\Stringy;

/**
 * Class Field.
 */
abstract class FieldBase implements FieldInterface
{
    /**
     * @var \Stringy\Stringy
     */
    protected $value;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var int
     */
    protected $length;

    /**
     * Field constructor.
     *
     * @param $value
     */
    public function __construct($value = null)
    {
        $this->setValue($value);
    }

    /**
     * @param $value
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = Stringy::create($value);

        return $this;
    }

    /**
     * Return the formatted value.
     *
     * @param string $case
     * @return string
     */
    public function getValue($case = 'title')
    {
        return (string) $this->format($case);
    }

    /**
     * @param int $length
     *
     * @return $this
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }

    public function getStringFormatedTitleCase()
    {
        return $this->getValue('title');

    }

    public function getStringFormatedUpperCase()
    {
        return $this->getValue('upper');
    }
}
