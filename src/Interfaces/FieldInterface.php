<?php

namespace Convenia\PayrollFileReader\Interfaces;

/**
 * Interface FieldInterface.
 */
interface FieldInterface
{
    /**
     * Return the formatted field.
     *
     * @return string
     */
    public function format($caseToFormat);

    /**
     * Return the formatted value.
     *
     * @return string
     */
    public function getValue();
}
