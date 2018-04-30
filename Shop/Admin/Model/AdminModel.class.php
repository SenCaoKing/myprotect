<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
    protected $insertFields = array();
    protected $updateFields = array('id');
    protected $_validate = array(
    );

    public function search($pageSize = 20){
        /**************************** 搜索 *************************************/
        $where = array();
        /**************************** 分页 *************************************/
        $count = $this->alias('a')->where($where)->count();
        $page = new \Think\Page($count, $pageSize);
        // 配置分页的样式
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $data['page'] = $page->show();
        /*************************** 取数据 ************************************/
        $data['data'] = $this->alias('a')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
        return $data;
    }
    


    // 添加前
    protected function _before_insert(&$data, $option){

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
