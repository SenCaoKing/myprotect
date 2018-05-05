<?php
namespace Admin\Controller;
class AttrController extends BaseController{
	public function add(){
		if(IS_POST){
			$model = D('Admin/Attr');
			if($model->create(I('post.'), 1)){
				if($id = $model->add()){
					$this->success('添加成功！', U('lst?p='.I('get.p')));
					exit;
				}
			}
			$this->error($model->getError());
		}
		$this->display();
	}
	
	public function lst(){
		$this->display();
	}

	public function edit(){
		$this->display();
	}



	
}








