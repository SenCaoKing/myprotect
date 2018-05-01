<?php
namespace Admin\Controller;
/**
 * 管理员控制器
 */
class AdminController extends BaseController{

    /**
     * 管理员列表
     */
	public function lst(){
        $model = M('Admin');
        $data = $model->select();
        $this->assign('data',$data);
		$this->display();
	}

    /**
     * 添加管理员
     */
	public function add(){
        if(IS_POST){
            $model = D('Admin');
            if($model->create(I('post.'), 1)){
                if($id = $model->add()){
                    $this->success('添加成功', U('lst?p='.I('get.p')));
                    exit;
                }
            }
            $this->error($model->getError());
        }
		$this->display();
	}

	public function edit(){
        $id = I('get.id');
        if(IS_POST){
            $model = D('Admin');
            if($model->create(I('post.'), 2)){
                if($id = $model->save() !== FALSE){
                    $this->success('修改成功', U('lst', array('p'=>I('get.p', 0))));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $model = M('Admin');
        $data = $model->find($id);
        $this->assign('data', $data);
		$this->display();
	}

    public function delete(){
        $model = D('Admin');
        if($model->delete(I('get.id', 0)) !== FALSE){
            $this->success('删除成功！', U('lst', array('p'=>I('get.p'))));
            exit;
        } else {
            $this->error($model->getError());
        }
    }




}