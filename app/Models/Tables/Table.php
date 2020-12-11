<?php

namespace App\Models\Tables;

class Table
{
    public $columns = [];

    protected $cursor;

    public function columns()
    {
        return $this->columns;
    }

    public function column($name)
    {
        $this->columns[$name] = [
            'primary' => false,
            'width' => null,
            'label' => null,
            'render' => null,
            'is_visible' => true,
        ];
        $this->cursor = $name;

        return $this;
    }

    public function primaryColumn()
    {
        $this->columns[$this->cursor]['primary'] = true;

        return $this;
    }

    public function width($width)
    {
        $this->columns[$this->cursor]['width'] = $width;

        return $this;
    }

    public function label($label)
    {
        $this->columns[$this->cursor]['label'] = $label;

        return $this;
    }

    public function render($view)
    {
        $this->columns[$this->cursor]['render'] = $view;

        return $this;
    }

    public function isVisible($isVisible)
    {
        $this->columns[$this->cursor]['is_visible'] = $isVisible;

        return $this;
    }

    public function widthTable()
    {
        $width = 49;

        foreach ($this->columns as $column) {
            $width += $column['width'];
        }

        return $width;
    }
}