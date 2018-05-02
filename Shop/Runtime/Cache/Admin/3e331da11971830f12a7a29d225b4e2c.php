<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 编辑角色</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
    <!-- 其他样式 -->
    
    <script type="text/javascript">
        $(function(){
            // JS智能选择
            // 为所有的选择框绑定点击事件
            $(":checkbox").click(function(){
                var _this=this;
                // 先取出当前权限的auth_level值是多少
                var cur_level = $(this).attr("auth_level");
                var tmplevel = cur_level; // 给一个临时的变量后面要进行减操作
                // 先取出这个复选框所有前面的复选框
                var allprev = $(this).prevAll(":checkbox");
                // 循环每一个前面的复选框判断是不是上级的
                $(allprev).each(function(k,v){
                    // 判断是不是上级的权限
                    if($(v).attr("auth_level") < cur_level){
                        $(v).get(0).checked=$(_this).get(0).checked;
                        tmplevel--; // 再向上提一级
                    }
                });
                // 所有子权限也选中
                // 先取出这个复选框所有前面的复选框
                var allnext = $(this).nextAll(":checkbox");
                // 循环每一个前面的复选框判断是不是上级的
                $(allnext).each(function(k,v){
                    // 判断是不是上级的权限
                    if($(v).attr("auth_level") > cur_level){
                        $(v).get(0).checked=$(_this).get(0).checked;
                        tmplevel++;
                    }else{return false;}
                    // 遇到一个平级的权限就停止循环后面的不用再哦安短了


                    
                });
            });
        });
    </script>

</head>
<body>
<h1 style="font-size: 14px;">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf;">管理中心</a></span>

    <!--具体操作-->
    
    <span class="action-span"><a href="<?php echo U('lst');?>">返回</a></span>
    <span id="search_id"> - 编辑角色</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="main-div">
        <form method="POST" style="margin:5px;" action="/Admin/Role/edit/id/2.html">
            <input type="hidden" value="<?php echo ($data['id']); ?>" name="id" />
            <p>角色名称：<input type="text" name="role_name" value="<?php echo ($data['role_name']); ?>" /></p>
            <p>为该角色修改分配的权限：
                <div class="alert alert-info">
                    <?php if(is_array($data1)): $i = 0; $__LIST__ = $data1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i; echo str_repeat('-',$obj['auth_level']*8);?>
                        <input type="checkbox" name="auth_id[]" style="margin:5px;" value="<?php echo ($obj["id"]); ?>" level="auth_level" 
                        <?php if(strpos($data['auth_id'],$obj['id'])!==false) echo "checked"; ?>
                         ><?php echo ($obj["auth_name"]); endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </p>
            <input type="submit" class="btn btn-primarty" value="确定" />
        </form>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>