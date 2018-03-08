<?php

namespace Convenia\PayrollFileReader\Fields\Formats;


class FieldN extends FieldBase
{
    /**
     * Return the formatted field.
     *
     * @param string $case
     * @return string
     */
    public function format($case = null)
    {
        $this->value = $this->value->trim();
        $actualLength = $this->value->length();

        $this->value = $this->value->replace(',', '');
        $this->value = $this->value->replace('.', '');
        $this->value = $this->value->replace('-', '');
        $this->value = $this->value->replace('/', '');
        $this->value = $this->value->replace('_', '');

        $this->value = $this->value->truncate($this->getLength());

        if ($actualLength < $this->getLength()) {
            $this->value = $this->value->padLeft($this->getLength(), 0);
        }

        return $this->value;
    }
}
