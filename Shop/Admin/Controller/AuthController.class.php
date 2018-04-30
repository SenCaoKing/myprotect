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
		$this->display();
	}

	public function edit(){
		$this->display();
	}



}








