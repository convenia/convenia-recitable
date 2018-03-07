<?php
namespace Convenia\PayrollFileReader\Patterns;

use Convenia\PayrollFileReader\Exceptions\FieldNotExistsException;
use Convenia\PayrollFileReader\Exceptions\RegistryTooLongException;
use Convenia\PayrollFileReader\Exceptions\RegistryTooShortException;
use Convenia\PayrollFileReader\Fields\Formats\FieldBase;
use Convenia\PayrollFileReader\Fields\Validations\ValidationDefault;
use Stringy\Stringy;

abstract class PatternBase
{
    /**
     * Total length.
     *
     * @var int
     */
    protected $length = 400;

    /**
     * Final string.
     *
     * @var string
     */
    protected $resultString;

    /**
     * Registry type.
     *
     * @var int
     */
    protected $type;

    /**
     * List of fields and his types.
     *
     * @var array
     */
    protected $defaultFields = [];

    /**
     * @var array
     */
    protected $values = [];

    /**
     * @var ValidationDefault
     */
    protected $validator;

    /**
     * PatternBase constructor.
     * @param array $fields
     * @throws FieldNotExistsException
     * @throws RegistryTooLongException
     * @throws RegistryTooShortException
     */
    public function __construct(array $fields = [])
    {
        $this->validator = new ValidationDefault();
        $this->validator->make($this->defaultFields);

        $this->fill();

        foreach ($fields as $field => $value) {
            if (array_key_exists($field, $this->defaultFields) === false) {
                throw new FieldNotExistsException($field);
            }

            $this->values[$field]->setValue($value);
        }

        try {
            $this->validator->validate($fields);
        } catch (\Exception $e) {
            new RegistryTooShortException($e->getMessage().'in registry '.get_class());
        }

        $this->generate();
        $this->validateLength();
    }

    /**
     * Fill the $values array with default and required values.
     */
    protected function fill()
    {
        array_map(function ($field) {
            $defaultValue = isset($this->defaultFields[$field]['defaultValue']) ?
                $this->defaultFields[$field]['defaultValue'] :
                null;

            $this->values[$field] = (new $this->defaultFields[$field]['format']($defaultValue))
                ->setPosition($this->defaultFields[$field]['position'])
                ->setLength($this->defaultFields[$field]['length']);
        }, array_keys($this->defaultFields));
    }

    /**
     * Generate the full registry string.
     *
     * @return string
     */
    protected function generate()
    {
        $this->resultString = Stringy::create('');

        foreach ($this->values as $valueClass) {
            $this->resultString = $this->resultString->append($valueClass->getValue());
        }

        return (string) $this->resultString;
    }

    /**
     * Validate if the generated result string matches the length.
     *
     * @throws RegistryTooLongException
     * @throws RegistryTooShortException
     *
     * @return bool
     */
    public function validateLength()
    {
        $resultLength = strlen($this->generate());

        if ($resultLength > $this->length) {
            throw new RegistryTooLongException($resultLength);
        }

        if ($resultLength < $this->length) {
            throw new RegistryTooShortException($resultLength);
        }

        return true;
    }

    /**
     * @param $fieldName
     *
     * @return FieldBase
     */
    public function getField($fieldName)
    {
        return $this->values[$fieldName];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->generate();
    }
}