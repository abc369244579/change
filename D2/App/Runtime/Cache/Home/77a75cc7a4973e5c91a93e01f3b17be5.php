<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>订单确定页</title>
<link href="/D2/Public/index_data/public.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/D2/Public/index_data/base.css">
<link rel="stylesheet" type="text/css" href="/D2/Public/index_data/checkOut.css">
<script type="text/javascript" src="/D2/Public/index_data/jquery_cart.js"></script> 
<link rel="shortcut icon" type="image/x-icon" href="/D2/Public/Home-icon/favicon.ico">
<link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/base.css">
<link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/home.css">
<script type="text/javascript" src="/D2/Public/Home-js/jquery.js"></script>
<script>
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

         $(document).ready(function($){

             $(".btn1").click(function(event){
                 $(".hint").css({"display":"block"});
                 $(".box").css({"display":"block"});
             });

             $(".hint-in3").click(function(event) {
                 $(".hint").css({"display":"none"});
                 $(".box").css({"display":"none"});
             });

             $(".hint3").click(function(event) {
                 $(this).parent().parent().css({"display":"none"});
                 $(".box").css({"display":"none"});
             });

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
                <li class="cur"><a href="#">2 . 填写核对订单</a></li>
                <li><a href="#">3 . 成功提交订单</a></li>
            </ul>
        </div>
    </div>


 <!--收货地址body部分开始-->  
 <div class="border_top_cart">
  <script type="text/javascript">
    var checkoutConfig={
        addressMatch:'common',
        addressMatchVarName:'data',
        hasPresales:false,
        hasBigTv:false,
        hasAir:false,
        hasScales:false,
        hasGiftcard:false,
        totalPrice:244.00,
        postage:10,//运费
        postFree:true,//活动是否免邮了
        bcPrice:150,//计算界值
        activityDiscountMoney:0.00,//活动优惠
        showCouponBox:0,
        invoice:{
            NA:"0",
            personal:"1",
            company:"2",
            electronic:"4"
        }
    };
    var miniCartDisable=true;
</script>
<div class="container">
    <div class="checkout-box">
        <form id="checkoutForm" action="<?php echo U('order/orderSuccess');?>" method="post">
            <div class="checkout-box-bd">
                    <!-- 地址状态 0：默认选择；1：新增地址；2：修改地址 -->
                <input  id="addrState" value="0" type="hidden">
                <!-- 收货地址 -->
                <div class="xm-box">
                    <div class="box-hd ">
    <h2 class="title">收货地址</h2>
    <!---->
</div>
<div class="box-bd">
    <div class="clearfix xm-address-list" id="checkoutAddrList">
     <?php if(is_array($default)): foreach($default as $k=>$vo): ?><dl class="item selected">
            <dt>
                <strong class="itemConsignee"><?php echo ($vo['linkman']); ?></strong>
                <span></span>
            </dt>
            <dd>
                <p class="tel itemTel"><?php echo ($vo['phone']); ?></p>
                <p class="itemRegion"><?php echo ($vo['address']); ?></p>
                <!-- <span class="edit-btn J_editAddr">编辑</span> -->
            </dd>
            <dd style="display:none">
                <input  class="addressId" value="10140916720030323" type="radio">
            </dd>
        </dl><?php endforeach; endif; ?>
    <?php if(is_array($address)): foreach($address as $k=>$vo): ?><dl class="item">
            <dt>
                <strong class="itemConsignee"><?php echo ($vo['linkman']); ?></strong>
                <span></span>
            </dt>
            <dd>
                <p class="tel itemTel"><?php echo ($vo['phone']); ?></p>
                <p class="itemRegion"><?php echo ($vo['address']); ?></p>
                <!-- <span class="edit-btn J_editAddr">编辑</span> -->
            </dd>
            <dd style="display:none">
                <input class="addressId" value="10140916720030323" type="radio">
            </dd>
        </dl><?php endforeach; endif; ?>
            <div class="item use-new-addr" id="J_useNewAddr" data-state="off">
             <span class="iconfont icon-add"><img src="/D2/Public/index_data/add_cart.png"></span> 
            使用新地址
        </div>
    </div>
    <!--点击弹出新增/收货地址界面start-->
    <div class="xm-edit-addr-box" id="J_editAddrBox">
        <div class="bd">
            <div class="item">
                <label>收货人姓名<span>*</span></label> 
                <input  id="Consignee" class="input" placeholder="收货人姓名" maxlength="15" autocomplete="off" type="text">
                <p class="tip-msg tipMsg"></p>
            </div>
            <div class="item">
                <label>联系电话<span>*</span></label> 
                <input  class="input" id="Telephone" placeholder="11位手机号" autocomplete="off" type="text">
                <p class="tel-modify-tip" id="telModifyTip"></p>
                <p class="tip-msg tipMsg"></p>
            </div>
            <div class="item">
                <label>地址<span>*</span></label>
                <select  id="Provinces" class="select-1">
                    <option value="0" selected="selected">省份/自治区</option>
                    <option  value="北京">北京</option><option zipcode="0" value="天津">天津</option><option zipcode="0" value="4">河北</option><option zipcode="0" value="5">山西</option><option zipcode="0" value="6">内蒙古</option><option zipcode="0" value="7">辽宁</option><option zipcode="0" value="8">吉林</option><option zipcode="0" value="9">黑龙江</option><option zipcode="0" value="10">上海</option><option zipcode="0" value="11">江苏</option><option zipcode="0" value="12">浙江</option><option zipcode="0" value="13">安徽</option><option zipcode="0" value="14">福建</option><option zipcode="0" value="15">江西</option><option zipcode="0" value="16">山东</option><option zipcode="0" value="17">河南</option><option zipcode="0" value="18">湖北</option><option zipcode="0" value="19">湖南</option><option zipcode="0" value="20">广东</option><option zipcode="0" value="21">广西</option><option zipcode="0" value="22">海南</option><option zipcode="0" value="23">重庆</option><option zipcode="0" value="24">四川</option><option zipcode="0" value="25">贵州</option><option zipcode="0" value="26">云南</option><option zipcode="0" value="27">西藏</option><option zipcode="0" value="28">陕西</option><option zipcode="0" value="29">甘肃</option><option zipcode="0" value="30">青海</option><option zipcode="0" value="31">宁夏</option><option zipcode="0" value="32">新疆</option></select>
                <select  id="Citys" class="select-2" disabled="disabled">
                    <option selected="selected">城市/地区/自治州</option>
                </select>
                <select  id="Countys" class="select-3" disabled="disabled">
                    <option selected="selected">区/县</option>
                </select>
                <textarea  class="input-area" id="Street" placeholder="路名或街道地址，门牌号"></textarea>
                <p class="tip-msg tipMsg"></p>
            </div>
            <div class="item">
                <label>邮政编码<span>*</span></label> 
                <input id="Zipcode" class="input" placeholder="邮政编码" autocomplete="off" type="text">
                <p class="zipcode-tip" id="zipcodeTip"></p>
                <p class="tip-msg tipMsg"></p>
            </div>
        </div>
        <div class="ft clearfix">
            <button type="button" class="btn btn-lineDake btn-small " id="J_editAddrCancel">取消</button>
             <button type="button" class="btn btn-primary  btn-small " id="J_editAddrOk">保存</button>
        </div>
    </div>
    <!--点击弹出新增/收货地址界面end-->
    <div class="xm-edit-addr-backdrop" id="J_editAddrBackdrop"></div>
</div>                
</div>
<!-- 收货地址 END-->
    </div>
            <div class="checkout-box-ft">
                 <!-- 商品清单 -->
                <div id="checkoutGoodsList" class="checkout-goods-box">
                                    <div class="xm-box">
                    <div class="box-hd">
                        <h2 class="title">确认订单信息</h2>
                    </div>
                    
                <table style="width:1200px;position:relative;margin-left:-87px;">
                    <tr>
                        <th><span>商品图片</span></th>
                        <th style="width:25%"><span>商品名称</span></th>
                        <th style="width:10%"><span>购买价格</span></th>
                        <th><span>购买数量</span></th>
                        <th><span>小计（元）</span></th>
                    </tr>
                <?php if(is_array($arr)): foreach($arr as $k=>$vo): ?><tr style="height:10px"></tr>
                        <tr class="info">
                            <td style="text-align: center"><span>
                                <img src="/D2/Public/Uploads/<?php echo ($vo['pic']); ?>" width="80" height="80">
                            </span></td>
                            <td style="text-align: center"><span><?php echo ($vo['name']); ?></a></span></td>
                            <td style="text-align: center"><span><?php echo ($vo['price']); ?>元</span></td>
                            <td style="text-align: center"><span class="num"><?php echo ($vo['num']); ?></span></td>
                            <td style="text-align: center"><span class="price"><?php echo ($vo['num']*$vo['price']); ?>.00元</span></td>
                        </tr><?php endforeach; endif; ?>
                       </table>
                        <div class="checkout-count clearfix">
                            <div class="checkout-count-extend xm-add-buy">
                                <h3 class="title">订单留言</h3><br>
                                <input type="text" name="message">
                            </div>
                            <!-- checkout-count-extend -->
                            <div class="checkout-price">
                                <ul>
                                    <li>
                                       订单总额：<span class="total"></span>
                                    </li>
                                   <?php if($role == 2): ?><li>
                                            会员减额:<span class="vip"></span>
                                        </li>
                                    <?php elseif($role == 3): ?>
                                        <li>
                                            会员减额:<span class="zuan"></span>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            会员减额:<span class="kong">0元</span>
                                        </li><?php endif; ?>
                                    <li>
                                        运费：<span id="postageDesc">0元</span>
                                    </li>
                                    <li>
                                        本次购物获得积分：<span class="getScore"></span>
                                    </li>
                                </ul>
                                <?php if($role == 2): ?><p class="checkout-total">应付总额：<span><strong id="vip-total"></strong>元</span></p>
                                <?php elseif($role == 3): ?>
                                <p class="checkout-total">应付总额：<span><strong id="zuan-total"></strong>元</span></p>
                                <?php else: ?>
                                <p class="checkout-total">应付总额：<span><strong id="kong-total"></strong>元</span></p><?php endif; ?>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
<input type="hidden" name="receiver" value="" id="receiver1"> 
<input type="hidden" name="phone" value="" id="phone1">
<input type="hidden" name="address" value="" id="address1">
<input type="hidden" name="total" value="" id="total1">
<input type="hidden" name="ids"  value="<?php echo I('ids');?>">
<input type="hidden" name="getScore" value="" id="getScore">
<script>
    //新增地址时获取信息
      $(document).on('blur','#Zipcode',function(){
            //收件人
            var receiver = $('.bd').children().eq(0).children().eq(1).val();
            //手机号码
            var phone = $('.bd').children().eq(1).children().eq(1).val();
            //三级联动地址
            var address1 = $('#Provinces option:selected').html();
            var address2 = $('#Citys option:selected').html();
            var address3 = $('#Countys option:selected').html();
            var street = $('#Street').val();
            var code = $('.bd').children().eq(3).children().eq(1).val();
            var address = address1 + address2 + address3+' '+street+' '+code;
            $('#receiver1').attr('value',receiver);
            $('#phone').attr('value',phone);
            $('#address1').attr('value',address);
      });
      $('#J_editAddrOk').click(function(){
            //收件人
            var receiver = $('.bd').children().eq(0).children().eq(1).val();
            //手机号码
            var phone = $('.bd').children().eq(1).children().eq(1).val();
            //三级联动地址
            var address1 = $('#Provinces option:selected').html();
            var address2 = $('#Citys option:selected').html();
            var address3 = $('#Countys option:selected').html();
            var street = $('#Street').val();
            var code = $('.bd').children().eq(3).children().eq(1).val();
            var address = address1 + address2 + address3+' '+street+' '+code;
            console.log(receiver,phone,address);
            $.ajax({
                url:'<?php echo U("newAddress");?>',
                data:{'linkman':receiver,'phone':phone,'address':address},
                success:function(res){
                    if(res.status >0) {
                        alert(res.info);
                    } else {
                        alert(res.info);

                    }
                }
            })
      });
</script>
<script>
    //计算总额
    var price = $('.price');
    total = 0;
    for(i = 0;i<price.length;i++){
        total += parseInt(price[i].innerHTML);
    }
    $('.total').html(total+'元');
    $('#total1').attr('value',total);
    //用户得到积分
    $('.getScore').html(total);
    //把数据放入hidden
    $('#getScore').attr('value',total);
    //获取收货地址信息
     $(document).on('click','#checkoutAddrList .item',function(){
        //准备默认地址数据
        var receiver = $(this).children().first().children().first().html();
        $('#receiver1').attr('value',receiver);
        var phone = $(this).children().first().next().children().first().html();
        $('#phone1').attr('value',phone);
        var address = $(this).children().first().next().children().first().next().html();
        $('#address1').attr('value',address);
        console.log(receiver,phone,address);
     });

     $(document).ready(function(){
        var receiver = $('[class="item selected"]').children().first().children().first().html();
        $('#receiver1').attr('value',receiver);
        var phone = $('[class="item selected"]').children().first().next().children().first().html();
        $('#phone1').attr('value',phone);
        var address = $('[class="item selected"]').children().first().next().children().first().next().html();
        $('#address1').attr('value',address);
        //vip用户减额
        $('.vip').html('-'+(total*5)/100+'元');
        //钻石用户减额
        $('.zuan').html('-'+(total*10)/100+'元');
        //普通用户减额
        $('.kong').html('-'+'0元');
        //vip用户应付金额
        $('#vip-total').html(total-total*0.05);
        //钻石用户应付金额
        $('#zuan-total').html(total-total*0.1);
        //普通用户应付金额
        $('#kong-total').html(total);
     })

</script>
                <!-- 商品清单 END -->
                <div class="checkout-confirm">
                    
                     <a href="#" class="btn btn-lineDakeLight btn-back-cart">返回购物车</a>
                     <input class="btn btn-primary" value="立即下单" id="checkoutToPay" type="submit">
                </div>
            </div>
        </form>
    </div>
</div>

    <script src="/D2/Public/index_data/base.js"></script>

        <script type="text/javascript" src="/D2/Public/index_data/address_all.js"></script>
<script type="text/javascript" src="/D2/Public/index_data/checkout.js"></script> 
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



<script id="newAddrTemplate" type="text/x-dot-template">
        <dl class="item selected" data-isnew="true" 
data-consignee="{{=it.consignee}}" data-tel="{{=it.tel}}" 
data-province="{{=it.province}}" 
data-provincename="{{=it.provinceName}}" data-city="{{=it.city}}" 
data-cityname="{{=it.cityName}}" data-county="{{=it.county}}" 
data-countyname="{{=it.countyName}}" data-zipcode="{{=it.zipcode}}" 
data-street="{{=it.street}}" data-tag="{{=it.tag}}">
            <dt>
                <strong class="itemConsignee">{{=it.consignee}}</strong>
                {{? it.tag }} 
                    <span  class="itemTag tag">{{=it.tag}}</span>
                {{?}}
            </dt>
            <dd>
                <p class="tel itemTel">{{=it.tel}}</p>
                <p  class="itemRegion">{{=it.provinceName}} 
{{=it.cityName}} {{=it.countyName}}</p>
                <p  class="itemStreet">{{=it.street}} 
({{=it.zipcode}})</p>
                <span class="edit-btn J_editAddr">编辑</span>
            </dd>
        </dl>
</script> 
 <!--收货地址body部分结束-->
    <div class="fixed-buttons">
        <ul>
            <li><a href="#" class="fixed-weixin"><img src="/D2/Public/index_data/fixed_weixin.png"><div class="weixin-pic"><img src="/D2/Public/index_data/weixin_big.jpg"></div></a></li>
            <li><img id="imgBtn-to-top" src="/D2/Public/index_data/back_top.png"></li>
        </ul>
    </div>
    <script src="/D2/Public/index_data/jquery-1.js"></script>
    <script src="/D2/Public/index_data/unslider.js" type="text/javascript"></script>
    <script src="/D2/Public/index_data/index.js" type="text/javascript"></script>

<script type="text/javascript">banner()</script>
</body>
</html>