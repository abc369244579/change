<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
 <head> 
	<meta charset="UTF-8">
<!-- 遍历seo开始 -->
<?php if(is_array($seo)): $i = 0; $__LIST__ = $seo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><meta name="Generator" content="EditPlus®">
    <meta name="title" content="<?php echo ($v['title']?$v['title']:''); ?>">
    <meta name="keywords" content="<?php echo ($v['keywords']?$v['keywords']:''); ?>">
    <meta name="description" content="<?php echo ($v['description']?$v['description']:''); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
<!-- 结束 -->
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"> 
	<meta name="renderer" content="webkit">
	<title>歪秀购物</title>
    <link rel="shortcut icon" type="image/x-icon" href="/D2/Public/Home-icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/base.css">
    <link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/style.css">
    <link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/style1.css">
	<link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/home.css">
	<script type="text/javascript" src="/D2/Public/Home-js/jquery.js"></script>
	<script type="text/javascript" src="/D2/Public/Home-js/index.js"></script>
	<script type="text/javascript" src="/D2/Public/Home-js/js-tab.js"></script>
	<script type="text/javascript" src="/D2/Public/Home-js/MSClass.js"></script>
    <script type="text/javascript" src="/D2/Public/Home-js/jcarousellite.js"></script>
	<script type="text/javascript" src="/D2/Public/Home-js/top.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.dorpdown').hover(function() {
                $(this).addClass("hover");
            }, function() {
                $(this).removeClass("hover");
            })
        })
        $('a').hover(function() {
            $(this).removeClass('grayscale')
        }, function() {
            $(this).addClass('grayscale')
        });
    </script>
 </head>

 <body>
<div style="position:relative;z-index:1;" id="headpic">
    <?php if(empty($adsarr)): else: ?>
    <a href="<?php echo ($adsarr[0]['url']); ?>" target="_blank"><img src="/D2/Public/Upload/<?php echo ($adsarr[0]['pic']); ?>" style="width:100%;height: 250px" id="pic" name="pic"></a>
    <a><span  href="javascript:void(0);" onclick="del(this)" style="position:absolute;z-index:2;right:220px;top:5px;font-size:18px;color:lightgrey;background-color:#BD651D;">&nbsp;X&nbsp;</span></a><?php endif; ?>
 </div>
    <!-- 广告模块 -->
    <script>
    //获取id
    var pic = document.getElementById('pic');
    var i = 1;
    timers = window.onload =setInterval(function(){
        // 将数据转换成json格式
        var obj = eval('<?php echo json_encode($adsarr);?>');
        var count = eval('<?php echo json_encode($count);?>');
        // alert(count);
        // alert(obj[0]);
        pic.src="/D2/Public/Upload/"+ obj[i];
        if(i < count){
            i++;
           console.log(i);
        } else {
            // 最后一个广告自动关闭，移除节点
            $(pic).parent().parent().remove();
        }
    },10000);
    function del(obj){
        $(obj).parent().parent().remove();
    }
    </script>
<div>
    <div id="moquu_wxin" class="moquu_wxin"><a href="javascript:void(0)"><div class="moquu_wxinh"></div></a></div>
    <div id="moquu_wshare" class="moquu_wshare"><a href="javascript:void(0)" style="text-indent:0"><div class="moquu_wshareh"><img src="/D2/Public/Home-icon/moquu_wshare.png" width="100%"></div></a></div>
    <div id="moquu_wmaps"><a href="javascript:void(0)" class='moquu_wmaps'></a></div>
    <a id="moquu_top" href="javascript:void(0)"></a>
</div>
<!--- header begin-->



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


    <div class="yHeader">                                    
        <div class="yNavIndex">
            <div class="pullDown">
                <h2 class="pullDownTitle">
                    全部商品分类
                </h2>
                <ul class="pullDownList">
                    <?php if(is_array($type)): foreach($type as $key=>$vo): ?><li class="menulihover" tid="<?php echo ($vo['id']); ?>">
                            <i class="listi1"></i>
                            <a href="/D2/Home/Goods/index/id/<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></a>
                            <span></span>
                        </li><?php endforeach; endif; ?>
                </ul>
                <div class="yMenuListCon">
                    <div class="yMenuListConin">
                        <div class="yMenuLCinLisi fl">
                            <ul class="type">
                                
                            </ul>
                        </div>
                        <div class="yMenuLCinList fl">
                            <div class="fuck">
                                
                            </div>
                        </div>
                    </div>
                </div>
            <script>

                var arr = [];
                // ajax请求首页分类
                var timer = null;

                //当鼠标进入顶级分类时
                $('.menulihover').hover(
                    function(){
                    //清除定时器
                    clearTimeout(timer);
                    $('.yMenuListConin').fadeIn('slow').css('display','block');
                        var tid = $(this).attr('tid');
                        // //当数组里有缓存时直接调用函数
                        if(arr[tid]){  
                            type(arr[tid]);
                        } else {
                            //第一次请求ajax
                            $.ajax({
                                url:'<?php echo U("getType");?>',
                                data:{'tid':tid},
                                success:function(res){
                                    arr[tid] = res;
                                    type(res);
                                }
                            });
                        }
                    },
                    function(){
                        //当鼠标离开顶级分类时,设置一个定时器，延迟消失
                        timer = setTimeout(function(){
                            $('.yMenuListConin').fadeOut('slow').css('display','none');
                        },500)
                    }
                );

                //当鼠标进入二级分类时
                $('.yMenuListConin').hover(
                    function(){
                        //清除定时器
                        clearTimeout(timer);
                        $('.yMenuListConin').fadeIn('slow').css('display','block');

                    },function(){
                        //设置定时器，延迟消失
                        timer = setTimeout(function(){
                            $('.yMenuListConin').fadeOut('slow').css('display','none');
                        },500);
                });

                function type(res){
                    $('.type li').remove();
                    $('.third').remove();
                    for(var i in res[0]){
                        if(i < res[0].length){
                            $('.type').append('<li><a href="/D2/Home/Goods/index/id/'+res[0][i]['id']+'">'+res[0][i].name+'<i class="fr">></i></a></li>');
                        }
                        $('.fuck').append('<p class="third third'+i+'"></p>');
                        for(var l in res[1][i]){

                            $('.third'+i+'').append('<a href="/D2/Home/Goods/index/id/'+res[1][i][l].id+'">'+res[1][i][l].name+'</a>');
                        }
                    }
                }
            </script>
        </div>
            <ul class="yMenuIndex">
                <li><a href="" target="_blank">服装城</a></li>
                <li><a href="" target="_blank">美妆馆</a></li>
                <li><a href="" target="_blank">美食</a></li>
                <li><a href="" target="_blank">全球购</a></li>
                <li><a href="" target="_blank">闪购</a></li>
                <li><a href="" target="_blank">团购</a></li>
                <li><a href="" target="_blank">拍卖</a></li>
                <li><a href="" target="_blank">金融</a></li>
                <li><a href="" target="_blank">智能</a></li>
            </ul>
        </div>
    </div>
</header>
<!-- header End -->

<!--- banner begin-->
<section id="pc-banner">
    <div class="yBanner">
        <div class="banner" id="banner" >
        <?php if(is_array($banner)): foreach($banner as $key=>$v): ?><a href="<?php echo U('Goods/detail', ['id' => $v['gid']]);?>" class="d1" style="background:url(/D2/Public/Uploads/<?php echo ($v['pic']); ?>) center no-repeat;background-color: #f01a38;background-size: 1000px 470px;padding-left:180px;" target="_blank"></a><?php endforeach; endif; ?>
            <div class="d2" id="banner_id">
                <ul>
                <?php if(is_array($banner)): foreach($banner as $key=>$v): ?><li></li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
        <div style="text-align:center;clear:both"></div>
    </div>
</section>
<!-- banner End -->

<!--- advert begin-->
<section id="pc-advert">
    <div class="container-c clearfix">
        <a href="page.html" target="_blank"><img src="/D2/Public/Home-img/pd/pd1.png"></a>
        <a href="page.html" target="_blank"><img src="/D2/Public/Home-img/pd/pd2.png"></a>
        <a href="page.html" target="_blank"><img src="/D2/Public/Home-img/pd/pd3.png"></a>
        <a href="page.html" target="_blank"><img src="/D2/Public/Home-img/pd/pd4.png"></a>
    </div>
</section>
<!-- advert End -->

<!-- 商城资讯 begin -->
<section id="pc-information">
    <div class="containers">
        <div class="pc-info-mess  clearfix" style="position: relative;">
            <h2 class="fl" style="margin-right:20px;">商城快讯</h2>
            <div id="MarqueeDiv" class="MarqueeDiv">
                <a href="new.html">[特惠]新一代Moto 360智能手表登陆</a>
                <a href="new.html">[特惠]洗护节 跨品牌满199减100</a>
                <a href="new.html">[特惠]仁怀政府开启“仁怀酱香酒馆”</a>
                <a href="new.html">[特惠]洗护节 跨品牌满199减100</a>
                <a href="new.html">逛商城赚话费，商城通信51城全线抢购 </a>
            	<a href="new.html">文艺蓝牙音箱 火热众筹中 </a>
            	<a href="new.html">[公告]第1000家商城帮服务店落户遵义</a>
            	<a href="new.html">[特惠]新一代Moto 360智能手表登陆</a>
            	<a href="new.html">[特惠]新一代Moto 360智能手表登陆</a>
            	<a href="new.html">[特惠]新一代Moto 360智能手表登陆</a>
            </div>
            <a href="new.html" style="position: absolute;right: 15px;top: 0;"> 更多资讯</a>
        </div>
    </div>
</section>
<!-- 商城资讯 End -->

<!-- 限时抢购 begin -->
<div class="time-lists clearfix">
    <div class="time-list fl" style="width:100%">
        <div class="time-title">
            <h2>即将开始抢购</h2>
            <a href="<?php echo U('Goods/sale');?>" class="fr">更多抢购商品</a>
        </div>
        <div class="time-border" style="height:320px">
            <div class="yScrollList" style="width:100%;height:100%">
                <div class="yScrollListIn">
                    <div class="yScrollListInList yScrollListInList1 jCarouselLite" style="display:block;margin-left: 20px;width: 1000px;height:295px" id="demo-01">
                        <ul class="my_ul" style="height:295px;width: 1000px;">
                            <li  style="float:left;width:100%;height:100%;text-align: center"><img style="margin: auto;" src="/D2/Public/Uploads/scroll.gif"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 限时抢购 End -->

<!-- 卖场推荐 begin -->
<div class="container-c time-lists clearfix randpic">
    <div style="border:1px solid lightgray;text-align:center;height:243px;line-height: 243px">
        <img style="margin: auto;" src="/D2/Public/Uploads/scroll.gif">
    </div>
</div>
<!-- 卖场推荐 End -->

<div class="time-lists clearfix">
    <div class="time-list time-list-w fl">
        <div class="time-title time-clear"><h2>热卖区</h2><div class="pc-font fl"></div><a class="pc-spin fr" href="javascript:;" demo="hotbuy" page="2" onClick="change(this)">换一换</a> </div>
        <div class="time-border hotbuy" style="text-align:center;line-height:300px">
            <img src="/D2/Public/Uploads/scroll.gif">
        </div>
    </div>
</div>

<div class="containers main-banner"><a href="#"><img src="/D2/Public/Home-img/ad/br1.jpg" width="1200" height="105"></a> </div>

<div class="time-lists  clearfix">
    <div class="time-list time-list-w fl">
        <div class="time-title time-clear-f"><h2>男装</h2>
            <ul class="brand-tab H-table clearfix fr" id="H-table">
                <?php if(is_array($son)): $i = 0; $__LIST__ = array_slice($son,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="cur"><a tid="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php if(is_array($son)): $i = 0; $__LIST__ = array_slice($son,1,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a tid="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="time-border time-border-h clearfix">
            <div class="brand-img fl">
                <ul class="pic">
                    <?php $__FOR_START_2097307889__=1;$__FOR_END_2097307889__=7;for($i=$__FOR_START_2097307889__;$i < $__FOR_END_2097307889__;$i+=1){ ?><li><a><img src="/D2/Public/Uploads/scroll.gif" width="125" height="47"></a></li><?php } ?>
                </ul>
            </div>
            <div class="brand-bar fl"><a href="#"><img src="/D2/Public/Home-img/ad/bar.png" width="300" height="476"></a> </div>
            <div class="brand-poa fl">
                <div>
                    <ul class="goods">
                        <?php $__FOR_START_408048157__=1;$__FOR_END_408048157__=7;for($i=$__FOR_START_408048157__;$i < $__FOR_END_408048157__;$i+=1){ ?><li>
                                <div class="brand-imgss" style="text-align:center">
                                    <a href="">
                                        <img src="/D2/Public/Uploads/scroll.gif" style="width:180px;height:165px">
                                    </a>
                                </div>
                                <div class="brand-title" style="text-align:center">     <a>加载中</a>
                                </div>
                                <div class="brand-price" style="text-align:center">
                                    ~~~~~
                                </div>
                            </li><?php } ?>
                    </ul>
                </div>
            </div>
        </div>
            <script>
                var arr = [];
                var timer = null;
                $('#H-table a').click(function(){
                    //获取子分类的ID
                   var tid = $(this).attr('tid');
                   $(this).parent().addClass('cur');
                   $(this).parent().siblings().removeClass();
                   readys();
                   if(arr[tid]){
                        GAB(arr[tid]);
                   } else {
                    timer = setTimeout(function(){
                       $.ajax({
                            url:'<?php echo U("getBrand");?>',
                            data:{'tid':tid},
                            success:function(res){
                                arr[tid] = res;
                                GAB(res);
                            }
                       });
                    },1000);
                   }
                });
                function GAB(res){
                    for(var i in res.bras){
                          if(i<6){
                            $('.pic').children().eq(i).html('<a><img src="/D2/Public/Uploads/'+res.bras[i].pic+'" width="125" height="47"></a>');
                        }
                    }
                    for(var b in res.goods){
                        if(b<6){
                            $('.goods').children().eq(b).html('<div class="brand-imgss" style="text-align:center"><a href="<?php echo U("Goods/detail");?>?id='+res.goods[b].id+'"><img src="/D2/Public/Uploads/'+res.goods[b].pic+'" style="width:180px;height:165px"></a></div><div class="brand-title" style="text-align:center"><a href="<?php echo U("Goods/detail");?>?id='+res.goods[b].id+'">'+res.goods[b].name+'</a> </div><div class="brand-price" style="text-align:center">￥'+res.goods[b].price+'</div>');
                        }
                    }
                }
                //加载时 
                var mark = true;
                $(window).bind('scroll',function(){

                    if( $(document).scrollTop() + $(window).height() > $(document).height() - 1700){
                        if(mark){
                            loads();
                        }
                    }

                })
            //滚动加载男装下的数据
            function loads(){
                //获取子分类的ID
               var tid = $('.cur a').attr('tid');
               $.ajax({
                    url:'<?php echo U("getBrand");?>',
                    data:{'tid':tid},
                    success:function(res){
                        GAB(res);
                    }
               });
               mark = false;
            }
            //准备加载节点
            function readys(){
                $('.pic').html('<?php $__FOR_START_245332581__=1;$__FOR_END_245332581__=7;for($i=$__FOR_START_245332581__;$i < $__FOR_END_245332581__;$i+=1){ ?><li><a><img src="/D2/Public/Uploads/scroll.gif" width="125" height="47"></a></li><?php } ?>');
                $('.goods').html('<?php $__FOR_START_461965903__=1;$__FOR_END_461965903__=7;for($i=$__FOR_START_461965903__;$i < $__FOR_END_461965903__;$i+=1){ ?><li><div class="brand-imgss" style="text-align:center"><a href=""><img src="/D2/Public/Uploads/scroll.gif" style="width:180px;height:165px"></a></div><div class="brand-title" style="text-align:center">     <a>加载中</a></div><div class="brand-price" style="text-align:center">~~~~~</div></li><?php } ?>');
            }
            </script>
    </div>
</div>

<div class="time-lists  clearfix">
    <div class="time-list time-list-w fl">
        <div class="time-title time-clear-f2"><h2>女装</h2>
            <ul class="brand-tab H-table1 clearfix fr" id="H-table1">
                <?php if(is_array($girl)): $i = 0; $__LIST__ = array_slice($girl,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="cur"><a tid="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php if(is_array($girl)): $i = 0; $__LIST__ = array_slice($girl,1,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a tid="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="time-border time-border-h clearfix">
            <div class="brand-img fl">
                <ul class="pic1">
                    <?php $__FOR_START_626448909__=1;$__FOR_END_626448909__=7;for($i=$__FOR_START_626448909__;$i < $__FOR_END_626448909__;$i+=1){ ?><li><a><img src="/D2/Public/Uploads/scroll.gif" width="125" height="47"></a></li><?php } ?>
                </ul>
            </div>
            <div class="brand-bar fl"><a href="#"><img src="/D2/Public/Home-img/ad/bar1.png" width="300" height="476"></a> </div>
            <div class="brand-poa fl">
                <div>
                    <ul class="girl1">
                        <?php $__FOR_START_2042116046__=1;$__FOR_END_2042116046__=7;for($i=$__FOR_START_2042116046__;$i < $__FOR_END_2042116046__;$i+=1){ ?><li>
                                <div class="brand-imgss" style="text-align:center">
                                    <a href="">
                                        <img src="/D2/Public/Uploads/scroll.gif" style="width:180px;height:165px">
                                    </a>
                                </div>
                                <div class="brand-title" style="text-align:center"><a>加载中</a>
                                </div>
                                <div class="brand-price" style="text-align:center">
                                    ~~~~~
                                </div>
                            </li><?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
        <script>
            var arrs = [];
            var timer2 = null;
             $('#H-table1 a').click(function(){
                var tid = $(this).attr('tid');
                $(this).parent().addClass('cur');
                $(this).parent().siblings().removeClass();
                readyGirls();
                if(arrs[tid]){
                    gabs(arrs[tid]);
                } else {
                    //获取子分类的ID
                    timer2 = setTimeout(function(){
                       $.ajax({
                            url:'<?php echo U("getBrand");?>',
                            data:{'tid':tid},
                            success:function(res){
                                arrs[tid] = res;
                                gabs(res);
                            }
                       });
                    },1000);
                }
            });
             function gabs(res){
                for(var i in res.bras){
                      if(i<6){
                        $('.pic1').children().eq(i).html('<a><img src="/D2/Public/Uploads/'+res.bras[i].pic+'" width="125" height="47"></a>');
                        }
                }
                for(var b in res.goods){
                    if(b<6){ 
                        $('.girl1').children().eq(b).html('<div class="brand-imgss" style="text-align:center"><a href="<?php echo U("Goods/detail");?>?id='+res.goods[b].id+'"><img src="/D2/Public/Uploads/'+res.goods[b].pic+'" style="width:180px;height:165px"></a></div><div class="brand-title" style="text-align:center"><a href="<?php echo U("Goods/detail");?>?id='+res.goods[b].id+'">'+res.goods[b].name+'</a> </div><div class="brand-price" style="text-align:center">￥'+res.goods[b].price+'</div>');
                    }
                }
             }
             var mark2 = true;
             $(window).bind('scroll',function(){
                    // console.log($(document).scrollTop()+$(window).height());
                    // console.log($(document).height() - 1300);
                    if( $(document).scrollTop() + $(window).height() > $(document).height() - 1300){
                        if(mark2){
                            load2();
                        }
                    }

            });
            //页面加载时
            function load2(){
                    //获取子分类的ID
                   var tid = $('#H-table1 .cur a').attr('tid');
                   $.ajax({
                        url:'<?php echo U("getBrand");?>',
                        data:{'tid':tid},
                        success:function(res){
                            gabs(res);
                        }
                   });
                   mark2 = false;
            }
                //准备加载节点
            function readyGirls(){
                $('.pic1').html('<?php $__FOR_START_1181365901__=1;$__FOR_END_1181365901__=7;for($i=$__FOR_START_1181365901__;$i < $__FOR_END_1181365901__;$i+=1){ ?><li><a><img src="/D2/Public/Uploads/scroll.gif" width="125" height="47"></a></li><?php } ?>');
                $('.girl1').html('<?php $__FOR_START_272018166__=1;$__FOR_END_272018166__=7;for($i=$__FOR_START_272018166__;$i < $__FOR_END_272018166__;$i+=1){ ?><li><div class="brand-imgss" style="text-align:center"><a href=""><img src="/D2/Public/Uploads/scroll.gif" style="width:180px;height:165px"></a></div><div class="brand-title" style="text-align:center"><a>加载中</a></div><div class="brand-price" style="text-align:center">~~~~~</div></li><?php } ?>');
            }
        </script>
</div>

<div class="containers main-banner"><a href="#"><img src="/D2/Public/Home-img/ad/br1.jpg" width="1200" height="105"></a> </div>
<section>
    <div class="time-lists clearfix">
        <div class="time-list time-list-w fl">
            <div class="time-title time-clear"><h2>悦帮派</h2></div>
            <div class="time-border time-border-h clearfix">
                <div class="fl shop-img">
                    <div class="shop-hgou"><h3>新手上路</h3></div>
                    <div class="shop-help clearfix">
                        <ul>
                            <li><a href="#">开店指南</a> </li>
                            <li><a href="#">购物流程</a> </li>
                            <li><a href="#">交易安全</a> </li>
                            <li><a href="#">常见问题</a> </li>
                            <li><a href="#">联系客服</a> </li>
                            <li><a href="#">用户协议</a> </li>
                        </ul>
                    </div>
                    <div class="shop-re"><a href="#"><img src="/D2/Public/Home-img/ad/shop5.png"></a> </div>
                </div>
                <div class="shop-bar shop-bar-w clearfix fl">
                    <div class="shop-dan clearfix"><h3 class="fl">悦用户晒单</h3> <a href="#" class="fr">更多晒单</a> </div>
                    <div class="clearfix" style="width:980px;">
                        <div class="shop-fl fl">
                            <div class="shop-work clearfix"><a href="#"><img src="/D2/Public/Home-img/ad/shop2.png"></a><a href="#"><img src="/D2/Public/Home-img/ad/shop3.png"></a> </div>
                            <div class="clearfix"><div class="shop-name fl"><a href="#"><img src="/D2/Public/Home-icon/shop-user.png"></a></div><div class=" fl"><p>搜悦用户</p> <p>2015-5-24 <em>11:25</em></p> </div></div>
                            <div class="shop-sun"><p>晒单内容:</p> <p>物美价廉，挺好的，物流超快.很不错，下次继续来</p> <p class="shop-see"><a href="#">查看商品</a> </p> </div>
                        </div>
                        <div class="shop-fl fl">
                            <div class="shop-work clearfix"><a href="#"><img src="/D2/Public/Home-img/ad/shop2.png"></a><a href="#"><img src="/D2/Public/Home-img/ad/shop3.png"></a> </div>
                            <div class="clearfix"><div class="shop-name fl"><a href="#"><img src="/D2/Public/Home-icon/shop-user.png"></a></div><div class=" fl"><p>搜悦用户</p> <p>2015-5-24 <em>11:25</em></p> </div></div>
                            <div class="shop-sun"><p>晒单内容:</p> <p>物美价廉，挺好的，物流超快.很不错，下次继续来</p> <p class="shop-see"><a href="#">查看商品</a> </p> </div>
                        </div>
                        <div class="shop-fl fl">
                            <div class="shop-work clearfix"><a href="#"><img src="/D2/Public/Home-img/ad/shop2.png"></a><a href="#"><img src="/D2/Public/Home-img/ad/shop3.png"></a> </div>
                            <div class="clearfix"><div class="shop-name fl"><a href="#"><img src="/D2/Public/Home-icon/shop-user.png"></a></div><div class=" fl"><p>搜悦用户</p> <p>2015-5-24 <em>11:25</em></p> </div></div>
                            <div class="shop-sun"><p>晒单内容:</p> <p>物美价廉，挺好的，物流超快.很不错，下次继续来</p> <p class="shop-see"><a href="#">查看商品</a> </p> </div>
                        </div>
                        <div class="shop-fl fl">
                            <div class="shop-work clearfix"><a href="#"><img src="/D2/Public/Home-img/ad/shop2.png"></a><a href="#"><img src="/D2/Public/Home-img/ad/shop3.png"></a> </div>
                            <div class="clearfix"><div class="shop-name fl"><a href="#"><img src="/D2/Public/Home-icon/shop-user.png"></a></div><div class=" fl"><p>搜悦用户</p> <p>2015-5-24 <em>11:25</em></p> </div></div>
                            <div class="shop-sun"><p>晒单内容:</p> <p>物美价廉，挺好的，物流超快.很不错，下次继续来</p> <p class="shop-see"><a href="#">查看商品</a> </p> </div>
                        </div>
                        <div class="shop-fl fl">
                            <div class="shop-work clearfix"><a href="#"><img src="/D2/Public/Home-img/ad/shop2.png"></a><a href="#"><img src="/D2/Public/Home-img/ad/shop3.png"></a> </div>
                            <div class="clearfix"><div class="shop-name fl"><a href="#"><img src="/D2/Public/Home-icon/shop-user.png"></a></div><div class=" fl"><p>搜悦用户</p> <p>2015-5-24 <em>11:25</em></p> </div></div>
                            <div class="shop-sun"><p>晒单内容:</p> <p>物美价廉，挺好的，物流超快.很不错，下次继续来</p> <p class="shop-see"><a href="#">查看商品</a> </p> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

    <div class="link">
    <?php if(empty($list)): else: ?>
    <h1 style="margin:0 auto;text-align:center">友情链接</h1>
        <ul >
            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><li ><a href="<?php echo ($vo["url"]); ?>" class="grayscale" target="_blank"><img src="/D2/Public/Upload/<?php echo ($vo["pic"]); ?>" alt="<?php echo ($vo["name"]); ?>" width="140"></a></li><?php endforeach; endif; ?>
        </ul><?php endif; ?>
    </div>


<script>
$('.my_li').map(function() {
    // console.log(this);
    timer(this, $(this).attr('time'));
});
function timer(obj, intDiff){
    // console.log();
    $(obj).attr('new_time', window.setInterval(function(){
         var day=0,
                 hour=0,
                 minute=0,
                 second=0;//时间默认值
         if(intDiff > 0){
             day = Math.floor(intDiff / (60 * 60 * 24));
             hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
             minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
             second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
         }
         if (minute <= 9) minute = '0' + minute;
         if (second <= 9) second = '0' + second;
         // console.log($(obj).children());
         $(obj).children().eq(0).children().children().eq(0).html('<s id="h"></s>'+hour+'');
         $(obj).children().eq(0).children().children().eq(2).html('<s></s>'+minute+'');
         $(obj).children().eq(0).children().children().eq(4).html('<s></s>'+second+'');
         intDiff--;
        if(intDiff <= 0)
        {
            $(obj).children().eq(0).children().empty().append('<span style="display:inline-block;width:135px;height:32px;text-align:center;line-height:32px;border-radius:5px;color:#FFF;background-color:gray">开始抢购</span>');
            clearInterval($(obj).attr('new_time'));  
        }  
     }, 1000));
}

var scroll = null;
$($(window).scroll(function() {
    
    // console.log($(document).height());
    if($(window).scrollTop() > 700)
    {
        if(!$('.my_ul').attr('data'))
        {
            clearTimeout(scroll);
            scroll = setTimeout(function(){
               $.ajax({
                    url:'<?php echo U("index");?>',
                    type:'get',
                    data:{
                        model:'hotsale'
                    },
                    success:function(data)
                    {
                        var hotsale = '';
                        console.log('ajax请求限时抢购数据');
                        $('.hotbuy').empty();
                        $('.my_ul').empty();
                        $('.randpic').empty();
                        // $('.time-poued').empty();
                        // $('.news-right').empty();
                        $(data.data).map(function() {
                            hotsale += '<li time="' + this.addtime + '" class="my_li"><div class="time-title time-clear"><div class="time-item pc-time-item fl clearfix"><strong class="hour_show">00</strong><strong class="pc-clear-sr">:</strong><strong class="minute_show">00</strong><strong class="pc-clear-sr">:</strong><strong class="second_show">00</strong></div></div><a href="/D2/Home/Goods/detail/id/' + this.id + '" target="_blank"><img src="/D2/Public/Uploads/' + this.pic + '"><p class="head-name">' + this.name + '</p><p><span class="price">￥' + this.price + '</span><span class="discount">￥'+ this.normalprice + '</span></p><p class="label-default">3折</p></a></li>';
                        });

                        var pics = '<div class="time-list fl"><div class="time-title time-clear"><h2>卖场推荐</h2><a href="javascript:;" class="pc-spin fr" demo="pics" onClick="change(this)">换一换</a> </div><div class="time-poued clearfix my_pics">';
                        
                        $(data.pics).map(function() {
                            pics += '<a href="/D2/Home/Goods/detail/id/' + this.id + '"><img style="width:224px;height:243px"  src="/D2/Public/Uploads/' + this.pic + '"></a>';
                        });
                        pics += '</div></div><div class="news-list fr"><div class="time-title time-clear"><h2>今日值得购买</h2></div><div class="news-right"><a href="/D2/Home/Goods/detail/id/' + data.bigpic.id + '"><img style="width:306px;height:243px;" src="/D2/Public/Uploads/' + data.bigpic.pic + '"></a></div></div>';

                        var hotbuy = '<div class="yScrollList"><div class="yScrollListIn"><div style="display:block;" class="yScrollListInList yScrollListInList1"><ul class="change_hotbuy">';
                        $(data.hotbuy).map(function() {
                            hotbuy += '<li><a href="/D2/Home/Goods/detail/id/' + this.id + '"><img src="/D2/Public/Uploads/' + this.pic + '"><p class="head-name pc-pa10">' + this.name + '</p></a></li>';
                        });
                        hotbuy += '</ul></div></div></div>';

                        // $('.news-right').append($bigpic);
                        // $('.time-poued').append(pics);
                        $('.hotbuy').append(hotbuy);
                        $('.randpic').append(pics);
                        $('.my_ul').append(hotsale);
                        $('.my_ul').attr('data', true);
                        $('.my_li').map(function() {
                            // console.log(this);
                            timer(this, $(this).attr('time'));
                        });

                    }
                }); 
            }, 300);
        }
    }
}));

/*********点击改变商品图片*********/
function change(obj)
{
    var demo = $(obj).attr('demo');
    var page = $(obj).attr('page');
    $.ajax({
        url:'<?php echo U("index");?>',
        type:'get',
        data:{
            p:page,
            demo:demo,
            model:'hotsale'
        },
        success:function (data)
        {
            if(demo == 'hotbuy')
            {
                var div = '';
                $('.change_hotbuy').empty();
                $(obj).attr('page', data.page);
                $(data.hotbuy).map(function() {
                    div += '<li><a href="/D2/Home/Goods/detail/id/' + this.id + '"><img src="/D2/Public/Uploads/' + this.pic + '"><p class="head-name pc-pa10">' + this.name + '</p></a></li>';
                });
                $('.change_hotbuy').append(div);
            } else {
                var div = '';
                $('.my_pics').empty();
                $(data.pics).map(function() {
                    div += '<a href="/D2/Home/Goods/detail/id/' + this.id + '"><img style="width:224px;height:243px"  src="/D2/Public/Uploads/' + this.pic + '"></a>';
                });
                $('.my_pics').append(div);
            }
        }
    });
}
</script>

<script type="text/javascript">banner()</script>
</body>
</html>