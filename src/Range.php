<?php

namespace TheDeceased\Table;

class Range implements RangeInterface
{
    /** @var int[] */
    private $startCoordinates;
    /** @var int[] */
    private $endCoordinates;
    private $styles = [];

    public function __construct($startCoordinates, $endCoordinates)
    {
        $this->startCoordinates = $startCoordinates;
        $this->endCoordinates = $endCoordinates;
    }

    /**
     * @return int[]
     */
    public function getStart()
    {
        return $this->startCoordinates;
    }

    /**
     * @return int[]
     */
    public function getEnd()
    {
        return $this->endCoordinates;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->endCoordinates[1] - $this->startCoordinates[1];
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->endCoordinates[0] - $this->startCoordinates[0];
    }

    /**
     * @param string $format
     *
     * @return array
     */
    public function getStyles($format)
    {
        $commonStyle = isset($this->styles['common']) ? $this->styles['common'] : [];
        $style = isset($this->styles[$format]) ? $this->styles[$format] : [];

        return array_merge($commonStyle, $style);
    }

    /**
     * @param string $format
     * @param array  $styles
     *
     * @return $this
     */
    public function setStyles($format, $styles)
    {
        $this->styles[$format] = $styles;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return false;
    }
}
