<?php
namespace Admin\Controller;
/**
 * 商品控制器
 */
class GoodsController extends BaseController{
	/**
	 * 发布商品信息
	 */
	public function add(){
		if(IS_POST){
			$model=D('Goods');
			if($goods->create(I('post.'), 1)){
				if($id = $model->add()){
					$this->success('添加成功！', U('lst?p='.I('get.p')));
					exit;
				}
			}
			$this->error($model->getError());
		}
		$typeModel=M('Type');
		$typeData=$typeModel->select();
		$this->assign('typeData',$typeData);
		$this->display();
	}

	/**
	 * 显示商品列表
	 * @return  void
	 */
	public function lst(){		
		$model=D('Goods');
		$data=$model->search();
		$this->assign(array(
			'data'=>$data['data'],
			'page'=>$data['page']
		));
		$this->display();
	}

	/**
	 * 删除商品
	 */
	public function delete(){
		$model=D('Goods');
		if($model->delete(I('get.id', 0)) !== FALSE){
			$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
			exit;
		}else{
			$this->error($model->getError());
		}
	}

	/**
	 * 修改商品
	 * @return [type] [description]
	 */
	public function edit(){
		$id = I('get.id');
		if(IS_POST){
			$model = D('Goods');
			if($model->create(I('post.'), 2)){
				if($model->save() !== FALSE){
					$this->success('修改成功！',U('lst', array('p' => I('get.p', 1))));
					exit;
				}
				
			}
			$this->error($model->getError());
		}
		$model = M('Goods');
		$data = $model->find($id);
		$this->assign('data',$data);
		$this->display();
	}

	/**
	 * AJAX获取商品属性
	 * @return [type] [description]
	 */
	public function ajaxGetAttr(){
		$type_id=I('get.type_id');
		// 取出属性
		$attrData=M('Attr')->where(array('type_id'=>$type_id))->select();
		echo json_encode($attrData);
	}



	
}