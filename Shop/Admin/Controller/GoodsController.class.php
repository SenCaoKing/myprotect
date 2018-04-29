<?php
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends Controller{
	/**
	 * 添加商品
	 */
	public function add(){
		$goods = new \Admin\Model\GoodsModel(); // 实例化GoodsModel对象
		// 两个逻辑：展示、收集
		if(IS_POST){
			$data = $goods -> create();

			// 对富文本编辑器原生内容进行过滤，防止XSS攻击
			$data['goods_desc'] = \removeXSS($_POST['goods_desc']);
			if($goods -> add($data)){
				$this -> success('添加商品成功',U('lst'));
			}else{
				$this ->error('添加商品失败',U('add'), 2);
			}
		}else{ // 展示表单
			$this -> display();
		}
	}

	/**
	 * 商品列表
	 * @return  void
	 */
	public function lst(){
		// $goods=D('Goods')->select();
		
		// dump($goods);
		// $data=$goods->search();
		
		// $this->assign('goods',$goods);
		// // $this->assign('data',$data);
		// $this->display();
		
		$goods=D('Goods');
		$data=$goods->search();
		dump($data);
		$this->assign(array(
			'data'=>$data['data'],
			'page'=>$data['page']
		));
		$this->display();
	}



	// /**
	//  * 添加商品
	//  */
	// public function add(){
	// 	if(IS_POST){
	// 		$goods = D('Goods');
	// 		// $goods = new \Admin\Model\GoodsModel();
	// 		// 对富文本编辑器原生内容进行过滤，防止XSS攻击
	// 		if($goods->create(I('post.'), 1)){
	// 			if($id = $goods->add()){
	// 				$this->success('添加成功！',U('lst'));
	// 				// return;
	// 			}
	// 		}
	// 		// $this->error($goods->getError());
	// 	}
	// 	$this->display();
	// }	

	// /**
	//  * 商品列表
	//  * @return  void
	//  */
	// public function lst(){
	// 	$goods=D('Goods')->select();
	// 	// dump($goods);
	// 	$this->assign('goods',$goods);
	// 	// $this->assign('data',$data);
	// 	$this->display();
	// }

	// /**
	//  * 修改商品
	//  * @return  [type] [description]
	//  */
	// public function edit(){
	// 	if(IS_POST){
	// 		$goods=D('Goods');
	// 		if($goods->update(I('post.'))){
	// 			$this->success('修改成功',U('lst'));
	// 		}else{
	// 			$this->error('修改失败');
	// 		}
	// 		return;
	// 	}
	// 	//显示修改界面
	// 	$goods=M('Goods');
	// 	$data=$goods->find(I('get.id'));
	// 	// dump($data);
	// 	$this->assign('data',$data);
	// 	$this->display();
	// }

}
