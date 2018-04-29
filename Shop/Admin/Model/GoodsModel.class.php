<?php
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{

	// 在添加时调用create方法时允许接收的字段
	protected $insertFields = array('goods_name','price','goods_desc','is_on_sale'); //未完
	// 在修改时调用create方法时允许接收的字段
	protected $updateFields = array('id','goods_name','price','goods_desc','is_on_sale'); //未完
	// 自动验证
	protected $_validate = array( //未完
		array('goods_name', 'require', '商品名称不能为空！', 1),
		array('goods_name', '1,45', '商品名称必须是1-45个字符！', 1, 'length'),
		array('price','currency','价格必须是货币格式', 1),
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
    public function addGoods($data){
        if($this->create($data, 1)){
            $data['addtime']=time();
            $arr=$this->uploadLogo();
            if($arr['status']=='200'){
                $data['logo']=$arr['source'];
                $data['sm_logo']=$arr['thumb'];
                return $this->add($data) ? 1 : 0;
            }else{
                $this->error=$arr['message'];
                return false;
            }
        }
    }

    /**
     * 上传商品的logo
     * @return array
     */
    private function uploadLogo(){
        $Upload = new \Think\Upload();
        $Upload->rootPath = C('UPLOAD_PATH'); // 配置上传图片的根目录
        $Upload->maxSize = (int)C('IMG_maxSize')*1024*1024; // 配置上传图片的最大值
        $Upload->exts = C('IMG_exts'); // 配置上传图片的后缀名
        $info = $Upload->upload(); // 得到上传图片的信息
        dump($info);
        if($info){
            $savePath = $info['logo']['savepath']; // 得到图片的保存路径
            $saveName = $info['logo']['savename']; // 得到图片的保存名称
            $imgPath = C('UPLOAD_PATH').$savePath.$saveName; // 得到图片的地址
            // 生成缩略图
            $image = new \Think\Image();
            $image->open($imgPath);
            $thumbPath = C('UPLOAD_PATH').$savePath.'thumb_'.$saveName; // 缩略图地址
            $image->thumb(150,150)->save($thumbPath);
            return array('status'=>200,'source'=>$imgPath, 'thumb'=>$thumbPath);
        }else{
            return array('status'=>400,'message'=>$Upload->getError());
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



}


