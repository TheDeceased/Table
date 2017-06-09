<?php

namespace TheDeceased\Table;

class EmptyCell implements CellInterface
{
    /** @var int */
    private $colspan;
    /** @var int */
    private $rowspan;

    public function __construct($colspan = 1, $rowspan = 1)
    {
        $this->colspan = $colspan;
        $this->rowspan = $rowspan;
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
        return $this->rowspan;
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
     * @return bool
     */
    public function isVisible()
    {
        return true;
    }
}
