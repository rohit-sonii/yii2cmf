<?php

/* @var $this yii\web\View */
/* @var $models array */
/* @var $pages array */
/* @var $hotTags array */
/* @var $tag \common\modules\document\models\Tag */
use yii\helpers\Html;

$this->title = $tag->name;
$this->params['breadcrumbs'][] = ['label' => '标签', 'url' => ['/document/tag/index']];
$this->params['breadcrumbs'][] = Html::encode($this->title);

?>
<div class="col-lg-9">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'layout' => "{items}",
        'options' => ['class' => 'article-list'],
        'itemOptions' => ['class' => 'media']
    ]) ?>
    <?php if (!(new \Detection\MobileDetect())->isMobile()): ?>
        <?= \yii\widgets\LinkPager::widget([
            'pagination' => $dataProvider->pagination
        ]); ?>
    <?php else: ?>
        <?= \yii\widgets\LinkPager::widget([
            'pagination' => $dataProvider->pagination,
            'nextPageLabel' => '下一页',
            'prevPageLabel' => '上一页',
            'maxButtonCount' => 0,
            'prevPageCssClass' => 'previous',
            'nextPageCssClass' => 'next',
            'options' => ['class' => 'pager'],
        ]); ?>
    <?php endif; ?>
</div>
<div class="col-lg-3">
    <?= \common\modules\area\widgets\AreaWidget::widget([
        'slug' => 'article-index-sidebar',
        "blockClass" => "panel panel-default",
        "headerClass" => "panel-heading",
        "bodyClass" => "panel-body",
    ]) ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h5>热门标签</h5>
        </div>
        <div class="panel-body">
            <ul class="tag-list list-inline">
                <?php foreach ($hotTags as $tag): ?>
                    <li><a class="label label-<?= $tag->level ?>"
                           href="<?= \yii\helpers\Url::to(['/document/default/tag', 'name' => $tag->name]) ?>"><?= $tag->name ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
