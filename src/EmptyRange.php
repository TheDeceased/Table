<?php

namespace TheDeceased\Table;

class EmptyRange implements RangeInterface
{

    /**
     * @return int[]
     */
    public function getStart()
    {
        return [0, 0];
    }

    /**
     * @return int[]
     */
    public function getEnd()
    {
        return [0, 0];
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return 0;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return 0;
    }

    /**
     * @param string $format
     *
     * @return array
     */
    public function getStyles($format)
    {
        return [];
    }

    /**
     * @param string $format
     * @param array  $styles
     *
     * @return $this
     */
    public function setStyles($format, $styles)
    {
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return true;
    }
}
