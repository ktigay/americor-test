<?php

namespace app\widgets\HistoryList\adapters;

use Yii;
use app\models\Sms as SmsModel;

class Sms extends Base
{

    public function getViewParams(): array
    {
        $model = $this->model;

        return [
            'user' => $model->user,
            'body' => $this->getBody(),
            'footer' => $model->sms->direction == SmsModel::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $model->sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $model->sms->phone_to ?? ''
                ]),
            'iconIncome' => $model->sms->direction == SmsModel::DIRECTION_INCOMING,
            'footerDatetime' => $model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ];
    }

    public function getBody(): string
    {
        $model = $this->model;
        return $model->sms->message ?: '';
    }
}