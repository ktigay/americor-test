<?php
use app\models\search\HistorySearch;
use app\widgets\HistoryList\adapters\Base;

/** @var $model HistorySearch */
$adapter = Base::getAdapterByModel($model);
echo $this->render($adapter->getView(), $adapter->getViewParams());