<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model{
    protected $insertFields = array('role_name','auth_id');
    protected $updateFields = array('id','role_name','auth_id');
	protected $_validate = array(
		array('role_name', 'require', '角色名称不能为空！', 1, 'regex', 3),
		array('role_name', '1,30', '角色名称的值最长不超过30个字符！', 1, 'length', 3)
	);

    /**
     * 查找角色及所拥有的权限
     * @return [type] [description]
     */
    public function searchRole(){
        $results=array();
        if(empty($results)){
            $roles=$this->select(); // 角色的信息
            foreach($roles as $role){
                $admin=M('Auth');
                $map['id']=array('in',$role['auth_id']);
                $auth_names_array=$admin->field('auth_name')->where($map)->select();
                $auth_names='';
                foreach($auth_names_array as $k){
                    $auth_names.=','.$k['auth_name'];
                }
                $results[$role['id']]['role_name']=$role['role_name'];
                $results[$role['id']]['auth_name']=substr($auth_names,1);
            }
            return $results;
        }
    }

    /**
     * 添加角色
     * @return [type] [description]
     */
    public function addRole($data){
        if(empty($data['auth_id'])){
            $this->error='权限不能为空！';
            return;
        }
        $auth_ids=implode(',', $data['auth_id']);
        $roledate=array(
            'role_name'=>$data['role_name'],
            'auth_id'=>$auth_ids
        );
        if($this->create($roledata,2)){
            return $this->add($roledata)?1:0;
        }else{
            return 0;
        }
    }

    // 修改前
    protected function _before_update(&$data, $option){
        
    }

    // 删除前
    protected function _before_delete($option){
        if(is_array($option['where']['id'])){
            $this->eror = '不支持批量删除';
            return FALSE;
        }
    }






}
