<?php

namespace TheDeceased\Table;

interface RangeInterface
{
    /**
     * @return int[]
     */
    public function getStart();

    /**
     * @return int[]
     */
    public function getEnd();

    /**
     * @return int
     */
    public function getHeight();

    /**
     * @return int
     */
    public function getWidth();

    /**
     * @param string $format
     *
     * @return array
     */
    public function getStyles($format);

    /**
     * @param string $format
     * @param array  $styles
     *
     * @return $this
     */
    public function setStyles($format, $styles);

    /**
     * @return bool
     */
    public function isEmpty();
}
