<?php
namespace Admin\Controller;
/**
 * 商品控制器
 */
class AttrController extends BaseController{
	
	/**
	 * 发布商品信息
	 */
	public function add(){
		$this->display();
	}

	/**
	 * 显示商品列表
	 * @return  void
	 */
	public function lst(){
		$this->display();
	}

	/**
	 * 删除商品
	 */
	public function delete(){
		$model=D('Goods');
		if($model->delete(I('get.id'))){
			$this->success('删除成功');
		}
	}

	/**
	 * 修改商品
	 * @return [type] [description]
	 */
	public function edit(){
		$this->display();
	}



	
}








