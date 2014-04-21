<?php
if(!isset($configs_are_set)) {
	include("configs.php");
}
$thisPage = $_SERVER['PHP_SELF'];

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql);
$Options = mysql_fetch_assoc($sql_result);
$OptionsVis = unserialize($Options['visual']);
$OptionsLang = unserialize($Options['language']);

function lang_date($subject) {	
	$search  = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
	
	$replace = array(
					ReadDB($GLOBALS['OptionsLang']['January']), 
					ReadDB($GLOBALS['OptionsLang']['February']), 
					ReadDB($GLOBALS['OptionsLang']['March']), 
					ReadDB($GLOBALS['OptionsLang']['April']), 
					ReadDB($GLOBALS['OptionsLang']['May']), 
					ReadDB($GLOBALS['OptionsLang']['June']), 
					ReadDB($GLOBALS['OptionsLang']['July']), 
					ReadDB($GLOBALS['OptionsLang']['August']), 
					ReadDB($GLOBALS['OptionsLang']['September']), 
					ReadDB($GLOBALS['OptionsLang']['October']), 
					ReadDB($GLOBALS['OptionsLang']['November']), 
					ReadDB($GLOBALS['OptionsLang']['December']), 
					ReadDB($GLOBALS['OptionsLang']['Monday']), 
					ReadDB($GLOBALS['OptionsLang']['Tuesday']), 
					ReadDB($GLOBALS['OptionsLang']['Wednesday']), 
					ReadDB($GLOBALS['OptionsLang']['Thursday']), 
					ReadDB($GLOBALS['OptionsLang']['Friday']), 
					ReadDB($GLOBALS['OptionsLang']['Saturday']), 
					ReadDB($GLOBALS['OptionsLang']['Sunday'])
					);

	$lang_date = str_replace($search, $replace, $subject);
	return $lang_date;
}

?>
<div style="background-color:<?php echo $OptionsVis["gen_bgr_color"];?>;">
<div style="font-family:<?php echo $OptionsVis["gen_font_family"];?>; font-size:<?php echo $OptionsVis["gen_font_size"];?>;margin:0 auto;width:<?php echo $OptionsVis["gen_width"];?>px; color:<?php echo $OptionsVis["gen_font_color"];?>;">

<?php if($Options['showsearch']=='yes') {?>
<div style="text-align:right">
<form action="<?php echo $thisPage; ?>" method="post" name="form" style="margin:0; padding:0;">
  <input type="text" name="search" value="<?php if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') echo htmlspecialchars(urldecode($_REQUEST["search"]), ENT_QUOTES); ?>" />
  <input name="SearchBlog" type="submit" value="<?php echo $OptionsLang["Search_button"]; ?>" />
</form>
</div>
<div style="clear:both;height:10px;"></div>
<?php } ?>

<?php
if ($_REQUEST["id"]>0) {	
	$_REQUEST["id"]= (int) mysql_real_escape_string($_REQUEST["id"]);
?>
	<div style="clear: both; height:0px; margin:0; padding:0; line-height:0; font-size:0;float:none;"></div>
    <a name="ontitle" id="ontitle"></a>
	<?php if($OptionsLang["Back_to_home"]!='') { ?>
    <div style="text-align:<?php echo $OptionsVis["link_align"]; ?>;margin:0; padding:0; float:none;"><a href="<?php echo $thisPage; ?>?p=<?php echo $_REQUEST['p']; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>" style='font-weight:<?php echo $OptionsVis["link_font_weight"]; ?>;color:<?php echo $OptionsVis["link_color"]; ?>;font-size:<?php echo $OptionsVis["link_font_size"]; ?>;text-decoration:underline'><?php echo $OptionsLang["Back_to_home"]; ?></a></div>    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_link_title"];?>;margin:0; padding:0; line-height:0; font-size:0; float:none;"></div>    
    <?php } ?>

	<?php 
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE status='Published' AND id='".mysql_real_escape_string($_REQUEST["id"])."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql);
	if(mysql_num_rows($sql_result)>0) {	
	  $News = mysql_fetch_assoc($sql_result);
	?>
	
	<div style="color:<?php echo $OptionsVis["title_color"];?>;font-family:<?php echo $OptionsVis["title_font"];?>;font-size:<?php echo $OptionsVis["title_size"];?>;font-weight:<?php echo $OptionsVis["title_font_weight"];?>;font-style:<?php echo $OptionsVis["title_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;margin:0; padding:0; float:none;">	  
            <?php echo ReadHTML($News["title"]); ?>     
    </div>
    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_title_date"];?>;margin:0; padding:0; line-height:0; font-size:0; float:none;"></div>
    
    <div style="color:<?php echo $OptionsVis["date_color"];?>; font-family:<?php echo $OptionsVis["date_font"];?>; font-size:<?php echo $OptionsVis["date_size"];?>;font-style: <?php echo $OptionsVis["date_font_style"];?>;text-align:<?php echo $OptionsVis["date_text_align"];?>;margin:0; padding:0; float:none;">
		<?php echo lang_date(date($OptionsVis["date_format"],strtotime($News["publish_date"]))); ?> 
		<?php if($OptionsVis["showing_time"]!='') echo date($OptionsVis["showing_time"],strtotime($News["publish_date"])); ?>
    </div>
    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_date_text"];?>;margin:0; padding:0; line-height:0; font-size:0; float:none;"></div>
    
    <div style="color:<?php echo $OptionsVis["summ_color"];?>; font-family:<?php echo $OptionsVis["summ_font"];?>; font-size:<?php echo $OptionsVis["summ_size"];?>;font-style: <?php echo $OptionsVis["summ_font_style"];?>;text-align:<?php echo $OptionsVis["summ_text_align"];?>;line-height:<?php echo $OptionsVis["summ_line_height"];?>;margin:0; padding:0; float:none;">
      <?php if(ReadDB($News["image"])!='') { ?>
      
		<?php if(ReadDB($News["imgpos"])=='left') { ?>
        <div style="float:left">
        	<img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-right:14px; padding-bottom:3px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" />
            <div style="color:<?php echo $OptionsVis["capt_color"];?>;font-family:<?php echo $OptionsVis["capt_font"];?>;font-size:<?php echo $OptionsVis["capt_size"];?>;font-weight:<?php echo $OptionsVis["capt_font_weight"];?>;font-style:<?php echo $OptionsVis["capt_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;padding-bottom:3px;padding-right:14px;"><?php echo ReadDB($News["caption"]); ?></div>
        </div>
		<?php } ?>
        
        <?php if(ReadDB($News["imgpos"])=='right') { ?>
        <div style="float:right">
        	<img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-left:14px; padding-bottom:3px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" />
            <div style="color:<?php echo $OptionsVis["capt_color"];?>;font-family:<?php echo $OptionsVis["capt_font"];?>;font-size:<?php echo $OptionsVis["capt_size"];?>;font-weight:<?php echo $OptionsVis["capt_font_weight"];?>;font-style:<?php echo $OptionsVis["capt_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;padding-bottom:3px;padding-left:14px;"><?php echo ReadDB($News["caption"]); ?></div>
        </div>
		<?php } ?>
        
        <?php if(ReadDB($News["imgpos"])=='top') { ?>
        <div style="clear:both; text-align:center">
        	<img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:4px;padding-top:3px;" width="<?php echo $News["imgwidth"]; ?>" />
            <div style="color:<?php echo $OptionsVis["capt_color"];?>;font-family:<?php echo $OptionsVis["capt_font"];?>;font-size:<?php echo $OptionsVis["capt_size"];?>;font-weight:<?php echo $OptionsVis["capt_font_weight"];?>;font-style:<?php echo $OptionsVis["capt_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;padding-bottom:11px; text-align:center;width:<?php echo $News["imgwidth"]; ?>; margin: 0 auto;"><?php echo ReadDB($News["caption"]); ?></div>
        </div>
		<?php } ?>
        
      <?php } ?>
      
        <?php echo ReadDB($News["content"]); ?> 
        
      <?php if(ReadDB($News["image"])!='') { ?>
      
        <?php if(ReadDB($News["imgpos"])=='bottom') { ?>
        <div style="clear:both; text-align:center">
        	<img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:3px;padding-top:10px;" width="<?php echo $News["imgwidth"]; ?>" />
            <div style="color:<?php echo $OptionsVis["capt_color"];?>;font-family:<?php echo $OptionsVis["capt_font"];?>;font-size:<?php echo $OptionsVis["capt_size"];?>;font-weight:<?php echo $OptionsVis["capt_font_weight"];?>;font-style:<?php echo $OptionsVis["capt_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;padding-bottom:7px; text-align:center; width:<?php echo $News["imgwidth"]; ?>;margin: 0 auto;"><?php echo ReadDB($News["caption"]); ?></div>
        </div>
		<?php } ?>
        
      <?php } ?>
    </div>
    
    <div style="clear:both;margin:0; padding:0; line-height:0; font-size:0; float:none;"></div>
    
    <?php 
	$sql = "UPDATE ".$TABLE["News"]." 
			SET reviews = reviews + 1 
			WHERE id='".mysql_real_escape_string($_REQUEST["id"])."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql);	
	?>
	<?php } // end if mysql num rows ?>
<?php
} else {
?>

  	<div style="margin:0; padding:0; float:none; clear:both">  	
    	<?php 
		if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
			$pageNum = (int) mysql_real_escape_string(urldecode($_REQUEST["p"]));
			if($pageNum<=0) $pageNum = 1;
		} else { 
			$pageNum = 1;
		}
		
		if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
			$find = mysql_real_escape_string(urldecode($_REQUEST["search"]));
			$search = " AND (title LIKE '%".$find."%' OR summary LIKE '%".$find."%' OR content LIKE '%".$find."%')";
		}  
				
		$sql   = "SELECT count(*) as total FROM ".$TABLE["News"]." WHERE status='Published' " .$search;
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error'.$sql);
		$row   = mysql_fetch_array($sql_result);
		$count = $row["total"];
		$pages = ceil($count/$Options["per_page"]);
	
		$sql = "SELECT * FROM ".$TABLE["News"]."  
				WHERE status='Published' " .$search . " 
				ORDER BY publish_date DESC 
				LIMIT " . ($pageNum-1)*$Options["per_page"] . "," . $Options["per_page"];	
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error'.$sql);
		
		if (mysql_num_rows($sql_result)>0) {	
		  while ($News = mysql_fetch_assoc($sql_result)) {
		?>
        
  		<div style="color:<?php echo $OptionsVis["title_color"];?>;font-family:<?php echo $OptionsVis["title_font"];?>;font-size:<?php echo $OptionsVis["title_size"];?>;font-style:<?php echo $OptionsVis["title_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;font-weight:<?php echo $OptionsVis["title_font_weight"];?>;margin:0; padding:0; float:none;">
          <?php if($Options['shownews']!='FullNews') { ?>
            <a style="color:<?php echo $OptionsVis["title_color"];?>;font-family:<?php echo $OptionsVis["title_font"];?>;font-size:<?php echo $OptionsVis["title_size"];?>;font-weight:<?php echo $OptionsVis["title_font_weight"];?>;font-style:<?php echo $OptionsVis["title_font_style"];?>;text-decoration:none" onmouseover="this.style.textDecoration = 'underline'" onmouseout="this.style.textDecoration = 'none'" href="<?php echo $thisPage; ?>?id=<?php echo $News['id']; ?>&p=<?php echo $_REQUEST['p']; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>#ontitle">
          <?php } ?>
				<?php echo ReadHTML($News["title"]); ?>
          <?php if($Options['shownews']!='FullNews') { ?>
            </a>
          <?php } ?>
        </div>
        
        <div style="clear:both; height:<?php echo $OptionsVis["dist_title_date"];?>;margin:0; padding:0; line-height:0; font-size:0; float:none;"></div>
        
        <div style="color:<?php echo $OptionsVis["date_color"];?>; font-family:<?php echo $OptionsVis["date_font"];?>; font-size:<?php echo $OptionsVis["date_size"];?>;font-style: <?php echo $OptionsVis["date_font_style"];?>;text-align:<?php echo $OptionsVis["date_text_align"];?>;margin:0; padding:0; float:none;">
			<?php echo lang_date(date($OptionsVis["date_format"],strtotime($News["publish_date"]))); ?> 
			<?php if($OptionsVis["showing_time"]!='') echo date($OptionsVis["showing_time"],strtotime($News["publish_date"])); ?>
        </div>
        
        <div style="clear:both; height:<?php echo $OptionsVis["dist_date_text"];?>;margin:0; padding:0; line-height:0; font-size:0; float:none;"></div>
        
        <?php if($Options['shownews']=='TitleAndSummary') { ?>
        
		<div style="color:<?php echo $OptionsVis["summ_color"];?>; font-family:<?php echo $OptionsVis["summ_font"];?>; font-size:<?php echo $OptionsVis["summ_size"];?>;font-style: <?php echo $OptionsVis["summ_font_style"];?>;text-align:<?php echo $OptionsVis["summ_text_align"];?>;line-height:<?php echo $OptionsVis["summ_line_height"];?>;margin:0; padding:0; float:none;">
        	<?php if(ReadDB($News["thumb"])!='') { ?>
            <a href="<?php echo $thisPage; ?>?id=<?php echo $News['id']; ?>&p=<?php echo $_REQUEST['p']; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>#ontitle">
            	<div style="float:left"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["thumb"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-right:10px; padding-top:4px;border:0;" width="<?php echo $OptionsVis["summ_img_width"];?>" /></div>
            </a>
            <?php } ?>
			<?php echo nl2br(ReadDB($News["summary"])); ?> &nbsp; 
            <a style="color:<?php echo $OptionsVis["title_color"];?>; text-decoration: underline" href="<?php echo $thisPage; ?>?id=<?php echo $News['id']; ?>&p=<?php echo $_REQUEST['p']; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>#ontitle"><?php echo $OptionsLang['Read_more']; ?></a>
        </div>
                
		<?php } elseif($Options['shownews']=='FullNews') { ?>
         
        <div style="color:<?php echo $OptionsVis["summ_color"];?>; font-family:<?php echo $OptionsVis["summ_font"];?>; font-size:<?php echo $OptionsVis["summ_size"];?>;font-style: <?php echo $OptionsVis["summ_font_style"];?>;text-align:<?php echo $OptionsVis["summ_text_align"];?>;line-height:<?php echo $OptionsVis["summ_line_height"];?>;margin:0; padding:0; float:none;">
          <?php if(ReadDB($News["image"])!='') { ?>
      
			<?php if(ReadDB($News["imgpos"])=='left') { ?>
            <div style="float:left">
                <img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-right:14px; padding-bottom:3px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" />
                <div style="color:<?php echo $OptionsVis["capt_color"];?>;font-family:<?php echo $OptionsVis["capt_font"];?>;font-size:<?php echo $OptionsVis["capt_size"];?>;font-weight:<?php echo $OptionsVis["capt_font_weight"];?>;font-style:<?php echo $OptionsVis["capt_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;padding-bottom:3px;padding-right:14px;"><?php echo ReadDB($News["caption"]); ?></div>
            </div>
            <?php } ?>
            
            <?php if(ReadDB($News["imgpos"])=='right') { ?>
            <div style="float:right">
                <img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-left:14px; padding-bottom:3px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" />
                <div style="color:<?php echo $OptionsVis["capt_color"];?>;font-family:<?php echo $OptionsVis["capt_font"];?>;font-size:<?php echo $OptionsVis["capt_size"];?>;font-weight:<?php echo $OptionsVis["capt_font_weight"];?>;font-style:<?php echo $OptionsVis["capt_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;padding-bottom:3px;padding-left:14px;"><?php echo ReadDB($News["caption"]); ?></div>
            </div>
            <?php } ?>
            
            <?php if(ReadDB($News["imgpos"])=='top') { ?>
            <div style="clear:both; text-align:center">
                <img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:3px;" width="<?php echo $News["imgwidth"]; ?>" />
                <div style="color:<?php echo $OptionsVis["capt_color"];?>;font-family:<?php echo $OptionsVis["capt_font"];?>;font-size:<?php echo $OptionsVis["capt_size"];?>;font-weight:<?php echo $OptionsVis["capt_font_weight"];?>;font-style:<?php echo $OptionsVis["capt_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;padding-bottom:3px;"><?php echo ReadDB($News["caption"]); ?></div>
            </div>
            <?php } ?>
        
      	<?php } ?>
			<?php echo ReadDB($News["content"]); ?> 
          <?php if(ReadDB($News["image"])!='') { ?>
            <?php if(ReadDB($News["imgpos"])=='bottom') { ?>
            <div style="clear:both; text-align:center">
                <img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:3px;padding-top:10px;" width="<?php echo $News["imgwidth"]; ?>" />
                <div style="color:<?php echo $OptionsVis["capt_color"];?>;font-family:<?php echo $OptionsVis["capt_font"];?>;font-size:<?php echo $OptionsVis["capt_size"];?>;font-weight:<?php echo $OptionsVis["capt_font_weight"];?>;font-style:<?php echo $OptionsVis["capt_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;padding-bottom:7px;"><?php echo ReadDB($News["caption"]); ?></div>
            </div>
            <?php } ?>
           <?php } ?>
        </div>
        	
            <?php 
			$sqlU = "UPDATE ".$TABLE["News"]." 
					SET reviews = reviews + 1 
					WHERE id='".$News["id"]."'";
			$sql_resultU = mysql_query ($sqlU, $conn ) or die ('MySQL query error: '.$sqlU);	
			?>
        
		<?php } else { 
				// only titles
			  }
		?>
        
        
             
        <div style="clear:both; height:<?php echo $OptionsVis["dist_btw_news"];?>;margin:0; padding:0; float:none;"></div>
        
    <?php 
		}
		?>
        
        <div style="padding-top:14px;clear:both;text-align:<?php echo $OptionsVis["pag_align"];?>;font-size:<?php echo $OptionsVis["pag_font_size"];?>;margin:0; float:none;">
		<?php
        if ($pages>0) {
            echo "<span style='font-weight:".$OptionsVis["pag_font_weight"].";color:".$OptionsVis["pag_color"]."'>".$OptionsLang['Paging']." </span>";
            for($i=1;$i<=$pages;$i++){ 
                if($i == $pageNum ) echo "<strong style='font-weight:".$OptionsVis["pag_font_weight"].";color:".$OptionsVis["pag_color"]."'>" .$i. "</strong>";
                else echo "<a href='".$thisPage."?p=".$i."' style='font-weight:".$OptionsVis["pag_font_weight"].";color:".$OptionsVis["pag_color"]."'>".$i."</a>"; 
                echo "&nbsp; ";
            }
        }
        ?>    
    	</div>
              
        <?php 
        } else {
		?>
        <div style="line-height:20px; padding-bottom:20px;margin:0; float:none;"><?php echo $OptionsLang['No_news_published'] ?></div>
        <?php	
		}
		?>   
              
	</div>

<?php
}
?>
</div>
</div>