<?php

namespace TheDeceased\Table;

class Cell implements CellInterface
{
    /** @var array */
    private $cellData;
    /** @var FontInterface */
    private $font;
    /** @var AlignmentInterface */
    private $alignment;
    /** @var array */
    private $styles = [];

    public static function createFromArray($cellData)
    {
        $cell = new static($cellData);
        if (!empty($cellData['font'])) {
            $cell->setFont(Font::createFromArray($cellData['font']));
        }
        if (!empty($cellData['styles'])) {
            foreach ($cellData['styles'] as $format => $styles) {
                $cell->setStyle($format, $styles);
            }
        }
        return $cell;
    }

    public function __construct(array $cellData)
    {
        $this->cellData = $cellData;
    }

    /**
     * @return string
     */
    public function value()
    {
        return (string)(isset($this->cellData['value']) ? $this->cellData['value'] : '');
    }

    /**
     * @return int
     */
    public function colspan()
    {
        return !empty($this->cellData['colspan']) ? (int)$this->cellData['colspan'] : 1;
    }

    /**
     * @return int
     */
    public function rowspan()
    {
        return !empty($this->cellData['rowspan']) ? (int)$this->cellData['rowspan'] : 1;
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return true;
    }

    /**
     * @param string $format
     * @param array  $style
     *
     * @return $this
     */
    public function setStyle($format, $style)
    {
        $this->styles[$format] = $style;
        return $this;
    }

    /**
     * @param string $format
     *
     * @return array
     */
    public function getStyle($format)
    {
        $commonStyle = isset($this->styles['common']) ? $this->styles['common'] : [];
        $style = isset($this->styles[$format]) ? $this->styles[$format] : [];

        return array_merge($commonStyle, $style);
    }
}
