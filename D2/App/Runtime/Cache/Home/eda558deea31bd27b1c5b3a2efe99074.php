<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
 <head>
	<meta charset="UTF-8">
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"> 
	<meta name="renderer" content="webkit">
	<title>订单提交成功</title>
    <link rel="shortcut icon" type="image/x-icon" href="/D2/Public/Home-icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/base.css">
	<link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/home.css">
	<script type="text/javascript" src="/D2/Public/Home-js/jquery.js"></script>
	<script type="text/javascript" src="/D2/Public/Home-js/js-tab.js"></script>
    <script>
         $(function(){

             $("#H-table li").each(function(i){
                 $(this).click((function(k){
                     var _index = k;
                     return function(){
                         $(this).addClass("cur").siblings().removeClass("cur");
                         $(".H-over").hide();
                         $(".H-over:eq(" + _index + ")").show();
                     }
                 })(i));
             });
             $("#H-table1 li").each(function(i){
                 $(this).click((function(k){
                     var _index = k;
                     return function(){
                         $(this).addClass("cur").siblings().removeClass("cur");
                         $(".H-over1").hide();
                         $(".H-over1:eq(" + _index + ")").show();
                     }
                 })(i));
             });
         });
     </script>
    <script type="text/javascript">
         (function(a){
             a.fn.hoverClass=function(b){
                 var a=this;
                 a.each(function(c){
                     a.eq(c).hover(function(){
                         $(this).addClass(b)
                     },function(){
                         $(this).removeClass(b)
                     })
                 });
                 return a
             };
         })(jQuery);

         $(function(){
             $("#pc-nav").hoverClass("current");
         });
     </script>

 </head>
 


<header id="pc-header">

<!-- 购物车顶部 -->
    <div class="BHeader">
        <div class="yNavIndex" style="margin-top: -5px">
            <ul class="BHeaderl">
                <?php if(empty($_SESSION['HomeUser'])): ?><li><a href="<?php echo U('Login/login');?>" style="color:#ea4949;">亲，请登录</a> </li>
                    <li class="headerul">|</li>
                    <li><a href="<?php echo U('Login/register');?>">免费注册</a> </li>
                    <li class="headerul">|</li>
                <?php else: ?>
                    <li><span>欢迎您：<?php echo ($_SESSION['HomeUser']['username']); ?></span></li>
                     <li><a href="<?php echo U('Login/logout');?>">退出登录</a> </li>
                    <li class="headerul">|</li><?php endif; ?>
                <li id="pc-nav" class="menu"><a class="tit">我的商城</a>
                    <div class="subnav">
                        <a href="<?php echo U('Order/order');?>">我的订单</a>
                        <a href="<?php echo U('Collect/collect');?>">我的收藏</a>
                        <a href="<?php echo U('Safe/safe');?>">账户安全</a>
                        <a href="<?php echo U('Address/address');?>">地址管理</a>
                        <a href="<?php echo U('Feedback/Feedback');?>">意见反馈</a>
                    </div>
                </li>
                <li class="headerul">|</li>
                <li id="pc-nav1" class="menu"><a href="#" class="tit M-iphone">手机悦商城</a>
                   <div class="subnav">
                       <a href="#"><img src="/D2/Public/Home-icon/ewm.png" width="115" height="115" title="扫一扫，有惊喜！"></a>
                   </div>
                </li>
            </ul>
        </div>
    </div>
<!-- 搜索框 -->

    <div class="container clearfix">
        <div class="header-logo fl" style="width:212px;"><h1><a href="<?php echo U('Index/index');?>"><img src="/D2/Public/Home-icon/logo.png"></a></h1></div>
        <div class="pc-order-titlei fl"><h2>填写订单</h2></div>
        <div class="pc-step-title fl">
            <ul>
                <li class="cur2"><a href="#">1 . 我的购物车</a></li>
                <li class="cur2"><a href="#">2 . 填写核对订单</a></li>
                <li class="cur"><a href="#">3 . 成功提交订单</a></li>
            </ul>
        </div>
    </div>


<!-- 订单提交成功 begin-->
<section>
    <div class="containers">
        <div class="pc-order-title"><h3>您的订单已提交成功!</h3></div>
        <div class="pc-border">
            <div class="pc-order-text">
                <p>订单提交成功，请您尽快付款！   订单号 ：<em><?php echo ($info['oid']); ?></em></p>
                <p class="reds">请您在提交订单后24小时内完成付款，否则订单自动取消。</em></p>
            </div>
            <div class="pc-line"></div>
            <div class="pc-order-text">
                <p>收货地址：<?php echo ($info['address']); ?> 收货人：<?php echo ($info['receiver']); ?> <?php echo (substr_replace($info['phone'],'****',3,4)); ?></p>
            </div>
        </div>
    </div>
</section>
<!-- 订单提交成功 End-->

<div class="pc-buying clearfix" style="margin-top:30px">
    <div class="time-list time-list-w fl">
        <div class="time-title">
            <ul class="brand-tab H-table H-table-shop clearfix fl" id="H-table">
                <li class="cur"><a href="javascript:void(0);" class="cur">支付宝</a></li>
                <li><a href="javascript:void(0);">储蓄卡</a></li>
                <li><a href="javascript:void(0);">信用卡</a></li>
            </ul>
            <span class="pc-order-price">总价：￥<?php echo ($info['total']); ?></span>
        </div>
        <div class="time-border time-border-h clearfix">
            <div class="time-border-list pc-shop-clear pc-order-clear H-over clearfix">
                <ul class="pc-order-list clearfix">
                    <li><a href="#"><img src="theme/bank/1.png"></a> </li>

                </ul>
            </div>
            <div style="display:none;" class="time-border-list  pc-shop-clear pc-order-clear H-over clearfix">
                <ul class="pc-order-list">
                <li><a href="#"><img src="theme/bank/1.png"></a> </li>
                </ul>
            </div>
            <div style="display:none;" class="time-border-list  pc-shop-clear pc-order-clear H-over clearfix">
                <ul class="pc-order-list">
                <li><a href="#"><img src="theme/bank/1.png"></a> </li>
                </ul>
            </div>
            <div class="pc-order-go"><a href="<?php echo U('Order/paySuccess');?>?mark=true&oid=<?php echo ($info['oid']); ?>">去网银支付</a></div>
        </div>
    </div>
</div>

<div class="aui-footer-bot">
    <div class="time-lists aui-footer-pd clearfix">
        <div class="aui-footer-list clearfix">
            <h4>
                <span><img src="/D2/Public/Home-icon/icon-d1.png"></span>
                <em>消费者权益</em>
            </h4>
            <ul>
                <li><a href="#">保障范围 </a> </li>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">服务中心 </a> </li>
                <li><a href="#">服务中心</a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
            </ul>
        </div>
        <div class="aui-footer-list clearfix">
            <h4>
                <span><img src="/D2/Public/Home-icon/icon-d2.png"></span>
                <em>新手上路</em>
            </h4>
            <ul>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">服务中心 </a> </li>
                <li><a href="#">服务中心</a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
            </ul>
        </div>
        <div class="aui-footer-list clearfix">
            <h4>
                <span><img src="/D2/Public/Home-icon/icon-d3.png"></span>
                <em>保障正品</em>
            </h4>
            <ul>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">服务中心 </a> </li>
                <li><a href="#">服务中心</a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
            </ul>
        </div>
        <div class="aui-footer-list clearfix">
            <h4>
                <span><img src="/D2/Public/Home-icon/icon-d1.png"></span>
                <em>消费者权益</em>
            </h4>
            <ul>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">服务中心 </a> </li>
                <li><a href="#">服务中心</a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
            </ul>
        </div>
    </div>
    <div style="border-bottom:1px solid #dedede"></div>
    <div class="time-lists aui-footer-pd time-lists-ls clearfix">
        <div class="aui-footer-list clearfix">
            <h4>购物指南</h4>
            <ul>
                <li><a href="#">保障范围 </a> </li>
                <li><a href="#">购物流程</a> </li>
                <li><a href="#">会员介绍 </a> </li>
                <li><a href="#">生活旅行</a> </li>
                <li><a href="#"> 常见问题 </a> </li>
                <li><a href="#"> 联系客服购物指南 </a> </li>
            </ul>
        </div>
        <div class="aui-footer-list clearfix">
            <h4>特色服务</h4>
            <ul>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">服务中心 </a> </li>
                <li><a href="#">服务中心</a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
            </ul>
        </div>
        <div class="aui-footer-list clearfix">
            <h4>帮助中心</h4>
            <ul>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">服务中心 </a> </li>
                <li><a href="#">服务中心</a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
            </ul>
        </div>
        <div class="aui-footer-list clearfix">
            <h4>新手指导</h4>
            <ul>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">退货退款流程</a> </li>
                <li><a href="#">服务中心 </a> </li>
                <li><a href="#">服务中心</a> </li>
                <li><a href="#">服务中心</a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
                <li><a href="#"> 更多特色服务 </a> </li>
            </ul>
        </div>
    </div>
</div>




<script type="text/javascript">banner()</script>
</body>
</html>