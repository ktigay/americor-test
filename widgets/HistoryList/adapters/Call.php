<?php

namespace app\widgets\HistoryList\adapters;

use app\models\Call as CallModel;

class Call extends Base
{

    public function getViewParams(): array
    {
        /** @var CallModel $call */
        $model = $this->model;
        $call = $model->call;
        $answered = $call && $call->status == CallModel::STATUS_ANSWERED;

        return [
            'user' => $model->user,
            'content' => $call->comment ?? '',
            'body' => $this->getBody(),
            'footerDatetime' => $model->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction == CallModel::DIRECTION_INCOMING
        ];
    }

    public function getBody(): string
    {
        $model = $this->model;
        $call = $model->call;

        return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
    }
}