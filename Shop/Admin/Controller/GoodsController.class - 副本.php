<?php
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends Controller{
	/**
	 * 添加商品
	 */
	public function add(){
		if(IS_POST){
			$goods = D('Goods');
			// $goods = new \Admin\Model\GoodsModel();
			// 对富文本编辑器原生内容进行过滤，防止XSS攻击
			if($goods->create(I('post.'), 1)){
				if($id = $goods->add()){
					$this->success('添加成功！',U('lst'));
					// return;
				}
			}
			// $this->error($goods->getError());
		}
		$this->display();
	}	

	/**
	 * 商品列表
	 * @return  void
	 */
	public function lst(){
		$goods=D('Goods')->select();
		// dump($goods);
		$this->assign('goods',$goods);
		// $this->assign('data',$data);
		$this->display();
	}

	/**
	 * 修改商品
	 * @return  [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			$goods=D('Goods');
			if($goods->update(I('post.'))){
				$this->success('修改成功',U('lst'));
			}else{
				$this->error('修改失败');
			}
			return;
		}
		//显示修改界面
		$goods=M('Goods');
		$data=$goods->find(I('get.id'));
		// dump($data);
		$this->assign('data',$data);
		$this->display();
	}

}
