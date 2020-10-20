<?php
?>
<style type="text/css">
	#ml_blog {
    background: #f5f5f5;
    padding: 30px;
}
#new .muc_luc {
    text-align: center;
}
.muc_luc {
    font-family: Roboto-Medium;
    font-size: 18px!important;
    color: #fff;
    padding-bottom: 8px;
}
.tt_phu_luc {
    text-transform: uppercase;
    text-align: center;
    color: #000;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 19px;
    }
.xemthem {
    padding: 10px;
    width: 100%;
    float: left;
    margin: 10px 0;
    border-left: 3px solid;
    text-align: justify;
    font-weight: 800;
    padding-left: 50px;
}
.table-of-contents li a.ul_h2 {
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    color: #ed1c24;
    list-style: none;
}
.table-of-contents li a.ul_h3 {
    padding-left: 20px;
    color: #000;
    font-size: 15px;
    font-weight: 700;
}
</style>
<?php
$replaceurl = str_replace('_html', '.html', $this->uri->segment(1));
$this->load->helper('simple_html_dom');
$link = $this->uri->segment(1);
$res = str_replace('_', '.', $link);
$gt = str_replace('src=', 'class="lazyload" src="/images/load.gif" data-src=', $item->content);

// 
$i = 1;
foreach ($laytieude as $key => $value) {
  if ($i <= 10) {
    $arr_span[] = "<li class='link_more'><a class='morenew' href=" . base_url() . vn_str_filter($value->title) . "-b" . $value->id . '.html' . "> $value->title</a></li>";
  }
  $i++;
}
?>
<section class="inner-header-title detailcom">
	<div class="container">
		<h1><?php echo $item->title; ?></h1>
	</div>
</section>
<div class="clearfix"></div>
<!-- SubHeader -->
<section class="section">
				<div class="container">
					<div class="row no-mrg">
						<div class="col-md-12">
							<article class="blog-news">
								<div class="full-blog detailnews">
								
									<figure class="img-holder">
                                        <div class="sapo"><?php echo $item->sapo; ?></div>
										<a class="imgnews" href="<?php echo site_url($item->alias.'-b'.$item->id.'.html'); ?>"><img src="<?echo base_url().'upload/news/'.$item->image; ?>" alt="<?php echo $item->title; ?>"></a>
										<div class="blog-post-date">
											<?php 
            						$d = explode('-',explode(' ', $item->created_day)[0]);
            						echo $d[2].'/'.$d[1].'/'.$d[0]; ?>
										</div>
									</figure>


									<div class="muc_luc" id="ml_blog">
										<?php  makeML($item->content, '', '', $res); ?>
									</div>

									
									<div class="full blog-content">
										<div class="blog-text">
											<?php  makeXemthem(makeML_content($gt, '', ''), $arr_span); ?>
											<div class="post-meta">Danh mục: <span class="category"><a href="<?php echo base_url().$cat->alias.'.html' ?>"><?php echo $cat->name ?></a></span></div>
										</div>
										<!--<div class="row no-mrg">
											<div class="blog-footer-social">
												<span>Share <i class="fa fa-share-alt"></i></span>
												<ul class="list-inline social">
													<li><a><i class="fa fa-facebook"></i></a></li>
													<li><a><i class="fa fa-twitter"></i></a></li>
													<li><a><i class="fa fa-google-plus"></i></a></li>
													<li><a><i class="fa fa-pinterest"></i></a></li>
												</ul>
											</div>
										</div>-->
									</div>
									<div class="col-md-12 news col-xs-12">
        <p class="nav-tabs text-center" style="margin-top: 10px ; padding:10px;background: #fff;font-size: 25px !important"> Bài viết Liên Quan</p>
        <div class="job-list">
          <?php
          $Check = 1;
          foreach ($laytieude as $key => $n) {
            if ($Check > 10) {
              ?>
              <div class="col-sm-12" id="hot_news">
                <div class="img_hot_new">
                  <a href="<?php $n->alias . '-b' . $n->id . '.html' ?>"><img class="lazyload" src="/images/load.gif" data-src="<?php base_url() . 'upload/news/thumb/' . $n->image ?>"></a>
                </div>
                <div class="text_hot_new">
                  <div class="tt-new-slide"> <a href="<?php $n->alias . '-b' . $n->id . '.html' ?>"><?php $n->title ?></a></div>
                  <div class="date-news"><i class="fa">&#xf0ce;</i><?php $d = explode('-', explode(' ', $n->created_day)[0]);
                  echo $d[2] . '-' . $d[1] . '-' . $d[0]; ?>
              </div>
                </div>
              </div>
          <?php
            }
            $Check++;
          }
          ?>
        </div>
        <div class="clear-float" style="height: 40px;"></div>
      </div>
								</div>
							</article>
            </div>
          </div>
        </div>
</section>        
<!-- SubHeader -->

<script src="<?php echo base_url() ?>combine.php?type=javascript&files=jquery.slimscroll.min.js"  type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    var configulr='<?php echo site_url() ?>';
        $('.right_tg').slimscroll({
  height: '400',
  allowPageScroll: true,
});
$("#keymonhon").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
           $.ajax(
              {
                  
                  url: configulr+"/site/ajaxtimgiasutheomonhoc",
                  type: "POST",
                  data: { monhoc:$("#keymonhon").val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                            $(".right_tg li").remove();
                          /*$("#list_workonline").innerHTML = reponse.data;*/                        
                            $(".right_tg").append(reponse.data); 
                      
                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              }); 
        }
    });
        });
 </script>

