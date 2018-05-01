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
            $model=M('Admin');
            // 动态验证，由于模型里有两个规则，所以需要使用create的第二个参数
            // 7我们自己规定，代表登录说明这个表单是登录的表单
            if($model->validate($model->rules)->create('',7)){
                if($model->login(I('post.'))){
                    $this->redirect('Admin/Index/index');
                }else{
                    // 调用控制器的error方法
                    $this->error($model->getError());
                }
            }
        }
        if(session('id')){ // 如果已经登录
            $this->redirect('Admin/Index/index');
            return;
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