<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 登录验证控制器
 */
class LoginController extends Controller {

    /**
     * 后台登录
     * @return [type] [description]
     */
    public function login(){
        if(IS_POST){
            $model=D('Admin');
            if($model->login(I('post.'))){
                $this->redirect('Admin/Index/index');
            }else{
                // 调用控制器的error方法
                $this->error($model->getError());
            }
        }
        $this->display();
    }

    /**
     * 生成图片验证码
     * @return [type] [description]
     */
    public function chkcode(){
        $verify=new \Think\Verify(array('imageH'=>50, 'imageW'=>142, 'length'=>3));
        $verify=entry();
    }


	
	
}