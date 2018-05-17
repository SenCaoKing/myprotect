<?php
namespace Home\Controller;

class IndexController extends BaseController {
    public function index($value=''){
        // 设置页面信息
        $this->setPageInfo('京西商城-首页','首页','首页',1,array('index'),array('index'));
        // 获取疯狂抢购
        $promote_goods=D('Admin/Goods')->getPromote();
        $this->assign('promote_goods',$promote_goods);
        dump($promote_goods);
        // 获取热卖商品
        $hot_goods=D('Admin/Goods')->getHot();
        $this->assign('hot_goods',$hot_goods);
        // 获取推荐商品(精品)
        $best_goods=D('Admin/Goods')->getBest();
        $this->assign('best_goods',$best_goods);
        // 获取新品上架
        $new_goods=D('Admin/Goods')->getNew();
        $this->assign('new_goods',$new_goods);
        $this->display();
    }
}