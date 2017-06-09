<?php

namespace TheDeceased\Table;

interface TableInterface
{
    /**
     * @param RowInterface $row
     *
     * @return $this
     */
    public function addRow(RowInterface $row);

    /**
     * @return RowInterface[]
     */
    public function getRows();

    /**
     * @param string $format
     * @param int    $columnIndex Zero-base column index
     * @param mixed  $width       Width
     *
     * @return $this
     */
    public function setColumnWidth($format, $columnIndex, $width);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function setColumnsWidths($data);

    /**
     * @param string $format
     * @param int    $columnIndex Zero-base column index
     *
     * @return mixed
     */
    public function getColumnWidth($format, $columnIndex);

    /**
     * @param string $format
     *
     * @return array
     */
    public function getColumnsWidths($format);

    /**
     * @param string $format
     * @param int    $columnIndex
     * @param array  $styles
     *
     * @return $this
     */
    public function setColumnStyle($format, $columnIndex, $styles);

    /**
     * @param string $format
     * @param int    $columnIndex
     *
     * @return array
     */
    public function getColumnStyle($format, $columnIndex);

    /**
     * @param string $format
     *
     * @return array
     */
    public function getColumnsStyles($format);

    /**
     * @param RangeInterface $range
     *
     * @return $this
     */
    public function addRange(RangeInterface $range);

    /**
     * @return RangeInterface[]
     */
    public function getRanges();

    /**
     * @return int
     */
    public function getWidth();

    /**
     * @return int
     */
    public function getHeight();

    /**
     * @return Range
     */
    public function getBounds();
}
