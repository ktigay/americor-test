<?php

namespace app\widgets\Export;

use kartik\export\ExportMenu;

class Export extends ExportMenu
{
    public $exportType = self::FORMAT_CSV;

    public $triggerDownload = true;

    public $showColumnSelector = false;
}