<?php

namespace frontend\components;

use creocoder\nestedsets\NestedSetsQueryBehavior;


class GoodsCategoryQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}