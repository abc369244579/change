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
  <meta content="歪秀购物, 购物, 大家电, 手机" name="keywords">
  <meta content="歪秀购物，购物商城。" name="description">
  <title>歪秀商城</title>
  <link rel="shortcut icon" type="image/x-icon" href="/D2/Public/Home-icon/favicon.ico">
  <link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/base.css">
  <link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/home.css">
  <link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/member.css">
  <link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/style.css">
  <script type="text/javascript" src="/D2/Public/Home-js/jquery.js"></script>
  <style>
        .alert { display: none; position: fixed; top: 13%; left: 45%; min-width: 200px; margin-left: -100px; z-index: 99999; padding: 15px; border: 1px solid transparent; border-radius: 4px;
        } .alert-success { color: #a94442; background-color: #f2dede; border-color: #ebccd1;text-align: center;
        }
    </style>
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
      <script type="text/javascript">
            $(function() {
                $('.dorpdown').hover(function() {
                    $(this).addClass("hover");
                }, function() {
                    $(this).removeClass("hover");
                })
            })

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

    <?php if(empty($seo)): ?><div class="container clearfix">
        <div class="header-logo fl"><h1><a href="<?php echo U('Index/index');?>"><img src="/D2/Public/Upload/Home-icon/logo.png" style="width: 200px;height:110px"></a> </h1></div>
<?php else: ?>
<?php if(is_array($seo)): foreach($seo as $key=>$v): ?><div class="container clearfix">
        <div class="header-logo fl"><h1><a href="<?php echo U('Index/index');?>">
        <?php if(empty($v['pic'])): ?><img src="/D2/Public/Home-icon/logo.png" style="width: 200px;height:100px">
        <?php else: ?>
            <img src="/D2/Public/Upload/<?php echo ($v['pic']); ?>" style="width: 200px;height:100px"><?php endif; ?>
        </a> </h1></div><?php endforeach; endif; endif; ?>
        <div class="head-form fl">
        <!-- 搜索开始 -->
            <form class="clearfix" action="<?php echo U('Goods/index');?>" method="get">
                <input type="text" class="search-text" id="key" autocomplete="off" oninput="changeinput()"  placeholder="请输入要搜索的商品" name="search" value="<?php echo ($search?$search:''); ?>">
                
                <button class="button">搜索</button>
            <div style="position:absolute;top:55px;z-index:1231231232;width:462px;height:200px;background-color:white;border: solid 2px #EA4949;display:none" id="sear">
                <?php if(empty($hotwords)): else: ?>
                    <?php if(is_array($hotwords)): foreach($hotwords as $k=>$vo): ?><a href="<?php echo U('Goods/index',['search'=>$k]);?>"><li style="height:30px;font-size: 14px"></li></a><?php endforeach; endif; endif; ?>
            </div>
            </form>
        <!-- 搜索结束 -->
            <?php if(empty($hotwords)): else: ?>
                <div class="words-text clearfix">
                    <?php if(is_array($hotwords)): foreach($hotwords as $k=>$vo): ?><a href="<?php echo U('Goods/index',['search'=>$k]);?>"><?php echo ($k); ?></a><?php endforeach; endif; ?>
                </div><?php endif; ?>
        </div>
            <div class="dorpdown " id="settleup-2014"> 
                <div class="cw-icon"> 
                    <i class="ci-left"></i> 
                    <i class="ci-right">&gt;</i>
                    <i id="shopping-amount" class="ci-count">0</i> 
                    <a href="<?php echo U('ShopCar/shopcar');?>" >我的购物车</a> 
                </div> 
                <div class="dorpdown-layer">
                    <div class="spacer"></div>
                    <div id="settleup-content">
                        <div class="smt">
                            <h4 class="fl">最新加入的商品</h4>
                        </div>
                        <div class="smc">
                            <ul id="mcart-sigle"> 
                            </ul>
                        </div>
                        <div class="smb ar">
                            <div class="p-total">
                                共
                                <b>2</b>件商品　共计
                                <strong>￥ 128.00</strong>
                            </div>
                            <a href="<?php echo U('ShopCar/shopcar');?>" id="btn-payforgoods" title="去购物车">去购物车</a>
                        </div>
                    </div>
                </div> 
            </div> 
    </div>
<script type="text/javascript">
    function changeinput()
    {
        $("#sear").css('display','block');
        var words = $("#key").val();

        // alert(chi);
        $.ajax({
            type:'post',
            url:"<?php echo U('Goods/index');?>",
            data:{'words':words},
            success:function(res){
                console.log(res);
                li = '';
                for (var k in res.info) {
                li+='<a href="<?php echo U('Goods/index');?>?search='+res.info[k]+'"><li style="height:30px;font-size: 14px">'+res.info[k]+'</li></a>';
                }
                $('#sear').empty().append(li);
            }
        })
    }
    $('body').on('click',function(){
        $("#sear").css('display','none');

    })
    
            $(function() {
                $.ajax({
                        type:'get',
                        url:"<?php echo U('ShopCar/shopcar');?>",
                        success:function(res){
                            var li = '';
                            var total = 0;
                            var totalNum = 0;
                            if(res.info) {
                                for (var k in res.info) {
                                    li += '<li idInfo="'+res.info[k].gid+'_'+res.info[k].id+'"><div class="p-img fl"><a href="/D2/Home/Goods/detail/id/'+res.info[k].gid+'.html"><img width="50" height="50" alt="" src="/D2/Public/Uploads/'+res.info[k].pic+'" /></a></div><div class="p-name fl"><a title="'+res.info[k].name+res.info[k].attr+'"href="/D2/Home/Goods/detail/id/'+res.info[k].gid+'.html">'+res.info[k].name+res.info[k].attr+'</a></div><div class="p-detail fr ar"><span class="p-price"><strong>￥'+res.info[k].price+'</strong>&times;'+res.info[k].buyNum+'</span><br /><a href="javascript:void(0)" data-type="RemoveProduct" data-id="1006559999" class="delete">删除</a></div></li>';
                                    total += Number(res.info[k].buyNum);
                                    totalNum += Number(res.info[k].buyNum * res.info[k].price)
                                }
                                $('#mcart-sigle').html(li);
                                $('#shopping-amount').html(total);
                                $('.p-total b').html(total);
                                $('.p-total strong').html('￥'+totalNum);
                            } else {
                                var  div = '<div class="spacer"></div><div id="settleup-content"><div class="smt"><h4 class="fl">最新加入的商品</h4></div><div class="smc"><ul id="mcart-sigle"><li> 购物车中还没有商品，赶紧选购吧！</li></ul></div><div class="smb ar"><div class="p-total">共<b>0</b>件商品　共计<strong>￥ 0.00</strong></div><a href="<?php echo U("ShopCar/shopcar");?>" id="btn-payforgoods" title="去购物车">去购物车</a></div></div>';
                                $('.dorpdown-layer').html(div);
                            }
                        }
                    });

                $('.cw-icon').hover(function() {
                    $(this).addClass("hover");
                    $.ajax({
                        type:'get',
                        url:"<?php echo U('ShopCar/shopcar');?>",
                        success:function(res){
                            var li = '';
                            var total = 0;
                            var totalNum = 0;
                            if(res.info) {
                                for (var k in res.info) {
                                    li += '<li idInfo="'+res.info[k].gid+'_'+res.info[k].id+'"><div class="p-img fl"><a href="/D2/Home/Goods/detail/id/'+res.info[k].gid+'.html"><img width="50" height="50" alt="" src="/D2/Public/Uploads/'+res.info[k].pic+'" /></a></div><div class="p-name fl"><a  title="'+res.info[k].name+res.info[k].attr+'" href="/D2/Home/Goods/detail/id/'+res.info[k].gid+'.html">'+res.info[k].name+res.info[k].attr+'</a></div><div class="p-detail fr ar"><span class="p-price"><strong>￥'+res.info[k].price+'</strong>&times;'+res.info[k].buyNum+'</span><br /><a href="javascript:void(0)" data-type="RemoveProduct" data-id="1006559999" class="delete">删除</a></div></li>';
                                    total += Number(res.info[k].buyNum);
                                    totalNum += Number(res.info[k].buyNum * res.info[k].price)
                                }
                                $('#mcart-sigle').html(li);
                                $('#shopping-amount').html(total);
                                $('.p-total b').html(total);
                                $('.p-total strong').html('￥'+totalNum);
                            } else {
                                var  div = '<div class="spacer"></div><div id="settleup-content"><div class="smt"><h4 class="fl">最新加入的商品</h4></div><div class="smc"><ul id="mcart-sigle"><li> 购物车中还没有商品，赶紧选购吧！</li></ul></div><div class="smb ar"><div class="p-total">共<b>0</b>件商品　共计<strong>￥ 0.00</strong></div><a href="<?php echo U("ShopCar/shopcar");?>" id="btn-payforgoods" title="去购物车">去购物车</a></div></div>';
                                $('.dorpdown-layer').html(div);
                                $('#shopping-amount').html(total);
                            }
                        }
                    });
                }, function() {
                    $(this).removeClass("hover");
                })
            })

            $('body').on('click','.delete',function(){
                var idInfo = $($(this).parent().parent().get()[0]).attr('idInfo');
                $.ajax({
                    type:'get',
                    url:"<?php echo U('ShopCar/del');?>",
                    data:{'idInfo':idInfo},
                    success:function(res) {
                        $.ajax({
                            type:'get',
                            url:"<?php echo U('ShopCar/shopcar');?>",
                            success:function(res){
                                var li = '';
                                var total = 0;
                                var totalNum = 0;
                                if(res.info) {
                                    for (var k in res.info) {
                                        li += '<li idInfo="'+res.info[k].gid+'_'+res.info[k].id+'"><div class="p-img fl"><a href="/D2/Home/Goods/detail/id/'+res.info[k].gid+'.html"><img width="50" height="50" alt="" src="/D2/Public/Uploads/'+res.info[k].pic+'" /></a></div><div class="p-name fl"><a  title="'+res.info[k].name+res.info[k].attr+'" href="/D2/Home/Goods/detail/id/'+res.info[k].gid+'.html">'+res.info[k].name+res.info[k].attr+'</a></div><div class="p-detail fr ar"><span class="p-price"><strong>￥'+res.info[k].price+'</strong>&times;'+res.info[k].buyNum+'</span><br /><a href="javascript:void(0)" data-type="RemoveProduct" data-id="1006559999" class="delete">删除</a></div></li>';
                                        total += Number(res.info[k].buyNum);
                                        totalNum += Number(res.info[k].buyNum * res.info[k].price)
                                    }
                                    $('#mcart-sigle').html(li);
                                    $('#shopping-amount').html(total);
                                    $('.p-total b').html(total);
                                    $('.p-total strong').html('￥'+totalNum);
                                } else {
                                    var  div = '<div class="spacer"></div><div id="settleup-content"><div class="smt"><h4 class="fl">最新加入的商品</h4></div><div class="smc"><ul id="mcart-sigle"><li> 购物车中还没有商品，赶紧选购吧！</li></ul></div><div class="smb ar"><div class="p-total">共<b>0</b>件商品　共计<strong>￥ 0.00</strong></div><a id="btn-payforgoods" title="去购物车">去购物车</a></div></div>';
                                    $('.dorpdown-layer').html(div);
                                    $('#shopping-amount').html(0);
                                }
                            }
                        });
                    }
                });
            });
</script>


<div class="containers"><div class="pc-nav-item"><a href="<?php echo U('Index/index');?>">首页</a> &gt; <a href="#">会员中心 </a> &gt; <a href="#"></a></div></div>
<div class="alert"></div>
<!-- 商城快讯 begin -->
<section id="member">
    <div class="member-center clearfix">
        <div class="member-left fl">
            <div class="member-apart clearfix">
              <?php if(empty($_SESSION['qq_openid'])): if(empty($_SESSION['weibo_uid'])): ?><div class="fl"><a href="<?php echo U('Order/upload');?>"><img src="/D2/Public/Uploads/<?php echo ($_SESSION['HomeUser']['photo']); ?>" style="width:80px;height:80px"></a></div>
                  <?php else: ?>
                    <div class="fl"><img src="<?php echo ($_SESSION['HomeUser']['photo']); ?>" style="width:80px;height:80px"></div><?php endif; ?>
              <?php else: ?>
                  <div class="fl"><img src="<?php echo ($_SESSION['HomeUser']['photo']); ?>" style="width:80px;height:80px"></div><?php endif; ?>
              
                <div class="fl">
                    <p>用户名：</p>
                    <p><a href="#" style="color:black"><?php echo ($_SESSION['HomeUser']['username']); ?></a></p>
                    <p><?php echo ($user[0]['role']); ?></p>
                    <p >点击头像上传图片</p>
                    
                </div>
            </div>
<!-- header End -->
            <div class="member-lists">
                <dl>
                    <dt>我的商城</dt>
                    <dd class="cur"><a href="<?php echo U('Order/order');?>">我的订单</a></dd>
                    <dd><a href="<?php echo U('Collect/collect');?>">我的收藏</a></dd>
                    <dd><a href="<?php echo U('Safe/safe');?>">账户安全</a></dd>
                    <dd><a href="<?php echo U('Address/address');?>">地址管理</a></dd>
                    <dd><a href="<?php echo U('Safe/ModifyPass');?>">修改密码</a></dd>
                    <dd><a href="<?php echo U('Safe/MyScore');?>">我的积分</a></dd>
                    <dd><a href="<?php echo U('Feedback/Feedback');?>">意见反馈</a></dd>
                </dl>
            </div>
        </div>
        <div class="member-right fr">
            <div class="member-head">
                <div class="member-heels fl"><h2>我的订单</h2></div>
                <div class="member-backs member-icons fr"><a href="#">搜索</a></div>
                <div class="member-about fr"><input type="text" placeholder="商品名称/商品编号/订单编号"></div>
            </div>
            <div class="member-whole clearfix">
                <ul id="H-table" class="H-table">
                    <li class="cur"><a href="#" status="all">我的订单</a></li>
                    <li><a href="#" status="1">待付款(<em id="one"><?php echo ($one); ?></em>)</a></li>
                    <li><a href="#" status="2">待发货(<em id="two"><?php echo ($two); ?></em>)</a></li>
                    <li><a href="#" status="3">待收货(<em id="three"><?php echo ($three); ?></em>)</a></li>
                    <li><a href="#" status="5">交易完成(<em id="four"><?php echo ($four); ?></em>)</a></li>
                </ul>
            </div>
          <a id="marks"></a>
<script>
//准备一个数组，用于存储缓存数据
  var arr = [];
  var btn = [];
  $('.H-table a').on('click',function(){
    //获取订单状态码
    var status = $(this).attr('status');
    $(this).parent().addClass('cur');
    $(this).parent().siblings().removeClass();
    //用于删除上一个分页按钮
    $('#sb').remove();
    $('.member-border').remove();
    tops();
    //加载菜单
    //判断是否存在缓存，存在则调用onload方法，不存在则ajax请求服务器
    if(arr[status]){
      //加载新分页按钮
      sbtnb(btn[status]);
      onloads(arr[status]);
    } else {
      $.ajax({
        url:'<?php echo U("getOrder");?>',
        data:{'status':status},
        success:function(res){
          // console.log($(res[0][0]).length);
          arr[status] = res;
          btn[status] = res[0].page;
          //分配新的分页按钮
          sbtna(res);
          onloads(res);
          
        }
      });
    }
  })
</script>
<script>
$('body').delegate('.page a','click',function(){
  var url = $(this).attr('href');
  $.ajax({
    url:url,
    type:'get',
    success:function(res){
      //用于删除上一个分页按钮
      $('.replace').children().remove();
      $('#sb').remove();
      sbtna(res);
      onloads(res);
    }
  });
  return false;
})

//首次加载时
$(document).ready(function(){
  tops();
  $('.replace').children().remove();
  var url = $('.current').html();
  $.ajax({
    url:'<?php echo U("Order/order");?>',
    data:{p:url},
    success:function(res){
      sbtna(res);
      onloads(res);
    }
  })
})

//用于加载菜单
function tops(){
  $('.member-whole').after('<div class="member-border"><div class="H-over member-over"></div></div>');
  $('.H-over').append('<div class="member-cancel clearfix"><span class="be1">订单信息</span><span class="be2">收货人</span><span class="be2">订单金额</span><span class="be2">订单时间</span><span class="be2">订单状态</span><span class="be2">订单操作</span></div><div class="member-sheet clearfix"><ul class="replace"></ul></div>');
}
function onloads(res){
  delete res[0].page;
  for(var i in res[0]){
    $('.replace').append('<li><div class="member-minute clearfix"><span>'+res[0][i].addtime+'</span><span oid='+res[0][i].oid+'>订单号：<em>'+res[0][i].oid+'</em></span><span>收货地址：<em>'+res[0][i].address+'</em></span></div><div class="member-circle clearfix "><div class="ci1 fuck1'+i+'"></div><div class="ci2 fuck'+i+'">'+res[0][i].receiver+'</div><div class="ci3 fuck'+i+'"><b>￥'+res[0][i].total+'</b></div><div class="ci4 fuck'+i+'"><p>'+res[0][i].addtime+'</p></div><div class="ci5 fuck'+i+'"><p>'+res[0][i].status+'</p>  '+(res[0][i].status=="待付款"?"<p><a>假装支付</a></p>":"")+'</div><div class="ci6 fuck'+i+'">'+(res[0][i].status=="待收货"?"<p><a>确认收货</a></p>":"")+'</div></div></li>');
      for(var l in res[1][i]){
        $('.fuck1'+i+'').append('<div class="ci7 clearfix"><span class="gr1"><a href="<?php echo U("Goods/detail");?>?id='+res[1][i][l].gid+'"><img src="/D2/Public/Uploads/'+res[1][i][l].pic+'" width="60" height="60" title="" about=""></a></span><span class="gr2"><a href="#">'+res[1][i][l].name+'</a></span><p class="gr2"><a href="#">'+res[1][i][l].attr+'</a></p><span class="gr3" style="color:red">价格:￥'+res[1][i][l].price+'</span><span class="gr3" style="color:red">X'+res[1][i][l].num+'</span></div>');
      }
  }
  cssObj();
}

//支付
$('body').delegate('.ci5 a','click',function(){
  var oid = $(this).parent().parent().parent().prev().children().first().next().attr('oid');
  var thiss = $(this);
  var parent = $(this).parent().parent().parent().parent();
  var cur = $('.current').html();
  var url = '/ThinkPHP/Home/Order/getOrder/status/1/p/'+cur+'.html';
  var pre = $('.current').parent().prev();
  pre = $(pre[0]).attr('href');
  $.ajax({
    url:'<?php echo U("Order/payHome");?>',
    data:{'mark':true,'oid':oid,'status':2},
    success:function(res){
      $('.alert').html(res.info).addClass('alert-success').show().delay(1500).fadeOut();
      //待付款个数
      num = $('#one').html();
      num2 = $('#two').html();
      $('#one').html( num - 1);
      $('#two').html( Number(num2) + 1);
      parent.remove();
      if($('.replace li').length == 1){
        pages(url);
      } else if($('.replace li').length == 0 &&pre){
        pages(pre);
      }
    }
  })
})
//确认收货
$('body').delegate('.ci6 a','click',function(){
  var oid = $(this).parent().parent().parent().prev().children().first().next().attr('oid');
  var thiss = $(this);
  var parent = $(this).parent().parent().parent().parent();
  var cur = $('.current').html();
  var url = '/ThinkPHP/Home/Order/getOrder/status/3/p/'+cur+'.html';
  var pre = $('.current').parent().prev();
  pre = $(pre[0]).attr('href');
  $.ajax({
    url:'<?php echo U("Order/payHome");?>',
    data:{'mark':true,'oid':oid,'status':5},
    success:function(res){
      $('.alert').html(res.info).addClass('alert-success').show().delay(1500).fadeOut();
      num = $('#three').html();
      num2 = $('#four').html();
      $('#three').html( num - 1);
      $('#four').html( Number(num2) + 1);
      parent.remove();
        if($('.replace li').length == 1){
          pages(url);
        } else if($('.replace li').length == 0 &&pre){
          pages(pre);
        }
        //  else if($('.replace li').length == 0 &&cur==1){
        //   $('.replace').html('暂无数据');
        // }
    }
  })
})
//用于保持分页
function pages(url){
  $.ajax({
    url:url,
    success:function(res){
      //用于删除上一个分页按钮
      $('.replace').children().remove();
      $('#sb').remove();
      sbtna(res);
      onloads(res);
    }
  })
}
//分配新的分页按钮
function sbtna(res){
$('#marks').after('<div class="clearfix" id="sb" style="padding:30px 20px;"><div class="fr pc-search-g pc-search-gs"><b class="page" id="ipage">'+res[0].page+'</b></div></div>');
//赋予样式
$('.page span').wrap('<span style="float: left;border: 1px solid #CCCCCC;color: #fff;border-radius: 3px;width:28px;height:27px;line-height: 25px;text-align:center;margin-left:2px"></span>');
}

function sbtnb(res){
  //分配新的分页按钮
$('#marks').after('<div class="clearfix" id="sb" style="padding:30px 20px;"><div class="fr pc-search-g pc-search-gs"><b class="page" id="ipage">'+res+'</b></div></div>');
//赋予样式
$('.page span').wrap('<span style="float: left;border: 1px solid #CCCCCC;color: #fff;border-radius: 3px;width:28px;height:27px;line-height: 25px;text-align:center;margin-left:2px"></span>');
}

//用于修正样式
function cssObj(){
  var num = $('.ci1').length;
  for(i=0;i<num;i++){
      var h = $('.fuck1'+i).addClass('fuck1'+i).height();
      var real = h-20 +'px';
      // console.log(real);
      $('.fuck'+i).addClass('fuck'+i).css('height',real);
      $('.fuck'+i).addClass('fuck'+i).css('height',real);
      $('.fuck'+i).addClass('fuck'+i).css('height',real);
      $('.fuck'+i).addClass('fuck'+i).css('height',real);
      $('.fuck'+i).addClass('fuck'+i).css('height',real);
  }
}
</script>
</section>
<!-- 商城快讯 End -->

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