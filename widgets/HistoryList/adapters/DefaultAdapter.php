<?php

namespace app\widgets\HistoryList\adapters;

class DefaultAdapter extends Base
{

    public function getViewParams(): array
    {
        $model = $this->model;

        return [
            'user' => $model->user,
            'body' => $this->getBody(),
            'bodyDatetime' => $model->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ];
    }

    public function getBody(): string
    {
        return $this->model->eventText;
    }
}