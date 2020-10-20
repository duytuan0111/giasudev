<?php 
//$urlweb="http://localhost".$_SERVER['REQUEST_URI'] ;
//echo $urlweb;
//echo $this->uri->segment(1);
$urlweb=base_url().$this->uri->segment(1);
$urlweb=str_replace('_','.',$urlweb);
//echo $urlweb;
//if($urlweb != $canonical)
//{
//   header("HTTP/1.1 301 Moved Permanently"); 
//   header("Location: $canonical");
//   exit();
//}
?>
<section class="inner-header-title detailcom padd-top-30 padd-bot-30" style="background-image:url(images/banner-10.jpg);">
  <div class="container">
    <h1 style="text-transform: capitalize;"><?php echo $item->name ?></h1>
  </div>
</section>
<div class="clearfix"></div>
<!-- SubHeader -->
<section class="section">
  <div class="container">
    <div class="row no-mrg">
      <!-- Start Blogs -->
        <?php if($query->num_rows()>0){
          foreach ($query->result() as $nub) {         						  
            ?>
            <div class="col-md-6 catnews">
            <article class="blog-news">
              <div class="short-blog">
                <figure class="img-holder">
                  <a class="imgnews" href="<?php echo site_url($nub->alias.'-b'.$nub->id.'.html'); ?>"><img src="<?php echo base_url() ?>upload/news/thumb/<?php echo $nub->image; ?>" alt="<?php echo $nub->title; ?>"></a>
                  <div class="blog-post-date">
                    <?php 
                    $d = explode('-',explode(' ', $nub->created_day)[0]);
                    echo $d[2].'/'.$d[1].'/'.$d[0]; ?>
                  </div>
                </figure>
                <div class="blog-content">
                  <a href="<?php echo site_url($nub->alias.'-b'.$nub->id.'.html'); ?>"><h2><?php echo $nub->title; ?></h2></a>
                  <div class="blog-text">
                    <?php echo $nub->sapo; ?>
                    <div class="post-meta">Danh mục :  <span class="category"><a href="<?php echo site_url($item->alias.'.html') ?>"><?php echo $item->name ?></a></span></div>
                  </div>
                </div>
              </div>
            </article>
<div class="pagation pull-right">
            <?php echo $pagination; ?>
          </div>
        </div>
          <?php } } ?>
          
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
