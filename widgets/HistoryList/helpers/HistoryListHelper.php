<?php

namespace app\widgets\HistoryList\helpers;

use app\models\{Call, Customer, History};

/**
 * Class HistoryListHelper
 * @package app\widgets\HistoryList\helpers
 * @deprecated use app\widgets\HistoryList\adapters\Base::getAdapterByModel($model)->getBody()
 */
class HistoryListHelper
{
    public static function getBodyByModel(History $model): string
    {
        switch ($model->event) {
            case History::EVENT_CREATED_TASK:
            case History::EVENT_COMPLETED_TASK:
            case History::EVENT_UPDATED_TASK:
                $task = $model->task;
                return "$model->eventText: " . ($task->title ?? '');
            case History::EVENT_INCOMING_SMS:
            case History::EVENT_OUTGOING_SMS:
                return $model->sms->message ?: '';
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return "$model->eventText " .
                    (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
                    (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return "$model->eventText " .
                    (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
                    (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
            case History::EVENT_INCOMING_CALL:
            case History::EVENT_OUTGOING_CALL:
                /** @var Call $call */
                $call = $model->call;
                return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
            case History::EVENT_OUTGOING_FAX:
            case History::EVENT_INCOMING_FAX:
            default:
                return $model->eventText;
        }
    }
}