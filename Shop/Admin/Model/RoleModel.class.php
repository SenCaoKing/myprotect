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
        // 方法①
        $data = $this->select(); // 角色的信息
        $auth=M('Auth');
        $authData=$auth->field('id,auth_name')->select(); // 查找所有权限的信息
        foreach ($data as $k => $v) {
            $auth_names='';
            foreach ($authData as $key => $value) {
                if(strpos(','.$v['auth_id'].',',','.$value['id'].',')!==false){
                    $auth_names.=','.$value['auth_name'];
                }
            }
            $data[$k]['auth_names']=substr($auth_names,1);
        }
        return $data;
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
        $roleData=array(
            'role_name'=>$data['role_name'],
            'auth_id'=>$auth_ids
        );
        if($this->create($roleData,1)){
            return $this->add($roleData)?1:0;
        }else{
            return 0;
        }
    }

    /**
     * 编辑角色
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function updateRole($data){
        if(empty($data['auth_id'])){
            $this->error='权限不能为空！';
            return 0;
        }
        $auth_ids=implode(',', $data['auth_id']);
        $roleData=array(
            'id'        => $data['id'],
            'role_name' => $data['role_name'],
            'auth_id'   => $auth_ids
        );
        if($this->create($roleData, 2)){
            return $this->save($roleData)?1:0;
        }else{
            return 0;
        }
    }

    /**
     * 删除角色
     * @param  [type] $id [description]
     * @return int
     */
    public function deleteRole($id){
        $admin=M('Admin');
        $role_ids=$admin->field('role_id')->select();
        foreach($role_ids as $k => $v){
            // 如果有管理员属于该角色，则返回0
            if(strpos(','.$v['role_id'].',',','.$id.',')!==false){
                $this->error='有管理员属于该角色，无法删除';
                return 0;
            }
        }
        return $this->delete($id);
    }






}
