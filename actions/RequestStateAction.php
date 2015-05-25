<?php
/**
 * @link    http://hiqdev.com/hipanel
 * @license http://hiqdev.com/hipanel/license
 * @copyright Copyright (c) 2015 HiQDev
 */

namespace hipanel\actions;

use hipanel\widgets\RequestState;
use yii\base\Action;

class RequestStateAction extends Action {

    /**
     * @var \hiqdev\hiart\ActiveRecord
     */
    public $model;

    public function run (array $ids) {
        $model = $this->model;
        $data = $model::find()->where(['id' => $ids, 'with_request' => true])->all();

        foreach ($data as $item) {
            $res[$item->id] = [
                'id'   => $item->id,
                'name' => $item->name,
                'html' => RequestState::widget([
                    'module' => 'server',
                    'model'  => $item
                ])
            ];
        }

        return $this->controller->renderJson($res);
    }
}
