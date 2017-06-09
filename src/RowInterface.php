<?php

namespace TheDeceased\Table;

interface RowInterface
{
    /**
     * @param array $rowData
     *
     * @return RowInterface
     */
    public static function createFromArray($rowData);

    /**
     * @param CellInterface $cell
     *
     * @return RowInterface
     */
    public function add(CellInterface $cell);

    /**
     * @param array $spans
     *
     * @return void
     */
    public function addRowSpanCells($spans);

    /**
     * @return CellInterface[]
     */
    public function getCells();

    /**
     * @return array
     */
    public function getRowSpannedCells();

    /**
     * @param string $format
     * @param mixed  $height
     *
     * @return $this
     */
    public function setHeight($format, $height);

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setHeights($data);

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getHeight($format);

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
     * @return int
     */
    public function getWidth();
}
