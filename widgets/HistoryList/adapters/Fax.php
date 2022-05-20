<?php

namespace app\widgets\HistoryList\adapters;

use Yii;
use yii\helpers\Html;
use app\models\Fax as FaxModel;

class Fax extends Base
{
    public function getViewParams(): array
    {
        $model = $this->model;
        $fax = $model->fax;

        return [
            'user' => $model->user,
            'body' => $this->getBody() .
                ' - ' .
                (isset($fax->document) ? Html::a(
                    Yii::t('app', 'view document'),
                    $fax->document->getViewUrl(),
                    [
                        'target' => '_blank',
                        'data-pjax' => 0
                    ]
                ) : ''),
            'footer' => Yii::t('app', '{type} was sent to {group}', [
                'type' => $fax ? $fax->getTypeText() : 'Fax',
                'group' => isset($fax->creditorGroup) ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
            ]),
            'footerDatetime' => $model->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ];
    }

    public function getBody(): string
    {
        return $this->model->eventText;
    }
}