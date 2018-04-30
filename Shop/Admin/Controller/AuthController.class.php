<?php
namespace Admin\Controller;
class AuthController extends BaseController
{
	public function add()
	{
		if(IS_POST)
		{
			$model = D('Admin/Auth');
			if($model->create(I('post.'), 1))
			{
				if($id = $model->add())
				{
					$this->success('添加成功！', U('lst?p='.I('get.p')));
					exit;
				}
			}
			$this->error($model->getError());
		}
		$parentModel = D('Admin/Auth');
		$prentData = $parentModel->getTree();
		$this->assign('parentData', $parentData);

		// $this->setPageBtn('添加权限', '权限列表', U('lst?p='.I('get.p')));
		$this->display();
	}

	public function lst(){
		$model = D('Admin/Auth');
		$data = $model->getTree();
		$this->assign(array(
			'data' => $data,
		));
		// dump($data);
		$this->display();
	}

	public function edit(){
		$id = I('get.id');
		if(IS_POST){
			$model = D('Admin/Auth');
			if($model->create(I('post.'), 2))
			{
				if($model->save() !== FALSE)
				{
					$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
					exit;
				}
			}
			$this->error($model->getError());
		}
		$modle = M('Auth');
		$data = $modle->find($id);
		$this->assign('data',$data);
		$parentModel = D('Admin/Auth');
		$parentData = $parentModel->getTree();
		$children = $parentModel->getChildren($id);
		$this->assign(array(
			'parentData' => $parentData,
			'children'   => $children,
		));
		dump($data);
		dump($parentData);
		dump($children);
		$this->display();
	}
	public function delete()
	{
		$model = D('Admin/Auth');
		if($model->delete(I('get.id', 0)) !== FALSE)
		{
			$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
			exit;
		}
		else
		{
			$this->error($model->getError());
		}
	}
}








