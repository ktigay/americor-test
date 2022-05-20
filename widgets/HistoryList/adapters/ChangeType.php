<?php

namespace app\widgets\HistoryList\adapters;

use app\models\Customer;

class ChangeType extends Base
{
    protected $view = '_item_statuses_change';

    public function getViewParams(): array
    {
        $model = $this->model;

        return [
            'model' => $model,
            'oldValue' => Customer::getTypeTextByType($model->getDetailOldValue('type')),
            'newValue' => Customer::getTypeTextByType($model->getDetailNewValue('type'))
        ];
    }

    public function getBody(): string
    {
        $model = $this->model;

        return "$model->eventText " .
            (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
            (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
    }
}