<?php

namespace frontend\components\grid;
use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * Class DataColumn
 * Our DataColumn widget.
 */
class DataColumn extends \yii\grid\DataColumn
{
    /**
     * @inheritdoc
     */
    public $popover = null;
    /**
     * @inheritdoc
     */
    public $popoverOptions = [
        'placement'     => 'bottom',
        'selector'      => 'a',
    ];
    /**
     * @inheritdoc
     */
//    public $layout = "{items}\n<div class='row'><div class='col-xs-6'><div class='dataTables_info'>{summary}</div></div>\n<div class='col-xs-6'><div class='dataTables_paginate paging_bootstrap'>{pager}</div></div></div>";
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerClientScript();
    }

    public function renderHeaderCellContent () {
        $this->headerOptions = ArrayHelper::merge($this->headerOptions,[
            'data-toggle'  => 'popover',
            'data-trigger' => 'hover',
            'data-content' => $this->popover,
        ]);
        return parent::renderHeaderCellContent();
    }

    public function registerClientScript () {
        $view = Yii::$app->getView();
        $ops = Json::encode($this->popoverOptions);
        $view->registerJs("$('#{$this->grid->id} thead th[data-toggle=\"popover\"]').popover($ops);", \yii\web\View::POS_READY);
    }

}