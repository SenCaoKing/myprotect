<?php
namespace Admin\Model;
use Think\Model;

class AuthModel extends Model
{
	protected $insertFields = array('auth_name','module_name','controller_name','action_name','pid');
	protected $updateFields = array('id','auth_name','module_name','controller_name','action_name','pid');
	protected $_validate = array( //未完
		array('auth_name', 'require', '权限名称不能为空！', 1, 'regex', 3),
		array('auth_name', '1,30', '权限名称的值最长不能超过 30 个字符！', 1, 'length', 3),
        array('module_name', 'require', '模块名称不能为空！', 1, 'regex', 3),
        array('module_name', '1,10', '模块名称的值最长不能超过 10 个字符！', 1, 'length', 3),
        array('controller_name', 'require', '控制器名称不能为空！', 1, 'regex', 3),
        array('controller_name', '1,10', '控制器名称的值最长不能超过 10 个字符！', 1, 'length', 3),
        array('action_name', 'require', '方法名称不能为空！', 1, 'regex', 3),
        array('action_name', '1,10', '方法名称的值最长不能超过 10 个字符！', 1, 'length', 3),
        array('pid', 'number', '上级权限的ID，0：代表顶级权限必须是一个整数！', 2, 'regex', 3),
	);
    /************************************* 递归相关方法 *************************************/
    public function getTree()
    {
        $data = $this->select();
        return $this->_reSort($data);
    }
    private function _reSort($data, $parent_id=0, $level=0, $isClear=TRUE)
    {
        static $ret = array();
        if($isClear)
            $ret = array();
        foreach($data as $k => $v)
        {
            if($v['pid'] == $parent_id)
            {
                $v['level'] = $level;
                $ret[] = $v;
                $this->_reSort($data, $v['id'], $level+1, FALSE);
            }
        }
        return $ret;
    }




}






