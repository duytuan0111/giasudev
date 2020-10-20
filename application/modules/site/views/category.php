<?php 
?>
</header>
<section>

    <div class="tintuc">
        <div class="bg-blue">
            <div class="ctr container">
                <h1><?php echo $item->name; ?></h1>
            </div>
        </div>
        <div class="ctr">
            <div class="container maincontent">
                <div class="rowaddon2 colmd7">
                    <div class="col-md-8 news">
                        <?php $news_cat = $this->db->query('SELECT id,alias,title,image FROM tbl_baiviet WHERE status=1 AND vip=1 AND cid='.$item->id.' ORDER BY id DESC LIMIT 5'); 
                        if($news_cat->num_rows()>0){
                            ?>
                            <div class="box-new-01">
                                <ul>                
                                    <?php foreach ($news_cat->result() as $nc) { ?>
                                        <li><a href="<?php echo site_url($nc->alias.'-b'.$nc->id.'.html'); ?>" title="<?php echo $nc->title; ?>">
                                            <p><?php echo $nc->title; ?></p>
                                        </a></li>
                                    <?php } ?>
                                </ul>
                                <div class="clr" style="height:25px;"></div>                
                            </div>
                        <?php } ?>

                        <?php $news_cat = $this->db->query('SELECT id,alias,title,image,sapo,created_day FROM tbl_baiviet WHERE status=1 AND vip!=1 AND cid='.$item->id.' ORDER BY id DESC'); 
                        if($news_cat->num_rows()>0){
                            $i=0;
                            ?>
                            <div class="box-new-02">    
                                <?php foreach ($news_cat->result() as $nc) {
                                    $i++;
                                    if($i==1){
                                        ?>      
                                        <div class="new-vip">
                                            <div class="title"><a href="<?php echo site_url($nc->alias.'-b'.$nc->id.'.html'); ?>" ><?php echo $nc->title; ?></a></div>

                                            <?php echo $nc->sapo; ?>

                                        </div>

                                        <div class="clr" style="height:25px;"></div>
                                        <div class="news">
                                        <?php }else{ ?>
                                            <div class="item">
                                                <div class="title"><a href="<?php echo site_url($nc->alias.'-b'.$nc->id.'.html'); ?>" ><?php echo $nc->title; ?></a></div>

                                                <div class="sapo"><?php echo $nc->sapo; ?></div>

                                                <div class="clr" style="height:25px;"></div>
                                            </div>
                                        <?php } 
                                        if($i==$news_cat->num_rows()){
                                            ?>              

                                        </div>

                                        <div class="clr" style="height:25px;"></div>        
                                    <?php } } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>