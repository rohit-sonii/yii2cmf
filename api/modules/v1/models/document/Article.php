<?php
/**
 * Created by PhpStorm.
 * Author: yidashi
 * DateTime: 2017/3/9 13:27
 * Description:
 */

namespace api\modules\v1\models\document;


class Article extends \common\modules\document\models\document\Article
{
    public function fields()
    {
        return [
            'markdown',
            'content' => function($model) {
                $css = \Yii::$app->request->getHostInfo() . \Yii::$app->request->getBaseUrl() . '/article.css';
                return <<<CONTENT
    <link href="{$css}" rel="stylesheet"/>
    <div class="view-content">{$model->processedContent}</div>
CONTENT;
            }
        ];
    }
}