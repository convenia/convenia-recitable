<?php

namespace Convenia\PayrollFileReader\Fields\Formats;


class FieldS extends FieldBase
{
    /**
     * Return the formatted field.
     *
     * @return string
     */
    public function format()
    {
        $this->value = $this->value->slugify(' ')->toTitleCase();
        $actualLength = $this->value->length();
        $this->value = $this->value->truncate($this->getLength());

        if ($actualLength < $this->getLength()) {
            $this->value = $this->value->padRight($this->getLength());
        }

        return $this->value;
    }
}
