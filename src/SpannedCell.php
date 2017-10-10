<?php

namespace TheDeceased\Table;

class SpannedCell implements CellInterface
{

    /**
     * @var int
     */
    private $colspan;

    public function __construct($colspan)
    {
        $this->colspan = $colspan;
    }

    /**
     * @return string
     */
    public function value()
    {
        return '';
    }

    /**
     * @return int
     */
    public function colspan()
    {
        return $this->colspan;
    }

    /**
     * @return int
     */
    public function rowspan()
    {
        return 1;
    }

    public function isVisible()
    {
        return false;
    }

    /**
     * @param string $format
     * @param array  $style
     *
     * @return $this
     */
    public function setStyle($format, $style)
    {
        return $this;
    }

    /**
     * @param string $format
     *
     * @return array
     */
    public function getStyle($format)
    {
        return [];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return static::TYPE_AUTO;
    }
}
