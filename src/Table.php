<?php

namespace TheDeceased\Table;

class Table implements TableInterface
{
    private $rows = [];
    private $rowSpan = [];
    private $columnsWidths = [];
    private $columnsStyles = [];
    private $ranges = [];
    private $width = 0;

    public function addRow(RowInterface $row)
    {
        if (!empty($this->rowSpan)) {
            $row->addRowSpanCells($this->rowSpan);
            $this->rowSpan = array_filter(array_map(function ($e) {
                return $e['row'] - 1;
            }, $this->rowSpan));
        }

        foreach ($row->getRowSpannedCells() as $index => $spans) {
            if (!empty($this->rowSpan[$index])) {
                throw new \LogicException('Can\'t span one row multiple times');
            }
            $this->rowSpan[$index] = $spans;
        }
        $this->rows[] = $row;
        $this->width = $row->getWidth() > $this->width ? $row->getWidth() : $this->width;
    }

    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param string $format
     * @param int    $columnIndex Zero-base column index
     * @param mixed  $width       Width
     *
     * @return $this
     */
    public function setColumnWidth($format, $columnIndex, $width)
    {
        $this->columnsWidths[$format][$columnIndex] = $width;
        return $this;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function setColumnsWidths($data)
    {
        foreach ($data as $format => $columns) {
            foreach ($columns as $columnIndex => $width) {
                $this->setColumnWidth($format, $columnIndex, $width);
            }
        }
    }

    /**
     * @param string $format
     * @param int    $columnIndex Zero-base column index
     *
     * @return mixed
     */
    public function getColumnWidth($format, $columnIndex)
    {
        return isset($this->columnsWidths[$format][$columnIndex]) ? $this->columnsWidths[$format][$columnIndex] : null;
    }

    /**
     * @param string $format
     *
     * @return array
     */
    public function getColumnsWidths($format)
    {
        return isset($this->columnsWidths[$format]) ? $this->columnsWidths[$format] : [];
    }

    /**
     * @param string $format
     * @param int    $columnIndex
     * @param array  $styles
     *
     * @return $this
     */
    public function setColumnStyle($format, $columnIndex, $styles)
    {
        $this->columnsStyles[$format][$columnIndex] = $styles;
        return $this;
    }

    /**
     * @param string $format
     * @param int    $columnIndex
     *
     * @return array
     */
    public function getColumnStyle($format, $columnIndex)
    {
        return isset($this->columnsStyles[$format][$columnIndex]) ? $this->columnsStyles[$format][$columnIndex] : [];
    }

    /**
     * @param string $format
     *
     * @return array|mixed
     */
    public function getColumnsStyles($format)
    {
        return isset($this->columnsStyles[$format]) ? $this->columnsStyles[$format] : [];
    }

    /**
     * @param string $format
     * @param int[]  $range
     * @param array  $styles
     *
     * @return $this
     */
    public function addRangeStyle($format, $range, $styles)
    {
        $this->ranges[$format][$this->rangeHash($range)] = $styles;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return count($this->rows);
    }

    /**
     * @param RangeInterface $range
     *
     * @return $this
     */
    public function addRange(RangeInterface $range)
    {
        $this->ranges[] = $range;
        return $this;
    }

    /**
     * @return RangeInterface[]
     */
    public function getRanges()
    {
        return $this->ranges;
    }

    /**
     * @return Range
     */
    public function getBounds()
    {
        return new Range([0, 0], [$this->getWidth() - 1, $this->getHeight() - 1]);
    }
}