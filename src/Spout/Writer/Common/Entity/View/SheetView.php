<?php

namespace Box\Spout\Writer\Common\Entity\View;

class SheetView
{
    /** @var Pane */
    private $pane;

    /** @var Selection[] */
    private $selections = [];

    /**
     * @param Pane $pane
     */
    public function setPane(Pane $pane)
    {
        $this->pane = $pane;
    }

    /**
     * @return Pane
     */
    public function getPane()
    {
        return $this->pane;
    }

    /**
     * @param Selection $selection
     */
    public function addSelection(Selection $selection)
    {
        $this->selections[] = $selection;
    }

    /**
     * @return Selection[]
     */
    public function getSelections()
    {
        return $this->selections;
    }
}
