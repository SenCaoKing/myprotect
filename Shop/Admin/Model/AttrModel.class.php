<?php
namespace Admin\Model;
use Think\Model;
class AttrModel extends Model{

	// 在添加时调用create方法时允许接收的字段
	protected $insertFields = array('type_id','attr_name','attr_type','attr_option_values');
	// 在修改时调用create方法时允许接收的字段
	protected $updateFields = array('id','type_id','attr_name','attr_type','attr_option_values');
	// 自动验证
	protected $_validate = array(
		array('type_id', 'require', '所在的类型的id不能为空！', 1, 'regex', 3),
        array('type_id', 'number', '所在的类型的id必须是一个整数！', 1, 'regex', 3),
        array('attr_name', 'require', '属性名不能为空！', 1, 'regex', 3),
        array('attr_name', '1,30', '属性名的值最长不能超过 30 个字符！', 1, 'length', 3),
        array('attr_type', 'require', '属性的类型0：唯一 1：可选不能为空！', 1, 'regex', 3),
        array('attr_type', 'number', '属性的类型0：唯一 1：可选必须是一个整数！', 1, 'regex', 3),
        array('attr_option_values', 'require', '属性的可选值，多个可选值用，隔开不能为空！', 1, 'regex', 3),
        array('attr_option_values', '1,150', '属性的可选值，多个可选值用，隔开最长不能超过 150 个字符！', 1, 'length', 3),
	);

	//自动完成,下面的情况会失效
    // protected $_auto = array(
    //     array('addtime','time',self::MODEL_INSERT,'function'),
    // );





}
