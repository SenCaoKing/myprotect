<?php
namespace Admin\Model;
use Think\Model;

class BrandModel extends Model{

	// 在添加时调用create方法时允许接收的字段
	protected $insertFields = array('type_name');
	// 在修改时调用create方法时允许接收的字段
	protected $updateFields = array('id','type_name');
	// 自动验证
	protected $_validate = array( //未完
		array('type_name', 'require', '商品类型不能为空！', 1, 'regex', 3),
		array('type_name', '1,30', '商品类型的值最长不能超过 30 个字符！', 1, 'length', 3),
	);
    public function search($pageSize = 10){
        /************ 搜索 ****************/
        $where = array();
        if($type_name = I('get.type_name'))
            $where['type_name'] = array('like', "%$type_name%");
        /************ 分页 ****************/
        $count = $this->alias('a')->where($where)->count();
        $page = new \Think\Page($count, $pageSize);
        // 设置分页的样式
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $data['page'] = $page->show();
         /************ 取数据 ****************/
         $data['data'] = $this->alias('a')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
         return $data;
    }
   

}
