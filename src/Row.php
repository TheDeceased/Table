<?php

namespace TheDeceased\Table;

class Row implements RowInterface
{
    /** @var CellInterface[] */
    private $cells = [];
    private $heights = [];
    private $styles = [];
    private $width = 0;

    /**
     * @param array $rowData
     *
     * @return Row
     */
    public static function createFromArray($rowData)
    {
        $row = new Row();
        foreach ($rowData as $cellData) {
            if (is_object($cellData)) {
                $cell = $cellData;
            } else {
                $cell = Cell::createFromArray($cellData);
            }
            $row->add($cell);
        }
        return $row;
    }

    /**
     * @param CellInterface $cell
     *
     * @return $this
     */
    public function add(CellInterface $cell)
    {
        $this->cells[] = $cell;
        $this->width += $cell->colspan();
        return $this;
    }

    /**
     * @param array $spanCells
     */
    public function addRowSpanCells($spanCells = [])
    {
        $originalCells = $this->clear();
        foreach ($originalCells as $originalCell) {
            do {
                $span = !empty($spanCells[$this->width]) ? $spanCells[$this->width] : [];
                $cell = !empty($span['row']) ? new SpannedCell($span['col'] + 1) : $originalCell;
                $this->add($cell);
            } while ($cell instanceof SpannedCell);
        }
    }

    /**
     * @return array
     */
    public function getRowSpannedCells()
    {
        $spanned = [];
        $index = 0;
        foreach ($this->cells as $cell) {
            if ($cell->rowspan() > 1) {
                $spanned[$index] = [
                    'row' => $cell->rowspan() - 1,
                    'col' => $cell->colspan() - 1,
                ];
            }
            $index += $cell->colspan();
        }
        return $spanned;
    }

    /**
     * @return CellInterface[]
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * @param string $format
     * @param mixed  $height
     *
     * @return $this
     */
    public function setHeight($format, $height)
    {
        $this->heights[$format] = $height;
        return $this;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setHeights($data)
    {
        foreach ($data as $format => $height) {
            $this->setHeight($format, $height);
        }
        return $this;
    }

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getHeight($format)
    {
        return isset($this->heights[$format]) ? $this->heights[$format] : null;
    }

    /**
     * @param string $format
     *
     * @return array
     */
    public function getStyles($format)
    {
        return isset($this->styles[$format]) ? $this->styles[$format] : [];
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
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return CellInterface[]
     */
    public function clear()
    {
        $this->width = 0;
        return array_splice($this->cells, 0);
    }
}
