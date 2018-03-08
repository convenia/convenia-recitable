<?php

namespace Convenia\PayrollFileReader\Fields\Formats;


class FieldC extends FieldBase
{
    /**
     * Return the formatted field.
     *
     * @param string $case
     * @return string
     */
    public function format($case = 'title')
    {
        $this->value = $this->value->slugify(' ');
        if(strcmp($case, 'title')) {
            $this->value = $this->value->toTitleCase();
        }
        if(strcmp($case, 'upper')) {
            $this->value = $this->value->toUpperCase();
        }

        $actualLength = $this->value->length();
        $this->value = $this->value->truncate($this->getLength());

        if ($actualLength < $this->getLength()) {
            $this->value = $this->value->padRight($this->getLength());
        }

        return $this->value;
    }
}
