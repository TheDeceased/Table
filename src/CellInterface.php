<?php

namespace TheDeceased\Table;

interface CellInterface
{
    /**
     * @return string
     */
    public function value();

    /**
     * @return int
     */
    public function colspan();

    /**
     * @return int
     */
    public function rowspan();

    /**
     * @param string $format
     * @param array  $style
     *
     * @return $this
     */
    public function setStyle($format, $style);

    /**
     * @param string $format
     *
     * @return array
     */
    public function getStyle($format);

    /**
     * @return bool
     */
    public function isVisible();
}
