<?php

namespace TheDeceased\Table\Formatters;

use TheDeceased\Table\TableInterface;

class HTMLFormatter implements FormatterInterface
{
    /**
     * @var TableInterface
     */
    private $table;

    public function __construct(TableInterface $table)
    {
        $this->table = $table;
    }

    public function output()
    {
        $a = 0;
        $out = '<table>';
        foreach ($this->table->getRows() as $row) {
            $out .= '<tr>';
            foreach ($row->getCells() as $cell) {
                if (!$cell->isVisible()) {
                    continue;
                }
                $colspan = $cell->colspan();
                $rowspan = $cell->rowspan();
                $styles = $cell->getStyle('html');
                $style = [];
                if (!empty($styles['font'])) {
                    if (isset($font['bold'])) {
                        $style[] = 'font-weight: bold;';
                    }
                    if (isset($font['italic'])) {
                        $style[] = 'font-style: italic;';
                    }
                }
                $style = !empty($style) ? implode(' ', $style) : '';
                $out .= '<td' .
                    ($colspan > 1 ? ' colspan="' . $colspan . '"' : '') .
                    ($rowspan > 1 ? ' rowspan="' . $rowspan . '"' : '') .
                    ($style ? ' style="' . $style . '"' : '') .
                    '>' . $cell->value() . '</td>';
            }
            $out .= '</tr>';
            $a++;
        }
        $out .= '</table>';
        return $out;
    }
}