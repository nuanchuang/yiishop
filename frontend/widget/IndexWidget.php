<?php
namespace frontend\widget;


use backend\models\GoodsCategory;
use yii\base\Widget;
use yii\helpers\Html;

class IndexWidget extends Widget
{
    public function run()
    {
        return <<<EOT
        <div class="cat_bd">
                <div class="cat item1">
                    <h3><a href="/list/index">图像、音像、数字商品</a> <b></b></h3>
                    <div class="cat_detail">
                        <dl class="dl_1st">
                            <dt><a href="">电子书</a></dt>
                            <dd>
                                <a href="">免费</a>
                                <a href="">小说</a>
                                <a href="">励志与成功</a>
                                <a href="">婚恋/两性</a>
                                <a href="">文学</a>
                                <a href="">经管</a>
                                <a href="">畅读VIP</a>
                            </dd>
                        </dl>

                        <dl>
                            <dt><a href="">数字音乐</a></dt>
                            <dd>
                                <a href="">通俗流行</a>
                                <a href="">古典音乐</a>
                                <a href="">摇滚说唱</a>
                                <a href="">爵士蓝调</a>
                                <a href="">乡村民谣</a>
                                <a href="">有声读物</a>
                            </dd>
                        </dl>

                        <dl>
                            <dt><a href="">音像</a></dt>
                            <dd>
                                <a href="">音乐</a>
                                <a href="">影视</a>
                                <a href="">教育音像</a>
                                <a href="">游戏</a>
                            </dd>
                        </dl>

                        <dl>
                            <dt><a href="">文艺</a></dt>
                            <dd>
                                <a href="">小说</a>
                                <a href="">文学</a>
                                <a href="">青春文学</a>
                                <a href="">传纪</a>
                                <a href="">艺术</a>
                                <a href="">经管</a>
                                <a href="">畅读VIP</a>
                            </dd>
                        </dl>

                        <dl>
                            <dt><a href="">人文社科</a></dt>
                            <dd>
                                <a href="">历史</a>
                                <a href="">心理学</a>
                                <a href="">政治/军事</a>
                                <a href="">国学/古籍</a>
                                <a href="">哲学/宗教</a>
                                <a href="">社会科学</a>
                            </dd>
                        </dl>

                        <dl>
                            <dt><a href="">经管励志</a></dt>
                            <dd>
                                <a href="">经济</a>
                                <a href="">金融与投资</a>
                                <a href="">管理</a>
                                <a href="">励志与成功</a>
                            </dd>
                        </dl>

                        <dl>
                            <dt><a href="">人文社科</a></dt>
                            <dd>
                                <a href="">历史</a>
                                <a href="">心理学</a>
                                <a href="">政治/军事</a>
                                <a href="">国学/古籍</a>
                                <a href="">哲学/宗教</a>
                                <a href="">社会科学</a>
                            </dd>
                        </dl>

                        <dl>
                            <dt><a href="">生活</a></dt>
                            <dd>
                                <a href="">烹饪/美食</a>
                                <a href="">时尚/美妆</a>
                                <a href="">家居</a>
                                <a href="">娱乐/休闲</a>
                                <a href="">动漫/幽默</a>
                                <a href="">体育/运动</a>
                            </dd>
                        </dl>

                        <dl>
                            <dt><a href="">科技</a></dt>
                            <dd>
                                <a href="">科普</a>
                                <a href="">建筑</a>
                                <a href="">IT</a>
                                <a href="">医学</a>
                                <a href="">工业技术</a>
                                <a href="">电子/通信</a>
                                <a href="">农林</a>
                                <a href="">科学与自然</a>
                            </dd>
                        </dl>

                    </div>
                </div>
            </div>
EOT;
    }
}

//    public $expend = false;//判断是否收起

//    public function run1()
//    {
//
//        $html = '';//定义一个变量存放数据
////        $goodsCategory = GoodsCategory::find()->roots()->all();//获取一级分类
//        $goodsCategory = GoodsCategory::find()->where(['depth' => 0])->all();//获取一级分类
////        var_dump($goodsCategory);
////        exit;
//        foreach ($goodsCategory as $k => $category) {
//            echo '<div class="cat_' . ($k == 0 ? 'item1' : '') . '">
//                <h3>' . Html::a($category->name, ['/list/index', 'id' => $category->id]) . '<b></b></h3>
//                <div class="cat_detail">';
//            $html .= '</div></