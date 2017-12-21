<?php if (!defined('THINK_PATH')) exit();?>
<link rel="shortcut icon" type="image/x-icon" href="/D2/Public/Home-icon/favicon.ico">
<link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/base.css">
<link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/home.css">
<link rel="stylesheet" type="text/css" href="/D2/Public/Home-css/style.css">
<script type="text/javascript" src="/D2/Public/Home-js/jquery.js"></script>

<script>
    $(function() {
        $('.dorpdown').hover(function() {
            $(this).addClass("hover");
        }, function() {
            $(this).removeClass("hover");
        })
    });
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


    <style>
        .alert { display: none; position: fixed; top: 15%; left: 45%; min-width: 200px; margin-left: -100px; z-index: 99999; padding: 15px; border: 1px solid transparent; border-radius: 4px;
        } .alert-success { color: #a94442; background-color: #f2dede; border-color: #ebccd1;text-align: center;
        }
        .search-text{
            height: 36px;
        }
    </style>
    <div class="yHeader">
        <div class="yNavIndex">
            <div class="pullDown">
                <h2 class="pullDownTitle">全部商品分类</h2>
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
    <div class="alert"></div>
</header>
<!-- header End -->

<!-- 商品详情 begin -->
<section>
    <div class="pc-details" >
        <div class="containers">
            <div class="pc-nav-item">
                <a style="color:#f25350" class="pc-title" href="<?php echo U('Index/index');?>"> 首页 </a>
                <?php for($i = count($type); $i >= 0; $i--) : ?>       
                    <a style="color:#f25350" class="pc-title" href="<?php echo U('Goods/index', ['id' => $type[$i]['id']]);?>"> <?php echo ($type[$i]['name']); ?> </a> &gt;&gt; 
                <?php endfor; ?>
            </div>
            <div class="pc-details-l">
                <div class="pc-product clearfix">
                    <div class="pc-product-h">
                        <div class="pc-product-top"><img src="/D2/Public/Uploads/<?php echo ($data['pic']); ?>" id="big_img" width="418" height="418"></div>
                        <div class="pc-product-bop clearfix" id="pro_detail">
                            <ul>
                            <?php if(is_array($pics)): foreach($pics as $key=>$value): if($key == 0): ?><li><a href="javascript:void(0);" class="cur" simg="/D2/Public/Uploads/<?php echo ($value); ?>"><img src="/D2/Public/Uploads/<?php echo ($value); ?>" width="58" height="58"></a> 
                                    </li>
                                <?php else: ?>
                                    <li><a href="javascript:void(0);" simg="/D2/Public/Uploads/<?php echo ($value); ?>"><img src="/D2/Public/Uploads/<?php echo ($value); ?>" width="58" height="58"></a> 
                                    </li><?php endif; endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="pc-product-t">
                        <div class="pc-name-info">
                            <h1><?php echo ($data['name']); ?></h1>
                            <p class="clearfix pc-rate"><strong>￥<i><?php echo ($data['price']); ?></i></strong></p>
                            <p>由<a href="#" class="reds">福兴阁官方旗舰店</a> 负责发货，并提供售后服务。</p>
                        </div>
                        <div class="pc-dashed clearfix">
                            <span>累计销量：<em class="reds"><?php echo ($data['buynum']); ?></em> 件</span><b>|</b><span>累计评价：<em class="reds"><?php echo ($assessTotal); ?></em></span>
                        </div>
                        <!-- <form method="post" action="<?php echo U('ShopCar/index');?>">
                            <input type="hidden" id="my_id" name="id" value="<?php echo ($data['id']); ?>">
                            <input type="hidden" id="my_attr" name="attr" value="<?php echo ($default); ?>"> -->
                        <div class="pc-size">

                            <?php if(is_array($attr)): foreach($attr as $key=>$value): ?><div class=" pc-telling clearfix">
                                <div class="pc-version"><?php echo ($key); ?></div>
                                <div class="pc-adults">
                                    <ul>
                                        <?php if(is_array($value)): foreach($value as $key=>$val): ?><li><a onClick="change(this)" ><?php echo ($val); ?></a> </li><?php endforeach; endif; ?>
                                    </ul>
                                </div>
                            </div><?php endforeach; endif; ?>
                            
                            <div class="pc-telling clearfix">
                                <div class="pc-version">数量</div>
                                <div class="pc-adults clearfix">
                                    <div class="pc-adults-p clearfix fl">
                                    
                                        <input type="num" id="subnum" placeholder="1" value="1" name="num">
                                        <a style="text-align:center;" href="javascript:void(0);" class="amount1"><img src="/D2/Public/Home-img/shopcar/adding.jpg" ></a>
                                        <a style="text-align:center;" href="javascript:void(0);" class="amount2"><img src="/D2/Public/Home-img/shopcar/minus.jpg" ></a>
                                    
                                    </div>
                                    <div class="fl pc-letter ">件</div>
                                    <div class="fl pc-stock ">库存<em><?php echo ($data['stock']); ?></em>件</div>
                                </div>
                            </div>
                            
                            <div class="pc-number clearfix"><span class="fl">商品编号：<i id="gid"><?php echo ($data['id']); ?></i></span>
                        <!-- 判断是否收藏了此商品 -->
                            <?php if(empty($res)): ?><a onclick="add(this,<?php echo ($data['id']); ?>,<?php echo ($_SESSION['HomeUser']['id']); ?>)" href="javascript:void(0);" class="fr" style="width:50px;height: 50px;background-color:pink; text-align:center;line-height: 50px">收藏</a>
                            <?php else: ?>
                            <a onclick="del(this,<?php echo ($res[0]['id']); ?>)" href="javascript:void(0);" class="fr" style="width:50px;height: 50px;background-color:lightgrey; text-align:center;line-height: 50px">取消收藏</a><?php endif; ?></div>
                        </div>
                        <div class="pc-emption">
                            <a href="javascript:void(0)" class="buy">立即购买</a>
                            <a href="javascript:void(0)" class="join">加入购物车</a>
                        </div>
                        <!-- </form> -->
                    </div>
                 <!-- ajax收藏 -->
                <script>
                    // 删除
                    function del(obj,id)
                        {   
                            // 提交ajax
                            $.post('<?php echo U("Collect/delCollect");?>','id='+id,function(res){ 
                                if (res.status == '1') {
                                    // 增加收藏节点
                                    $(obj).parent().prepend("<a href='javascript:void(0);' onclick='add(this,<?php echo ($data['id']); ?>,<?php echo ($_SESSION['HomeUser']['id']); ?>)' class='fr' style='width:50px;height: 50px;background-color:pink; text-align:center;line-height: 50px'>收藏</a>");
                                    
                                    // 删除原节点
                                    $(obj).remove();
                                } else {
                                    $('.alert').html('删除失败').addClass('alert-success').show().delay(1500).fadeOut();
                                }                              
                            });
                        }
                    // 添加
                    function add(obj,gid,uid)
                        {  
                            // 提交ajax
                            $.post('<?php echo U("Collect/addCollect");?>',{'gid':gid,'uid':uid},function(info){ 
                                if (info.status == '1') {
                                    // 增加收藏节点
                                    $(obj).parent().prepend("<a onclick='del(this,"+info.id+")' href='javascript:void(0);' class='fr' style='width:50px;height: 50px;background-color:lightgrey; text-align:center;line-height: 50px'>取消收藏</a>");
                                    // 删除原节点
                                    $(obj).remove();
                                    $('.alert').html('收藏成功').addClass('alert-success').show().delay(1500).fadeOut();
                                } else {
                                    window.location.href="<?php echo U('Login/login');?>";
                                }                              
                            });
                        }
                </script>
                </div>
            </div>
        </div>
    </div>
    <div class="containers clearfix" style="margin-top:20px;">
        <div class="pc-info fr">
            <div class="pc-overall">
                <ul id="H-table1" class="brand-tab H-table1 H-table-shop clearfix my_ul">
                    <li class="cur"><a href="javascript:void(0);">商品介绍</a></li>
                    <li><a href="javascript:void(0);">商品评价<em class="reds">(<?php echo ($assessTotal); ?>)</em></a></li>
                    <li><a href="javascript:void(0);">马上评论</a></li>
                </ul>
                <div class="pc-term clearfix">
                   <div class="H-over1 pc-text-word clearfix">
                       <ul class="clearfix">
                           <li>
                               <p style="text-indent:2px;font-size: 24px"><?php echo ($data['des']); ?></p>
                           </li>
                           
                       </ul>
                       <div class="pc-line"></div>
                   </div>
                   <div class="H-over1" style="display:none">
                       <div class="pc-comment fl"><strong><?php $good=ceil($goodAssessTotal/$assessTotal*100); echo ($assessTotal == 0) ? 0 : $good;?><span>%</span></strong><br> <span>好评度</span></div>
                       <div class="pc-percent fl">
                           <dl>
                               <dt>好评<span>(<?= ($assessTotal == 0) ? 0 : $good?>%)</span></dt>
                               <dd><div style="width:<?= ($assessTotal == 0) ? 0 : $good?>px"></div></dd>
                           </dl>
                           <dl>
                               <dt>中评<span>(<?php $normal = floor($normalAssessTotal/$assessTotal*100); echo ($assessTotal == 0) ? 0 : $normal;?>%)</span></dt>
                               <dd><div style="width:<?= ($assessTotal == 0) ? 0 : $normal?>px"></div></dd>
                           </dl>
                           <dl>
                               <dt>差评<span>(<?php $bad = floor($badAssessTotal/$assessTotal*100); echo ($assessTotal == 0) ? 0 : $bad;?>%)</span></dt>
                               <dd><div style="width:<?= ($assessTotal == 0) ? 0 : $bad?>px"></div></dd>
                           </dl>
                       </div>
                   </div>
                   <div class="H-over1 pc-text-title" style="display:none">
                        <form action="<?php echo U('assess');?>" method="post">
                            <input type="hidden" name="gid" value="<?php echo ($data['id']); ?>">
                            <textarea <?php echo session('HomeUser') ? '' : 'readonly';?> name="content" style="margin: 0px; width: 966px; height: 175px;">登录后才能评论哦~</textarea><br />
                            <button <?php echo session('HomeUser') ? '' : 'disabled';?> style="float: right;margin-top: 10px;margin-bottom: 10px;width:50px;background-color: #e6433e;color:#FFF;border:1px solid #e6433e;border-radius: 5px;">评论</button>
                            <label><input checked <?php echo session('HomeUser') ? '' : 'disabled';?> class="my_radio_good" type="radio" name="feel" value="1"><span class="my_radio radiogood" >好评</span></label>
                            <label><input <?php echo session('HomeUser') ? '' : 'disabled';?> class="my_radio_normal" type="radio" name="feel" value="2"><span class="my_radio radionormal" >中评</span></label>
                            <label><input <?php echo session('HomeUser') ? '' : 'disabled';?> class="my_radio_bad" type="radio" name="feel" value="3"><span class="my_radio radiobad" >差评</span></label>
                            <label style="height:20px;line-height: 20px;padding: 5px;float:right"><input style="margin-top: 2px" type="checkbox" name="status" <?php echo session('HomeUser') ? '' : 'disabled';?> value="0"><span style="width:65px;display: inline-block;" >匿名评价</span></label>
                       </form>
                       <div class="pc-line"></div>
                   </div>
                </div>
            </div>
            <div class="pc-overall">
                <ul class="brand-tab H-table H-table-shop clearfix " id="H-table" style="margin-left:0;">
                    <li class="cur"><a feel="4" onclick="assess(this)">全部评价（<?php echo ($assessTotal); ?>）</a></li>
                    <li><a feel="1" onclick="assess(this)"><i>好评</i><em class="reds">（<?php echo ($goodAssessTotal); ?>）</em></a></li>
                    <li><a feel="2" onclick="assess(this)"><i>中评</i><em class="reds">（<?php echo ($normalAssessTotal); ?>）</em></a></li>
                    <li><a feel="3" onclick="assess(this)"><i>差评</i><em class="reds">（<?php echo ($badAssessTotal); ?>）</em></a></li>
                </ul>
                <div class="pc-term clearfix">
                    <div class="pc-column">
                        <span class="column1">评价心得</span>
                        <span class="column2">顾客满意度</span>

                        <span class="column4">评论者</span>
                    </div>
                    <div class="pc-comments clearfix">
                        <ul class="clearfix" page="2">

                        <?php if(empty($allAssess)): ?><li class="clearfix">
                                <div class="column1">
                                    <p>暂无评论~请点击<strong>马上评论</strong></p>
                                </div>
                            </li>
                        <?php else: ?>
                            <?php if(is_array($allAssess)): foreach($allAssess as $key=>$v): ?><li class="clearfix">
                                <div class="column1">
                                    <p><?php echo ($v['content']); ?></p>
                                    <p class="column5"><?php echo ($v['addtime']); ?></p>
                                </div>

                                <div class="column2">
                                    <p><?php echo ($v['feel']); ?></p>
                                </div>
                                <div class="column4">
                                    <img style="width:50px;height:50px" src="/D2/Public/Uploads/<?php echo ($v['photo']); ?>">
                                    <p><?php echo ($v['username']); ?></p>
                                </div>
                            </li><?php endforeach; endif; endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- <div class="clearfix">
                <div class="fr pc-search-g pc-search-gs">
                    <a href="#" class="fl " style="display:none">上一页</a>
                    <a class="current" href="#">1</a>
                    <a href="javascript:;">2</a>
                    <a href="javascript:;">3</a>
                    <a href="javascript:;">4</a>
                    <a href="javascript:;">5</a>
                    <a href="javascript:;">6</a>
                    <a href="javascript:;">7</a>
                    <span class="pc-search-di">…</span>
                    <a href="javascript:;">1088</a>
                    <a href="javascript:;" class="" title="使用方向键右键也可翻到下一页哦！">下一页</a>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- 商品详情 End -->

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




<!-- class="cur" -->
<script>
$('.pc-adults > ul').eq(0).children().children().eq(0).addClass('cur');
$('.pc-adults > ul').eq(1).children().children().eq(0).addClass('cur');
var attrInfo = "<?php echo ($default); ?>";

$(function(){
    var id = $('.pc-number span i').html();
    var attr = $('.cur').eq(1).parent().parent().parent().prev().html();
    var attr1 = $('.cur').eq(2).parent().parent().parent().prev().html();
    var val = $('.cur').eq(1).html();
    var val1 = $('.cur').eq(2).html();
    var str = attr + ':' + val+',' + attr1 + ':' + val1;
    $.ajax({
        url:'<?php echo U("detail");?>',
        type:'get',
        data:{
            id:id,
            attr:str
        },
        success:function (data)
        {
            // console.log(data);
            $('.pc-stock em').html(data.stock);
            $('.pc-rate strong i').html(data.price);
            $('#my_attr').val(str);
            if(data.disabled == 'disabled')
            {
                $('.pc-emption').empty().append('<a href="javascript:void(0)" class="buy">立即购买</a><a href="javascript:void(0)" class="join">加入购物车</a>');
                $('.join').css({
                    'background':'gray', 
                    'border-color':'gray', 
                    'color':'#FFF', 
                    'background-image':'url("/D2/Public/Uploads/shopcar.png")', 
                    'background-size':'15px 15px', 
                    'background-repeat':'no-repeat',
                    'background-position':'18px 10px'
                });
                $('.buy').css({
                    'background':'gray', 
                    'border-color':'gray', 
                    'color':'#FFF',
                });
            }
        }
    });
});

/*********请求商品属性信息*********/
function change(obj)
{
    $(obj).parent().siblings().children().removeClass('cur');
    $(obj).addClass('cur');
    var id = $('.pc-number span i').html();
    var attr = $('.cur').eq(1).parent().parent().parent().prev().html();
    var attr1 = $('.cur').eq(2).parent().parent().parent().prev().html();
    var val = $('.cur').eq(1).html();
    var val1 = $('.cur').eq(2).html();
    var str = attr + ':' + val+',' + attr1 + ':' + val1;
    $.ajax({
        url:'<?php echo U("detail");?>',
        type:'get',
        data:{
            id:id,
            attr:str
        },
        success:function (data)
        {
            // console.log(data);
            $('.pc-stock em').html(data.stock);
            $('.pc-rate strong i').html(data.price);
            $('#my_attr').val(str);
            if(data.disabled == 'disabled')
            {
                $('.pc-emption').empty().append('<a href="javascript:void(0)" class="buy">立即购买</a><a href="javascript:void(0)" class="join">加入购物车</a>');
                $('.join').css({
                    'background':'gray', 
                    'border-color':'gray', 
                    'color':'#FFF', 
                    'background-image':'url("/D2/Public/Uploads/shopcar.png")', 
                    'background-size':'15px 15px', 
                    'background-repeat':'no-repeat',
                    'background-position':'18px 10px'
                });
                $('.buy').css({
                    'background':'gray', 
                    'border-color':'gray', 
                    'color':'#FFF',
                });
            } else {
                $('.join').css({
                    'background':'#e6433e', 
                    'border-color':'#e6433e', 
                    'color':'#FFF', 
                    'background-image':'url("/D2/Public/Uploads/shopcar.png")', 
                    'background-size':'15px 15px', 
                    'background-repeat':'no-repeat',
                    'background-position':'18px 10px'
                });
                $('.buy').css({
                    'background':'#ffeded', 
                    'border-color':'#e6433e', 
                    'color':'#c40000',
                });
            }
            attrInfo = str;
        }
    });
}
var id = $('#my_id').val();
/*********请求评论信息*********/
function assess(obj)
{
    var str = $(obj).attr('feel');
    
    var tmp = '';
    if($(obj).data('cache'))
    {
        $('.pc-comments').children().empty();
        $('.pc-comments').children().append($(obj).data('cache'));
    } else {
        $.ajax({
            url:'<?php echo U("detail");?>',
            type:'get',
            data:{
                id:id,
                assess:str
            },
            success:function (data)
            {
                console.log('ajax请求');
                var div = '';
                $('.pc-comments').children().empty();
                // console.log(data);
                $(data).map(function() {
                    div += '<li class="clearfix"><div class="column1"><p>'+this.content+'</p><p class="column5">'+this.addtime+'</p></div><div class="column2"><p>'+this.feel+'</p></div><div class="column4"><img style="width:50px;height:50px" src="/D2/Public/Uploads/'+this.photo+'"><p>'+this.username+'</p></div></li>';
                });
                $('.pc-comments').children().append(div);
                $(obj).data('cache', div);
            }
        });
    }
    
}
/*********滚动加载商品评论*********/
var timer = null;
$(window).scroll( function() {
    
    var li = $('.H-table li').eq(0);
    // console.log($(document).height());
    // console.log(window.screen.height);
    if(li.attr('class') == 'cur' && $(document).height() - $(window).scrollTop() < 1050)
    {
        var p = $('.pc-comments').children().attr('page');
        clearTimeout(timer);
        timer = setTimeout(function(){
            $.ajax({
                url:'<?php echo U("detail");?>',
                type:'get',
                data:{
                    id:id,
                    p:p,
                    assess:4
                },
                success:function(data)
                {
                    var div = '';
                    $('.pc-comments').children().attr('page', data.page);
                    delete data.page;
                    // console.log(data);
                    $(data.data).map(function() {
                        div += '<li class="clearfix"><div class="column1"><p>'+this.content+'</p><p class="column5">'+this.addtime+'</p></div><div class="column2"><p>'+this.feel+'</p></div><div class="column4"><img style="width:50px;height:50px" src="/D2/Public/Uploads/'+this.photo+'"><p>'+this.username+'</p></div></li>';
                    });
                    
                        $('.pc-comments').children().append(div);
                    
                }
            });
        }, 400);
    }
});

/*********加入购物车*********/
$('.join').click(function(){
    var num = $("#subnum").val();
    var gid = "<?php echo ($data['id']); ?>";
    $.ajax({
        type:'get',
        url:"<?php echo U('ShopCar/addToCart');?>",
        data:{"gid":gid,"info":attrInfo,"buyNum":num},
        success:function(res){
            $.ajax({
                type:'get',
                url:"<?php echo U('ShopCar/shopcar');?>",
                success:function(res){
                    var li = '';
                    var total = 0;
                    var totalNum = 0;
                    if(res.info) {
                        for (var k in res.info) {
                            li += '<li idInfo="'+res.info[k].gid+'_'+res.info[k].id+'"><div class="p-img fl"><a href="/D2/Home/Goods/detail/id/'+res.info[k].gid+'.html"><img width="50" height="50" alt="" src="/D2/Public/Uploads/'+res.info[k].pic+'" /></a></div><div class="p-name fl"><a target="_blank" title="'+res.info[k].name+res.info[k].attr+'" href="">'+res.info[k].name+res.info[k].attr+'</a></div><div class="p-detail fr ar"><span class="p-price"><strong>￥'+res.info[k].price+'</strong>&times;'+res.info[k].buyNum+'</span><br /><a href="javascript:void(0)" data-type="RemoveProduct" data-id="1006559999" class="delete">删除</a></div></li>';
                            total += Number(res.info[k].buyNum);
                            totalNum += Number(res.info[k].buyNum * res.info[k].price)
                        }
                        $('#mcart-sigle').html(li);
                        $('#shopping-amount').html(total);
                        $('.p-total b').html(total);
                        $('.p-total strong').html('￥'+totalNum);
                    } 
                }
            });
            $('.alert').html(res.info).addClass('alert-success').show().delay(1500).fadeOut();
        }
    });
});


$('.buy').click(function(){
    var num = $("#subnum").val();
    var gid = "<?php echo ($data['id']); ?>";
    $.ajax({
        type:'get',
        url:"<?php echo U('ShopCar/addToCart');?>",
        data:{"gid":gid,"info":attrInfo,"buyNum":num},
        success:function(res){
            if(res.status) {
                location.href="<?php echo U('ShopCar/shopcar');?>";
            } else{
                $('.alert').html(res.info).addClass('alert-success').show().delay(1500).fadeOut();
            }
        }
    });
});
// /*********清除文本域提示信息*********/
// $('textarea').on('click', function() {
//     $(this).val('');
// });
</script>
<script>

         
            $("#pro_detail a").click(function(){
                $("#pro_detail a").removeClass("cur");
                $(this).addClass("cur");
                $("#big_img").attr("src",$(this).attr("simg"));
            });
            
            $(".attrdiv a").click(function(){
                $(".attrdiv a").removeClass("cur");
                $(this).addClass("cur");
            });
            
            $('.amount2').click(function(){
                var num_input = $("#subnum");
                var buy_num = (num_input.val()-1)>0?(num_input.val()-1):1;
                num_input.val(buy_num);
            });
        
            $('.amount1').click(function(){
                var num_input = $("#subnum");
                var buy_num = (Number(num_input.val())+1)>$('.pc-stock em').html()?$('.pc-stock em').html():Number(num_input.val())+1;
                num_input.val(buy_num);
            });

            $("#subnum").blur(function(){
                var num_input = $("#subnum");
                var buy_num = Number(num_input.val())>$('.pc-stock em').html()?$('.pc-stock em').html():Number(num_input.val());
                buy_num = isNaN(buy_num)?1:buy_num;
                num_input.val(buy_num);
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
</script>

<script type="text/javascript">banner()</script>
</body>
</html>