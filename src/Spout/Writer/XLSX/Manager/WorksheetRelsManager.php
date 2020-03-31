<?php

namespace Box\Spout\Writer\XLSX\Manager;

use Box\Spout\Common\Helper\Escaper\XLSX as XLSXEscaper;
use Box\Spout\Writer\Common\Entity\Worksheet;
use Box\Spout\Writer\XLSX\Helper\FileSystemHelper;

class WorksheetRelsManager
{
    /** @var XLSXEscaper String helper */
    private $stringEscaper;
    /** @var FileSystemHelper */
    private $fileSystemHelper;

    /**
     * WorksheetRelsManager constructor.
     * @param XLSXEscaper $stringEscaper
     * @param FileSystemHelper $fileSystemHelper
     */
    public function __construct(XLSXEscaper $stringEscaper, FileSystemHelper $fileSystemHelper)
    {
        $this->stringEscaper = $stringEscaper;
        $this->fileSystemHelper = $fileSystemHelper;
    }

    /**
     * @param Worksheet $worksheet
     * @return resource
     */
    private function create(Worksheet $worksheet)
    {
        $this->createRelsFolder();

        $path = $this->getRelsFilePath($worksheet);
        $filePointer = fopen($path, 'w');

        $worksheet->setRelsFilePointer($filePointer);

        \fwrite($filePointer, '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>');
        \fwrite($filePointer, "\n");
        \fwrite($filePointer, '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">');
        return $filePointer;
    }

    /**
     * @param Worksheet $worksheet
     * @return string
     */
    private function getRelsFilePath(Worksheet $worksheet)
    {
        $path = $this->fileSystemHelper->getXlWorksheetsFolder() . '/' . FileSystemHelper::RELS_FOLDER_NAME;
        return $path . '/' . \strtolower('sheet' . $worksheet->getId()) . '.xml.rels';
    }

    private function createRelsFolder()
    {
        $path = $this->fileSystemHelper->getXlWorksheetsFolder() . '/' . FileSystemHelper::RELS_FOLDER_NAME;
        if (!is_dir($path)) {
            \mkdir($path, 0777, true);
        }
    }

    /**
     * @param Worksheet $worksheet
     * @param string $link
     * @return string
     */
    public function writeHypertextRelation(Worksheet $worksheet, $link)
    {
        $relsFilePointer = $worksheet->getRelsFilePointer();
        if ($relsFilePointer === null) {
            $relsFilePointer = $this->create($worksheet);
        }

        $relId = 'rId' . $worksheet->incRelsId();
        \fwrite($relsFilePointer, sprintf(
            '<Relationship Id="%s" Target="%s" TargetMode="External" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink"/>',
            $relId,
            $this->stringEscaper->escape($link)
        ));
        return $relId;
    }

    /**
     * @param Worksheet $worksheet
     */
    public function close(Worksheet $worksheet)
    {
        $filePointer = $worksheet->getRelsFilePointer();
        if ($filePointer === null) {
            return;
        }

        \fwrite($filePointer, '</Relationships>');
        \fclose($filePointer);
    }
}
