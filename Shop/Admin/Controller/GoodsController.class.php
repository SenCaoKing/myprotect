<?php
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends Controller{
	
	/**
	 * 发布商品信息
	 */
	public function add(){
		if(IS_POST){
			$goods=D('Goods');
			if($goods->addGoods(I('post.'))){
				$this->success('商品添加成功');
			}else{
				$this->error('添加商品失败');
			}
			return;
		}
		$this->display();
	}

	/**
	 * 显示商品列表
	 * @return  void
	 */
	public function lst(){		
		$goods=D('Goods');
		$data=$goods->search();
		//dump($data);
		$this->assign(array(
			'data'=>$data['data'],
			'page'=>$data['page']
		));
		$this->display();
	}



	
}
