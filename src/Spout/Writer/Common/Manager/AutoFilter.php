<?php

namespace Box\Spout\Writer\Common\Manager;

use Box\Spout\Writer\Common\Entity\Worksheet;

trait AutoFilter
{
    /** @var string[] */
    private $autoFilterRange = [];

    /**
     * @param Worksheet $worksheet
     * @param string|null $range
     */
    public function setAutoFilter(Worksheet $worksheet, ?string $range)
    {
        $this->autoFilterRange[$worksheet->getId()] = $range;
    }

    /**
     * @param Worksheet $worksheet
     * @return string|null
     */
    public function getAutoFilter(Worksheet $worksheet)
    {
        if (!array_key_exists($worksheet->getId(), $this->autoFilterRange)) {
            return null;
        }
        return $this->autoFilterRange[$worksheet->getId()];
    }
}
