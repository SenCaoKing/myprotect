<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model{
	// 在添加时调用create方法时允许接收的字段
	protected $insertFields = array('goods_name','price','goods_desc','is_on_sale'); //未完
	// 在修改时调用create方法时允许接收的字段
	protected $updateFields = array('id','goods_name','price','goods_desc','is_on_sale'); //未完
	/**
	 * 自动验证字段
	 * @var  array
	 */
	protected $_validate = array( //未完
		array('goods_name', 'require', '商品名称不能为空！', 1, 'regex', 3),
		array('goods_name', '1,45', '商品名称的值最长不能超过 45 个字符！', 1, 'length', 3),
		array('price','currency','价格必须是货币格式'),
		array('is_on_sale','0,1','是否上架只能是0,1两个值',1,'in'),
	);

	//自动完成,下面的情况会失效
    protected $_auto = array(
        array('addtime','time',self::MODEL_INSERT,'function'),
    );	

    /**
     * 插入数据前的回调方法
     * @param  [type] $data    收集的表单信息[&$data "引用传递，函数内部改变之，外边也可以访问到"]
     * @param  [type] $options 设置的各种条件
     * @return [type]          [description]
     */
    protected function _before_insert(&$data,$options){
    	$promote_start_time=I('post.promote_start_time');
		$promote_end_time=I('post.promote_end_time');
		$data['promote_start_time']=strtotime("$promote_start_time 00:00:00");
		$data['promote_end_time']=strtotime("$promote_end_time 00:00:00");
    	// 上传图片处理
    	if($_FILES['logo']['error']===0){ // 图片没有错误才处理
    		// 1) 上传原图图片[通过Think/Upload.class.php实现附件上传]
    		$cfg = array(
    			'rootPath'		=> './Public/Uploads/', // 保存根路径
    		);
    		$upload = new \Think\Upload($cfg);

    		$uploadInfo = $upload->uploadOne($_FILES['logo']); // $z会返回成功上传附件的相关信息
    		// dump($uploadInfo);exit;

    		// 拼装图片的路径名信息，存储到数据库里边
    		$big_path_name = $upload->rootPath.$uploadInfo['savepath'].$uploadInfo['savename'];
    		$data['logo'] = $big_path_name;

    		// 2) 根据原图($big_path_name)制作缩略图
    		$image = new \Think\Image(); // 实例化对象
    		$image -> open($big_path_name); // 打开原图
  			$image -> thumb(150,150); // 制作缩略图
  			// 缩略图名字： "small_原图名字"
  			$small_path_name = $upload->rootPath.$uploadInfo['savepath']."small_".$uploadInfo['savename'];
  			$image -> save($small_path_name); // 存储缩略图到服务器
  			// 保存缩略图到数据库
  			$data['sm_logo'] = $small_path_name;
    	}
    }

    /**
     * 搜索商品(取数据，翻页，排序，搜索)
     * @return [type] [description]
     */
    public function search(){
    	/************ 搜索 ****************/
    	$where = array();
    	// 商品名称搜索
    	$goodsName = I('get.goods_name');
    	if($goodsName)
    		$where['goods_name'] = array('like', "%$goodsName%");
    	// 价格的搜索
    	$startPrice = I('get.start_price');
    	$endPrice = I('get.end_price');
    	if($startPrice && $endPrice)
    		$where['price'] = array('between', array($startPrice, $endPrice));
    	elseif ($startPrice)
    		$where['price'] = array('egt', $startPrice);
    	elseif ($endPrice)
    		$where['price'] = array('elt', $endPrice);
    	// 上架的搜索
    	$isOnSale = I('get.is_on_sale', -1);
    	if($isOnSale != -1)
    		$where['is_on_sale'] = array('eq', $isOnSale);
    	// 是否删除的搜索
    	$isDelete = I('get.is_delete', -1);
    	if($isDelete != -1)
    		$where['is_delete'] = array('eq', $isDelete);
    	// 时间的搜索
    	$start_addtime = I('get.start_addtime');
    	$end_addtime = I('get.end_addtime');
    	if($start_addtime&&$end_addtime){
    		$where['addtime'] = array('between',array(strtotime("$start_addtime 00:00:00"),strtotime("$end_addtime 23:59:59")));
    	}elseif($start_addtime){
    		$where['addtime'] = array('egt',strtotime("$start_addtime 00:00:00"));
    	}elseif($end_addtime){
    		$where['addtime'] = array('lt',strtotime("$end_addtime 23:59:59"));
    	}
    	/************ 排序 ****************/
    	$order="id asc";
    	if(I('get.odby')){
    		$order=str_replace('_',' ',I('get.odby'));
    	}
    	/************ 翻页 ****************/
    	// 总记录数
    	$count = $this->where($where)->count();
    	// 生成翻页对象
    	$page = new \Think\Page($count,10);
    	// 获取翻页字符串
    	$pageString = $page->show();
    	// 取出当前页的数据
    	$data = $this->where($where)->limit($page->firstRow.','.$page->listRows)->order($order)->select();
    	return array(
    		'page' => $pageString,
    		'data' => $data,
    	);


    }







	/**
	 * 修改商品信息
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	// public function update($data){
	// 	if($this->create($data,2)){
	// 		return ($this->save($data)!==false)?1:0;
	// 	}
	// }

	/**
	 * 钩子函数，在修改信息前删除以前的图片以及上传新的图片
	 * @param  [type] &$data  [description]
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	// protected function _before_update(&$data,$option){
	// 	// $Upload = new \Think\Upload();
	// 	 	$Upload = new \Think\Upload();
	// 	$Upload->rootPath = C('UPLOAD_PATH');  //配置上传图片的根目录
	// 	$Upload->maxSize = (int)C('IMG_maxSize')*1024*1024;  //配置上传图片的最大值
	// 	$Upload->exts = C('IMG_exts'); //配置上传图片的后缀名
	// 	$info = $Upload->upload();   //得到上传图片的信息
	// 	if ($info) {
	// 		$savePath = $info['logo']['savepath']; //得到图片的保存路径
	// 		$saveName = $info['logo']['savename'];  //得到图片的保存名称
	// 		$imgPath = C('UPLOAD_PATH').$savePath.$saveName; //得到图片的地址
	// 		//生成微缩图
	// 		$image = new \Think\Image();
	// 		$image->open($imgPath);
	// 		$thumbPath = C('UPLOAD_PATH').$savePath.'thumb_'.$saveName; //微缩图地址
	// 		$image->thumb(150,150)->save($thumbPath);
	// 		$data['logo']=$imgPath;
	// 		$data['sm_logo']=$thumbPath;
	// 		//删除原来的图片
	// 			//先根据商品的id取出图片的路径
	// 		$logo=$this->field('logo,sm_logo')->where($option['where']['id'])->find();
 //    		unlink($logo['logo']);
 //   		unlink($logo['sm_logo']);
	// 	}
	// } 



}


