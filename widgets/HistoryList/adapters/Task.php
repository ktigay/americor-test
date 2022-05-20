<?php

namespace app\widgets\HistoryList\adapters;

use app\models\Task as TaskModel;

class Task extends Base
{

    public function getViewParams(): array
    {
        $model = $this->model;

        $task = $model->task;

        return [
            'user' => $model->user,
            'body' => $this->getBody(),
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $model->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ];
    }

    public function getBody(): string
    {
        $model = $this->model;
        $task = $model->task;

        return "$model->eventText: " . ($task->title ?? '');
    }
}