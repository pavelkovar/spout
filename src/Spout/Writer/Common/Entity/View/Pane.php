<?php

namespace Box\Spout\Writer\Common\Entity\View;

class Pane
{
    public const TOP_RIGHT = 'topRight';
    public const BOTTOM_RIGHT = 'bottomRight';
    public const BOTTOM_LEFT = 'bottomLeft';

    /** @var string */
    private $activePane;

    /** @var string */
    private $state;

    /** @var string|null */
    private $topLeftCell;

    /** @var int|null */
    private $xSplit;

    /** @var int|null */
    private $ySplit;

    /**
     * @param string $activePane
     * @param string $state
     * @param string|null $topLeftCell
     * @param int|null $xSplit
     * @param int|null $ySplit
     */
    public function __construct(string $activePane, string $state, ?string $topLeftCell = null, ?int $xSplit = null, ?int $ySplit = null)
    {
        $this->activePane = $activePane;
        $this->state = $state;
        $this->topLeftCell = $topLeftCell;
        $this->xSplit = $xSplit;
        $this->ySplit = $ySplit;
    }

    /**
     * @return string
     */
    public function getActivePane()
    {
        return $this->activePane;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getTopLeftCell()
    {
        return $this->topLeftCell;
    }

    /**
     * @return int|null
     */
    public function getXSplit()
    {
        return $this->xSplit;
    }

    /**
     * @return int|null
     */
    public function getYSplit()
    {
        return $this->ySplit;
    }
}
