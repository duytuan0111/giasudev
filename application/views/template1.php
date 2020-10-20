<?php
        ob_start("ob_gzhandler");
        ob_start("ob_html_compress1");
      ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>
	<meta name="google-site-verification" content="sHB_kIyLvpmytXDQtZiGe9daQFRc-ZRMsYPi6_oPQVc" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta charset="UTF-8">
    
	<?php header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 600)); 
	//header('Cache-Control: max-age=300, public');
	
    ?>
    <meta property="og:url" content="https://timviec365.com.vn/gia-su/"/>
    <meta property="og:title" content="<?php if(isset($meta_title)){ ?><?php echo $meta_title; }?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:description"   content="<?php if(isset($meta_des)){echo $meta_des;} ?>"/>
    <meta property="og:url" content="<?php echo base_url() ?>"/>
    <meta property="og:image" content="<?php echo base_url() ?>"/>
    <meta property="og:image:width" content="333"/>
    <meta property="og:image:height" content="426"/>
    <meta name="theme-color" content="#13b5ea"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no , maximum-scale=1.0"/>
	<meta name="language" content="vn"/>
	<meta name="keywords" content="<?php if(isset($meta_key)){echo $meta_key;} ?>"/>
	<meta name="description" content="<?php if(isset($meta_des)){echo $meta_des;} ?>"/>	
	<link rel="canonical" href="<?php echo $canonical; ?>"/>
	<meta name="revisit-after" content="1 days" />	
	<meta name="robots" content="noindex,nofollow" />
	<base href="<?php echo base_url(); ?>" />	
	<title><?php if(isset($meta_title)){ ?><?php echo $meta_title; }?></title>	
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />	
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url() ?>combine.php?type=css&files=plugins.css,style1.css,green-style.css" />
   		
    <script src="<?php echo base_url() ?>combine.php?type=javascript&files=jquery.min.js,bootstrap.min.js,bootsnav.js,select2.min.js,loader.js,slick.min.js"  type="text/javascript"></script>
	
</head>
<body class="<?php echo $cssbody ?>">
 <div class="wrapper">
 <div class="Loader" style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(28, 39, 51); z-index: 999; display: none;">
 <div class="fl spinner2" style="position: absolute; left: 771.5px; top: 286.5px;">
    <div class="spinner-container container1">
        <div class="circle1">
        </div>
        <div class="circle2">
        </div>
        <div class="circle3">
        </div>
        <div class="circle4">
        </div>
    </div>
    <div class="spinner-container container2">
        <div class="circle1">
        </div>
        <div class="circle2">
        </div>
        <div class="circle3">
        </div>
        <div class="circle4">
        </div>
    </div>
    <div class="spinner-container container3">
        <div class="circle1">
        </div>
        <div class="circle2">
        </div>
        <div class="circle3">
        </div>
        <div class="circle4">
        </div>
    </div>
    </div>
 </div>
 <div class="wrapper">	
	<?php $this->load->view($content); ?>	
	<?php $this->load->view('footer'); ?>		
	
 </div>
</div>

   
   <script>
		(function(){
			var docElem = document.documentElement;
			window.lazySizesConfig = window.lazySizesConfig || {};
			window.lazySizesConfig.loadMode = 1;
			
			window.lazySizesConfig.expand = Math.max(Math.min(docElem.clientWidth, docElem.clientHeight, 768) - 1, 320);
			window.lazySizesConfig.expFactor = lazySizesConfig.expand < 479 ? 3 : 2;
		})();
	</script>
    <script src="<?php echo base_url() ?>combine.php?type=javascript&files=lazysizes.min.js,custom.js"  type="text/javascript"></script>
</body>
</html>
<?php
        ob_end_flush();
        ob_end_flush();
      ?>