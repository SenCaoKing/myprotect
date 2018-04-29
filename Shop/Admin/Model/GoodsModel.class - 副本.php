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
     * 发布商品信息
     * @param  $data
     * @return int
     */
    // public function addGoods($data){
    // 	if($this->create($data, 1)){
    // 		$data['addtime']=time();
    // 		$arr=$this->uploadLogo();

    // 		dump($arr);
    // 		if($arr['status']=='200'){
    // 			$data['logo']=$arr['source'];
    // 			$data['sm_logo']=$arr['thumb'];
    // 			return $this->add($data) ? 1 : 0;
    // 		}else{
    // 			$this->error=$arr['message'];
    // 			return false;
    // 		}
    // 	}
    // }

    /**
     * 上传商品的logo
     * @return  array
     */
    // private function uploadLogo(){
    // 	$Upload = new \Think\Upload();
    // 	$Upload->rootPath = C('UPLOAD_PATH'); //配置上传图片的根目录
    // 	$Upload->maxSize = (int)C('IMG_maxSize')*1024*1024; //配置上传图片的最大值
    // 	$Upload->exts = C('IMG_exts'); //配置上传图片的后缀名
    // 	$info =  $Upload->upload(); //得到上传图片的信息
    // 	if($info){
    // 		$savePath = $info['logo']['savepath']; //得到图片的保存路径
    // 		$saveName = $info['logo']['savename']; //得到图片的保存名称
    // 		$imgPath = C('UPLOAD_PATH').$savePath.$saveName; //得到图片的地址
    // 		//生成缩略图
    // 		$image = new \Think\Image();
    // 		$image->open($imgPath);
    // 		$thumbPath = C('UPLOAD_PATH').$savePath.'thumb_'.$saveName; //缩略图地址
    // 		$image->thumb(150,150)->save($thumbPath);
    // 		return array('status'=>'200','source'=>$imgPath,'thumb'=>$thumbPath);
    // 	}else{
    // 		return array('status'=>'400','message'=>$Upload->getError());
    // 	}
    // }
    



	/**
	 * 添加前的回调方法
	 * @param  [type] $data   收集的表单信息
	 * @param  [type] &$data  "引用"传递，函数内部改变之，外边也可以访问到
	 * @param  [type] $option 设置的各种条件
	 * @return [type]         [description]
	 */
	protected function _before_insert(&$data, $options){
		$promote_start_time=I('post.promote_start_time');
		$promote_end_time=I('post.promote_end_time');
		$data['promote_start_time']=strtotime("$promote_start_time 00:00:00");
		$data['promote_end_time']=strtotime("$promote_end_time 00:00:00");
		// 上传图片处理
		if($_FILES['logo']['error'] === 0)//图片没有错误才处理
		{
			// 1) 上传原图图片
			//通过Think/Upload.class.php实现附件上传
			$cfg = array(
				'rootPath'   => './Public/Uploads/', //保存根路径
			);
			$up = new \Think\Upload($cfg);
			$z = $up -> uploadOne($_FILES['logo']);
			// $z会返回成功上传附件的相关信息
			// dump($z);
			
			// 拼装图片的路径名信息，存储到数据库里边
			$big_path_name = $up->rootPath.$z['savepath'].$z['savename'];
			$data['logo'] = $big_path_name;

			// 2) 根据原图($big_path_name)制作缩略图
			$im = new \Think\Image();//实例化对象
			$im -> open($big_path_name);//打开原图
			$im -> thumb(60,60);//制作缩略图
			// 缩略图名字："small_原图名字"
			$small_path_name = $up->rootPath.$z['savepath']."small_".$z['savename'];
			$im -> save($small_path_name);//存储缩略图到服务器
			// 保存缩略图到数据库
			$data['sm_logo'] = $small_path_name;
		}
	}

	/**
	 * 修改商品信息
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function update($data){
		if($this->create($data,2)){
			return ($this->save($data)!==false)?1:0;
		}
	}

	/**
	 * 钩子函数，在修改信息前删除以前的图片以及上传新的图片
	 * @param  [type] &$data  [description]
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	protected function _before_update(&$data,$option){
		// $Upload = new \Think\Upload();
		 	$Upload = new \Think\Upload();
		$Upload->rootPath = C('UPLOAD_PATH');  //配置上传图片的根目录
		$Upload->maxSize = (int)C('IMG_maxSize')*1024*1024;  //配置上传图片的最大值
		$Upload->exts = C('IMG_exts'); //配置上传图片的后缀名
		$info = $Upload->upload();   //得到上传图片的信息
		if ($info) {
			$savePath = $info['logo']['savepath']; //得到图片的保存路径
			$saveName = $info['logo']['savename'];  //得到图片的保存名称
			$imgPath = C('UPLOAD_PATH').$savePath.$saveName; //得到图片的地址
			//生成微缩图
			$image = new \Think\Image();
			$image->open($imgPath);
			$thumbPath = C('UPLOAD_PATH').$savePath.'thumb_'.$saveName; //微缩图地址
			$image->thumb(150,150)->save($thumbPath);
			$data['logo']=$imgPath;
			$data['sm_logo']=$thumbPath;
			//删除原来的图片
				//先根据商品的id取出图片的路径
			$logo=$this->field('logo,sm_logo')->where($option['where']['id'])->find();
    		unlink($logo['logo']);
   		unlink($logo['sm_logo']);
		}
	} 



}


