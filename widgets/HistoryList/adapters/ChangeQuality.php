<?php

namespace app\widgets\HistoryList\adapters;

use app\models\Customer;

class ChangeQuality extends Base
{
    protected $view = '_item_statuses_change';

    public function getViewParams(): array
    {
        $model = $this->model;

        return [
            'model' => $model,
            'oldValue' => Customer::getQualityTextByQuality($model->getDetailOldValue('quality')),
            'newValue' => Customer::getQualityTextByQuality($model->getDetailNewValue('quality')),
        ];
    }

    public function getBody(): string
    {
        $model = $this->model;

        return "$model->eventText " .
            (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
            (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
    }
}