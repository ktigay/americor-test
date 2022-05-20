<?php

namespace app\widgets\HistoryList\adapters;

use app\models\History;

abstract class Base
{
    /**
     * @var History
     */
    protected $model;

    protected $view = '_item_common';

    const TYPE_CALL = 'call';
    const TYPE_CHANGE_QUALITY = 'change_quality';
    const TYPE_CHANGE_TYPE = 'change_type';
    const TYPE_DEFAULT = 'default';
    const TYPE_FAX = 'fax';
    const TYPE_SMS = 'sms';
    const TYPE_TASK = 'task';

    public static $adaptersMap = [
        self::TYPE_CALL => '\app\widgets\HistoryList\adapters\Call',
        self::TYPE_CHANGE_QUALITY => '\app\widgets\HistoryList\adapters\ChangeQuality',
        self::TYPE_CHANGE_TYPE => '\app\widgets\HistoryList\adapters\ChangeType',
        self::TYPE_DEFAULT => '\app\widgets\HistoryList\adapters\DefaultAdapter',
        self::TYPE_FAX => '\app\widgets\HistoryList\adapters\Fax',
        self::TYPE_SMS => '\app\widgets\HistoryList\adapters\Sms',
        self::TYPE_TASK => '\app\widgets\HistoryList\adapters\Task',
    ];

    public function __construct(History $model)
    {
        $this->model = $model;
    }

    public function getView(): string
    {
        return $this->view;
    }

    public abstract function getViewParams(): array;

    public abstract function getBody(): string;

    public static function getAdapterByModel(History $model): self
    {
        switch ($model->event) {
            case History::EVENT_CREATED_TASK:
            case History::EVENT_COMPLETED_TASK:
            case History::EVENT_UPDATED_TASK:
                $className = self::$adaptersMap[self::TYPE_TASK];
                break;
            case History::EVENT_INCOMING_SMS:
            case History::EVENT_OUTGOING_SMS:
                $className = self::$adaptersMap[self::TYPE_SMS];
                break;
            case History::EVENT_OUTGOING_FAX:
            case History::EVENT_INCOMING_FAX:
                $className = self::$adaptersMap[self::TYPE_FAX];
                break;
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                $className = self::$adaptersMap[self::TYPE_CHANGE_TYPE];
                break;
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                $className = self::$adaptersMap[self::TYPE_CHANGE_QUALITY];
                break;
            case History::EVENT_INCOMING_CALL:
            case History::EVENT_OUTGOING_CALL:
                $className = self::$adaptersMap[self::TYPE_CALL];
                break;
            default:
                $className = self::$adaptersMap[self::TYPE_DEFAULT];
                break;
        }

        return new $className($model);
    }
}