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
  <title>购物车</title>
    <link rel="shortcut icon" type="image/x-icon" href="/D2/Public/Home-icon/favicon.ico">
  <link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/base.css">
  <link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/home.css">

  <style>
        .alert { display: none; position: fixed; top: 15%; left: 45%; min-width: 200px; margin-left: -100px; z-index: 99999; padding: 15px; border: 1px solid transparent; border-radius: 4px;
        } .alert-success { color: #a94442; background-color: #f2dede; border-color: #ebccd1;text-align: center;
        }
  </style>
  <script type="text/javascript" src="/D2/Public/Home-js/jquery.js"></script>
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
                <li class="cur"><a href="#">1 . 我的购物车</a></li>
                <li ><a href="#">2 . 填写核对订单</a></li>
                <li><a href="#">3 . 成功提交订单</a></li>
            </ul>
        </div>
    </div>
    <div class="alert"></div>


<!-- 订单提交成功 begin-->
<section>
    <div class="containers">
       <div class="pc-space">
           <div class="pc-order-title clearfix"><h3 class="fl">购物车清单</h3></div>
           <div class="pc-border">

               <div class="pc-order-text clearfix">
                    
                   <table style="text-align:center" id="table">
                       <tr class=" clearfix" style="width:100% ">
                           <td style="width:10%"><button onclick="sel()">全选</button>  <button onclick="invert()">反选</button></td>
                           <td style="width:10%;">商品图片</td>
                           <td style="width:22%;">商品名称</td>
                           <td style="width:8%;">商品属性</td>
                           <td style="width:10%">积分</td>
                           <td style="width:10%">单价(元)</td>
                           <td style="width:10%">数量</td>
                           <td style="width:10%">小计(元)</td>
                           <td style="width:10%">操作</td>
                       </tr>
                       <tr style="height:10px"></tr>


                <tbody class="list">
                    <?php if(empty($list)): ?><tr><td colspan="9">购物车中还没有商品，赶紧选购吧！</td></tr>
                    <?php else: ?>

                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr style="margin-top:20px;" idInfo="<?php echo ($v['gid']); ?>_<?php echo ($v['id']); ?>" class="tr">
                           <td> <input type="checkbox" name="goods" checked> </td>
                           <td>
                                <span><a href="/D2/Home/Goods/detail/id/<?php echo ($v['gid']); ?>.html"><img src="/D2/Public/Uploads/<?php echo ($v['pic']); ?>" alt="" style="width:85px;border-radius:5px"></a></span>
                            </td>
                            <td>
                                <span><a href="/D2/Home/Goods/detail/id/<?php echo ($v['gid']); ?>.html"><?php echo ($v['name']); ?></a></span>
                           </td>
                           <td><?php echo ($v['attr']); ?></td>
                           <td value="<?php echo ($v['givescore']); ?>"></td>
                           <td value="<?php echo ($v['price']); ?>"><?php echo ($v['price']); ?></td>
                           <td class="num">
                               <a href="javascript:void(0)" onclick="reduce(this)"><img src="/D2/Public/Home-img/shopcar/minus.jpg" ></a>
                               <input type="text" style="width:19%" value="<?php echo ($v['buyNum']); ?>" disabled>
                               <a href="javascript:void(0)" onclick="add(this)"><img src="/D2/Public/Home-img/shopcar/adding.jpg" ></a>
                           </td>
                           <td></td>
                           <td ><a href="javascript:void(0)" onclick="del(this)" style="color:rgb(182, 29, 29)">删除</a></td>
                       </tr><?php endforeach; endif; endif; ?> 
                </tbody>                     

                   </table>
               </div>

               

           </div>
       </div>
 
       <div class="clearfix">
            <div ><a href="javascript:void(0)" onclick="delSelected()"><img src="/D2/Public/Home-img/shopcar/del.jpg" alt=""></a></div>
            <div class="pc-list-t" style="width:380;float:left">
                <h5 style="color:rgb(182, 29, 29)">积分规则:</h5>
                <p>1.1元 = 1积分;</p>
                <p>2.积分用于提升会员等级,提升等级后可以享受不同的折扣;</p>
                <p>3.50000>积分=>10000为<strong style="color:rgb(182, 29, 29)">VIP会员</strong>享受<strong style="color:rgb(182, 29, 29)">95折</strong>的折扣; 积分=>50000为<strong style="color:rgb(182, 29, 29)">钻石会员</strong>享受<strong style="color:rgb(182, 29, 29)">9折</strong>的折扣;</p>
                <p>4.本规则最终解释权归梁非凡所有！</p>
            </div>
           <div class="fr pc-list-t">

               <ul>
                   <li><span>选中<b class="total">2</b> 件商品，总商品金额：</span> <em class="cost">￥0.00</em></li>
                   <li><span>(详情请看积分规则)减额：</span> <em class="jian">￥0.00</em></li>
                   <li><span>运费：</span> <em>￥0.00</em></li>
                   <li><span>应付总额：</span> <em class="finalCost">￥0.00</em></li>
               </ul>
           </div>
       </div>
       <div class="pc-space-n"></div>
       <div class="clearfix">
           <div class="fr pc-space-j">
               <spna>应付总额：<strong class="finalCost">￥0.00</strong></spna>
               <button class="pc-submit" onclick="placeOrder()">提交订单</button>
           </div>
       </div>
    </div>

    <script>
            var table = document.getElementById('table');
            var checkBox = table.getElementsByTagName('input');
            
            for ( var i=0; i<$('.tr').length; i++ ) {
                fnCount ( $('.tr')[i] );
            }

            // 计算每样商品的总积分和总价格
            function fnCount (obj) {
                $(obj).children('.num').prev().prev().html($(obj).children('.num').prev().prev().attr('value') * $(obj).children('.num').children().next().attr('value'));
                $(obj).children('.num').next().html($(obj).children('.num').prev().attr('value') * $(obj).children('.num').children().next().attr('value'));
            }

            // 计算所选中商品的总价格和总数量
            statistics();
            $('input:checkbox').click(function () {
                statistics();
            }); 
            function statistics(){
                var total = 0;
                var cost = 0;
                var daze = 0;

                for (var i=0; i<$('.tr').length; i++) {
                    if($($('.tr')[i]).children().children()[0].checked) {
                        total += parseInt($($('.tr')[i]).children('.num').children().next().attr('value'));
                        cost += parseFloat($($('.tr')[i]).children('.num').next().html());
                    }
                }
                $('.total').html(total);
                if(<?php echo ($role); ?> == 2) {
                    daze = 5;
                } else if (<?php echo ($role); ?> == 3) {
                    daze = 10;
                }
                $('.jian').html('￥'+(cost*daze)/100);
                $('.cost').html('￥'+cost);
                $('.finalCost').html('￥'+cost*( (1-daze/100)*100 )/100);
            }
             
            function sel() {
                for (var i = 0; i < checkBox.length; i++) {
                    checkBox[i].checked = true;
                }
                statistics();
            }

            function invert() {
                for (var i = 0; i < checkBox.length; i++) {
                    checkBox[i].checked = !checkBox[i].checked;
                }
                statistics();
            }

            //删除多个商品
            function delSelected() {
                if (confirm("确定要删除吗？")) {
                    for (var i=$('.tr').length-1; i>=0; i--) {
                        if($($('.tr')[i]).children().children()[0].checked) {
                            del($($('.tr')[i]).children().last().children()[0]);
                        }
                    }
                }
            }

            //删除一样商品
            function del(obj) {
                var idInfo = $(obj).parent().parent().attr('idInfo');
                $.ajax({
                  type:'get',
                  url:"<?php echo U('ShopCar/del');?>",
                  data:{'idInfo':idInfo},
                  success:function(res) {
                    if(res.status){
                      $(obj).parent().parent().remove();
                      statistics();
 					if($('tr').length < 3) {
                            $('.list').html("<tr><td colspan='9'>购物车中还没有商品，赶紧选购吧！</td></tr>");
                      }                    
					} else {
                      $('.alert').html('删除失败，请再执行删除操作！').addClass('alert-success').show().delay(1500).fadeOut();
                    }
                  }
                });
            }

            //减少商品的购买数量
            function reduce(obj) {
                var idInfo = $(obj).parent().parent().attr('idInfo');
                $.ajax({
                  type:'get',
                  url:"<?php echo U('ShopCar/reduce');?>",
                  data:{'idInfo':idInfo},
                  success:function(res) {
                    if(res.status) {
                        $(obj).next().attr('value',$(obj).next().attr('value') - 1);
                        for ( var i=0; i<$('.tr').length; i++ ) {
                            fnCount ( $('.tr')[i] );
                        } 
                        statistics();                       
                    }
                  }
                });
            }

            //增加商品的购买数量
            function add(obj) {
                var idInfo = $(obj).parent().parent().attr('idInfo');
                $.ajax({
                  type:'get',
                  url:"<?php echo U('ShopCar/add');?>",
                  data:{'idInfo':idInfo},
                  success:function(res) {
                    if(res.status) {
                        $(obj).prev().attr('value',parseInt($(obj).prev().attr('value')) + 1);
                        for ( var i=0; i<$('.tr').length; i++ ) {
                            fnCount ( $('.tr')[i] );
                        } 
                        statistics();                      
                    } else {
                        $('.alert').html(res.info).addClass('alert-success').show().delay(1500).fadeOut();
                    }
                  }
                });
            }
            function placeOrder(){
                var idInfo = $('input:checked').map(function(){
                    return $(this).parent().parent().attr('idInfo');
                }).get().join(',');
                if(!idInfo) {
                  $('.alert').html('您没有选择任何商品').addClass('alert-success').show().delay(1500).fadeOut();
                }else{
                  location.href="/D2/Home/Order/orderConfirm/ids/"+idInfo;
                }
            }
    </script>
</section>
<!-- 订单提交成功 End-->

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



<script type="text/javascript" src="/D2/Public/Home-js/address.js"></script>

<script type="text/javascript">banner()</script>
</body>
</html>