<?php
/**
 * Created by PhpStorm.
 * User: yidashi
 * Date: 2016/12/15
 * Time: 下午3:14
 */

/**
 * @var \yii\web\View $this
 * @var common\modules\book\models\BookChapter $model
 */
use common\helpers\Tree;

$chapters = $model->book->chapters;
$items = [];
foreach ($chapters as $chapter) {
    $item = [];
    $item['label'] = $chapter->chapter_name;
    $item['url'] = ['update-chapter', 'id' => $chapter->id];
    $item['active'] = (request('id') == $chapter->id && Yii::$app->controller->action->id == 'update-chapter') || (request('chapter_id') == $chapter->id && Yii::$app->controller->action->id == 'create-chapter');
    $item['id'] = $chapter->id;
    $item['pid'] = $chapter->pid;
    $item['linkOptions'] = ['data-id' => $chapter->id, 'data-pid' => $chapter->pid];
    $items[] = $item;
}
$menuItems = Tree::build($items, 'id', 'pid', 'items');
?>
<style>
    .btn-operate-chapter {
        position: absolute;
        right:10px;
        top:10px;
        z-index:999;
    }
    .btn-operate-chapter a{
        width: 30px;
        height: 30px;
        background-color: rgba(0, 0, 0, 0.8);
        padding: 4px;
        border-radius: 5px;
        color: #fff;
        margin-left:5px;
    }
</style>
<div class="row">
    <div class="col-md-3">
        <?= \common\widgets\SideNavWidget::widget([
            'items' => $menuItems
        ]) ?>

        <?= \yii\helpers\Html::a('<i class="fa fa-plus"></i> 新增章节', ['/book/default/create-chapter', 'id' => $model->book->id], ['class' => 'btn bg-maroon btn-sm']) ?>

    </div>
    <div class="col-md-9">
        <div class="box box-solid">
            <div class="box-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('js') ?>
<script>
    $('.list-group-item').hover(function(){
        var that = this;
        var createChapterUrl = '<?= url(['create-chapter']) ?>';
        var deleteChapterUrl = '<?= url(['delete-chapter']) ?>';
        var movePrevUrl = '<?= url(['move-chapter', 'at' => 'prev']) ?>';
        var moveNextUrl = '<?= url(['move-chapter', 'at' => 'next']) ?>';
        var chapterId = $(this).data('id');
        var bookId = '<?= $model->book->id ?>';
        $('<span>', {"class":'btn-operate-chapter'})
            .append('<a href="' + movePrevUrl.addQueryParams({id:chapterId}) + '" data-method="post"><i class="fa fa-arrow-up"></i></a>')
            .append('<a href="' + moveNextUrl.addQueryParams({id:chapterId}) + '" data-method="post"><i class="fa fa-arrow-down"></i></a>')
            .append('<a href="' + createChapterUrl.addQueryParams({id:bookId, chapter_id:chapterId}) + '"><i class="fa fa-plus"></i></a>')
            .append('<a href="' + deleteChapterUrl.addQueryParams({id:chapterId}) + '" data-confirm="确认要删除这个章节吗?"><i class="fa fa-remove"></i></a>')
            .appendTo(that);
    }, function () {
        $(this).find('.btn-operate-chapter').remove();
    })
</script>
<?php $this->endBlock() ?>
