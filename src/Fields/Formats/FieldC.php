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
        $this->stringCase($case);

        $actualLength = $this->value->length();
        $this->value = $this->value->truncate($this->getLength());

        if ($actualLength < $this->getLength()) {
            $this->value = $this->value->padRight($this->getLength());
        }

        return $this->value;
    }

    /**
     * @param $case
     */
    public function stringCase($case): void
    {
        if (strcmp($case, 'title')) {
            $this->value = $this->value->toTitleCase();
            return;
        }
        if (strcmp($case, 'upper')) {
            $this->value = $this->value->toUpperCase();
            return;
        }
    }
}
