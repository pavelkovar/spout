<?php

namespace Box\Spout\Writer\Common\Entity\View;

class Selection
{
    /** @var string */
    private $activeCell;

    /** @var string */
    private $pane;

    /** @var string */
    private $sqref;

    /**
     * @param string $activeCell
     * @param string $pane
     * @param string $sqref
     */
    public function __construct(string $activeCell, string $pane, string $sqref)
    {
        $this->activeCell = $activeCell;
        $this->pane = $pane;
        $this->sqref = $sqref;
    }

    /**
     * @return string
     */
    public function getActiveCell()
    {
        return $this->activeCell;
    }

    /**
     * @return string
     */
    public function getPane()
    {
        return $this->pane;
    }

    /**
     * @return string
     */
    public function getSqref()
    {
        return $this->sqref;
    }
}
