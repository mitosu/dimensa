<?php
error_reporting(0);
session_start();
include("configs.php");

if (isset($_REQUEST["act"])) {
    if ($_REQUEST["act"] == 'logout') {
        $_SESSION["ProFiAnTsNeWsLoGin"] = "";
        unset($_SESSION["ProFiAnTsNeWsLoGin"]);
    } elseif ($_REQUEST["act"] == 'login') {
        if ($_REQUEST["user"] == $CONFIG["admin_user"] and $_REQUEST["pass"] == $CONFIG["admin_pass"]) {
            $md_sum = md5($CONFIG["admin_user"] . $CONFIG["admin_pass"]);
            $sess_id = $md_sum . strtotime("+3 hours");
            $_SESSION["ProFiAnTsNeWsLoGin"] = $sess_id;
            $_REQUEST["act"] = 'news';
        } else {
            $message = 'Incorrect login details.';
        }
    }
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administración de Noticias - Dimensa</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/stylepage.css">
                <script language="javascript" src="include/functions.js"></script>
                <script language="javascript" src="include/color_pick.js"></script>
                <script type="text/javascript" src="include/datetimepicker_css.js"></script>
                <link href="styles/admin.css" rel="stylesheet" type="text/css" />
                <link rel="stylesheet" href="css/bootstrap-theme.min.css">
                    <style>
                        body {
                            padding-top: 50px;
                            padding-bottom: 20px;
                            background-color: #cccccc;
                        }
                    </style>
                    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
                    </head>

                    <body>
                        <center>
                            <div class="logo"><h2><span class="label label-primary">Administración de Noticias :: DIMENSA</span></h2></div>
                            <div style="clear:both"></div>

                            <?php
                            $Logged = false;
                            if (isset($_SESSION["ProFiAnTsNeWsLoGin"]))
                                $temp_sid = $_SESSION["ProFiAnTsNeWsLoGin"];
                            $md_sum = md5($CONFIG["admin_user"] . $CONFIG["admin_pass"]);
                            $md_res = substr($temp_sid, 0, strlen($md_sum));
                            if (strcmp($md_sum, $md_res) == 0) {
                                $ts = substr($temp_sid, strlen($md_sum));
                                if ($ts > time())
                                    $Logged = true;
                            }
                            if ($Logged) {

                                function lang_date($subject) {
                                    $search = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

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

                                if ($_REQUEST["act"] == 'updateOptionsNews') {

                                    if (!isset($_REQUEST["showsearch"]) or $_REQUEST["showsearch"] == '')
                                        $_REQUEST["approval"] = 'yes';

                                    $sql = "UPDATE " . $TABLE["Options"] . " 
			SET per_page	='" . SaveDB($_REQUEST["per_page"]) . "',
				shownews	='" . SaveDB($_REQUEST["shownews"]) . "',
				showsearch	='" . SaveDB($_REQUEST["showsearch"]) . "',
				news_link	='" . SaveDB($_REQUEST["news_link"]) . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                    $_REQUEST["act"] = 'news_options';
                                    $message = 'News options saved.';
                                } elseif ($_REQUEST["act"] == 'updateOptionsVisual') {

                                    $visual['gen_font_family'] = $_REQUEST['gen_font_family'];
                                    $visual['gen_font_size'] = $_REQUEST['gen_font_size'];
                                    $visual['gen_font_color'] = $_REQUEST['gen_font_color'];
                                    $visual['gen_bgr_color'] = $_REQUEST['gen_bgr_color'];
                                    $visual['gen_width'] = $_REQUEST['gen_width'];

                                    $visual['title_color'] = $_REQUEST['title_color'];
                                    $visual['title_font'] = $_REQUEST['title_font'];
                                    $visual['title_size'] = $_REQUEST['title_size'];
                                    $visual['title_font_weight'] = $_REQUEST['title_font_weight'];
                                    $visual['title_font_style'] = $_REQUEST['title_font_style'];
                                    $visual['title_text_align'] = $_REQUEST['title_text_align'];

                                    $visual['date_color'] = $_REQUEST['date_color'];
                                    $visual['date_font'] = $_REQUEST['date_font'];
                                    $visual['date_size'] = $_REQUEST['date_size'];
                                    $visual['date_font_style'] = $_REQUEST['date_font_style'];
                                    $visual['date_text_align'] = $_REQUEST['date_text_align'];
                                    $visual['date_format'] = $_REQUEST['date_format'];
                                    $visual['showing_time'] = $_REQUEST['showing_time'];
                                    $visual['time_offset'] = $_REQUEST['time_offset'];

                                    $visual['capt_color'] = $_REQUEST['capt_color'];
                                    $visual['capt_font'] = $_REQUEST['capt_font'];
                                    $visual['capt_size'] = $_REQUEST['capt_size'];
                                    $visual['capt_font_weight'] = $_REQUEST['capt_font_weight'];
                                    $visual['capt_font_style'] = $_REQUEST['capt_font_style'];
                                    $visual['capt_text_align'] = $_REQUEST['capt_text_align'];

                                    $visual['summ_color'] = $_REQUEST['summ_color'];
                                    $visual['summ_font'] = $_REQUEST['summ_font'];
                                    $visual['summ_size'] = $_REQUEST['summ_size'];
                                    $visual['summ_font_style'] = $_REQUEST['summ_font_style'];
                                    $visual['summ_text_align'] = $_REQUEST['summ_text_align'];
                                    $visual['summ_line_height'] = $_REQUEST['summ_line_height'];
                                    $visual['summ_img_width'] = $_REQUEST['summ_img_width'];

                                    $visual['pag_font_size'] = $_REQUEST['pag_font_size'];
                                    $visual['pag_color'] = $_REQUEST['pag_color'];
                                    $visual['pag_font_weight'] = $_REQUEST['pag_font_weight'];
                                    $visual['pag_align'] = $_REQUEST['pag_align'];

                                    $visual['link_font_size'] = $_REQUEST['link_font_size'];
                                    $visual['link_color'] = $_REQUEST['link_color'];
                                    $visual['link_font_weight'] = $_REQUEST['link_font_weight'];
                                    $visual['link_align'] = $_REQUEST['link_align'];

                                    $visual['dist_title_date'] = $_REQUEST['dist_title_date'];
                                    $visual['dist_date_text'] = $_REQUEST['dist_date_text'];
                                    $visual['dist_btw_news'] = $_REQUEST['dist_btw_news'];
                                    $visual['dist_link_title'] = $_REQUEST['dist_link_title'];

                                    $visual = serialize($visual);

                                    $sql = "UPDATE " . $TABLE["Options"] . " 
			SET visual='" . mysql_escape_string($visual) . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                    $_REQUEST["act"] = 'visual_options';
                                    $message = 'Visual options saved.';
                                } elseif ($_REQUEST["act"] == 'updateOptionsLanguage') {

                                    // main words in the front-end of the script
                                    $language['Back_to_home'] = $_REQUEST['Back_to_home'];
                                    $language['Read_more'] = $_REQUEST['Read_more'];
                                    $language['Search_button'] = $_REQUEST['Search_button'];
                                    $language['Paging'] = $_REQUEST['Paging'];
                                    $language['No_news_published'] = $_REQUEST['No_news_published'];

                                    // days of the week in the dates
                                    $language['Monday'] = $_REQUEST['Monday'];
                                    $language['Tuesday'] = $_REQUEST['Tuesday'];
                                    $language['Wednesday'] = $_REQUEST['Wednesday'];
                                    $language['Thursday'] = $_REQUEST['Thursday'];
                                    $language['Friday'] = $_REQUEST['Friday'];
                                    $language['Saturday'] = $_REQUEST['Saturday'];
                                    $language['Sunday'] = $_REQUEST['Sunday'];

                                    // month names in the dates
                                    $language['January'] = $_REQUEST['January'];
                                    $language['February'] = $_REQUEST['February'];
                                    $language['March'] = $_REQUEST['March'];
                                    $language['April'] = $_REQUEST['April'];
                                    $language['May'] = $_REQUEST['May'];
                                    $language['June'] = $_REQUEST['June'];
                                    $language['July'] = $_REQUEST['July'];
                                    $language['August'] = $_REQUEST['August'];
                                    $language['September'] = $_REQUEST['September'];
                                    $language['October'] = $_REQUEST['October'];
                                    $language['November'] = $_REQUEST['November'];
                                    $language['December'] = $_REQUEST['December'];

                                    $language = serialize($language);

                                    $sql = "UPDATE " . $TABLE["Options"] . " 
			SET language='" . mysql_escape_string($language) . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                    $_REQUEST["act"] = 'language_options';
                                    $message = 'Language options saved.';
                                } elseif ($_REQUEST["act"] == "addNews") {

                                    $sql = "INSERT INTO " . $TABLE["News"] . " 
			SET publish_date = '" . SaveDB($_REQUEST["publish_date"]) . "',
				status = '" . SaveDB($_REQUEST["status"]) . "',
				title = '" . SaveDB($_REQUEST["title"]) . "',
				summary = '" . SaveDB($_REQUEST["summary"]) . "',
				content = '" . SaveDB($_REQUEST["content"]) . "',
				caption = '" . SaveDB($_REQUEST["caption"]) . "',
				imgpos = '" . SaveDB($_REQUEST["imgpos"]) . "',
				imgwidth = '" . SaveDB($_REQUEST["imgwidth"]) . "', 
				reviews = '0'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);

                                    $index_id = mysql_insert_id();

                                    // upload photo to the news article
                                    if (is_uploaded_file($_FILES["image"]['tmp_name'])) {

                                        $format = end(explode(".", $_FILES["image"]['name']));
                                        $formats = array("jpg", "jpeg", "JPG", "png", "PNG", "gif", "GIF");
                                        if (in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {

                                            $uploaddir = $CONFIG["upload_folder"];
                                            $name = $_FILES['image']['name'];
                                            $name = ereg_replace(" ", "_", $name);
                                            $name = ereg_replace("%20", "_", $name);
                                            $name = $index_id . "_" . $name;


                                            $filePath = $uploaddir . $name;
                                            chmod($filePath, 0777);

                                            if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
                                                $img_width = substr($_REQUEST["imgwidth"], 0, -2);
                                                Resize_File($filePath, $img_width, 0);

                                                $sql = "UPDATE " . $TABLE["News"] . "  
					SET image = '" . $name . "'  
					WHERE id='" . $index_id . "'";
                                                $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                                $message .= '';
                                            } else {
                                                $message = 'Cannot copy uploaded file to "' . $filePath . '". Try to set the right permissions (CHMOD 777) to "' . $CONFIG["upload_folder"] . '" folder.';
                                            }
                                        } else {
                                            $message .= 'Uploaded file must be an image. File is not uploaded. ';
                                        }
                                    } else { /* $message = 'Image file is not uploaded. '; */
                                    }


                                    // upload summary thumbnail to the news article
                                    if (is_uploaded_file($_FILES["thumb"]['tmp_name'])) {

                                        $format = end(explode(".", $_FILES["thumb"]['name']));
                                        $formats = array("jpg", "jpeg", "JPG", "png", "PNG", "gif", "GIF");
                                        if (in_array($format, $formats) and getimagesize($_FILES['thumb']['tmp_name'])) {

                                            $sql = "SELECT * FROM " . $TABLE["Options"];
                                            $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                            $Options = mysql_fetch_assoc($sql_result);
                                            $OptionsVis = unserialize($Options['visual']);

                                            $uploaddir = $CONFIG["upload_folder"];
                                            $name = $_FILES['thumb']['name'];
                                            $name = ereg_replace(" ", "_", $name);
                                            $name = ereg_replace("%20", "_", $name);
                                            $name = $index_id . "_th_" . $name;


                                            $filePath = $uploaddir . $name;
                                            chmod($filePath, 0777);

                                            if (move_uploaded_file($_FILES["thumb"]['tmp_name'], $filePath)) {
                                                $img_width = substr($_REQUEST["imgwidth"], 0, -2);
                                                Resize_File($filePath, $OptionsVis["summ_img_width"], 0);

                                                $sql = "UPDATE " . $TABLE["News"] . "  
					SET `thumb` = '" . $name . "'  
					WHERE id='" . $index_id . "'";
                                                $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                                $message .= '';
                                            } else {
                                                $message = 'Cannot copy uploaded file to "' . $filePath . '". Try to set the right permissions (CHMOD 777) to "' . $CONFIG["upload_folder"] . '" folder.';
                                            }
                                        } else {
                                            $message .= 'Uploaded file for thumbnail must be an image. File is not uploaded. ';
                                        }
                                    } else { /* $message = 'Image file is not uploaded. '; */
                                    }

                                    $_REQUEST["act"] = "news";
                                    $message .= 'News created';
                                } elseif ($_REQUEST["act"] == 'updateNews') {

                                    $sql = "UPDATE " . $TABLE["News"] . " 
			SET publish_date = '" . SaveDB($_REQUEST["publish_date"]) . "',
				status = '" . SaveDB($_REQUEST["status"]) . "',
                title = '" . SaveDB($_REQUEST["title"]) . "',
				summary = '" . SaveDB($_REQUEST["summary"]) . "',
				content = '" . SaveDB($_REQUEST["content"]) . "',
				caption = '" . SaveDB($_REQUEST["caption"]) . "',
				imgpos = '" . SaveDB($_REQUEST["imgpos"]) . "', 
				imgwidth = '" . SaveDB($_REQUEST["imgwidth"]) . "' 
			WHERE id='" . $_REQUEST["id"] . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);

                                    $sql = "SELECT * FROM " . $TABLE["News"] . " WHERE id = '" . $_REQUEST["id"] . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                    $imageArr = mysql_fetch_assoc($sql_result);
                                    $image = stripslashes($imageArr["image"]);
                                    $thumb = stripslashes($imageArr["thumb"]);

                                    $index_id = $_REQUEST["id"];

                                    // upload photo to the news article
                                    if (is_uploaded_file($_FILES["image"]['tmp_name'])) {

                                        $format = end(explode(".", $_FILES["image"]['name']));
                                        $formats = array("jpg", "jpeg", "JPG", "png", "PNG", "gif", "GIF");
                                        if (in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {

                                            if ($image != "")
                                                unlink($CONFIG["upload_folder"] . $image);

                                            $name = $_FILES['image']['name'];
                                            $name = ereg_replace(" ", "_", $name);
                                            $name = ereg_replace("%20", "_", $name);

                                            $filePath = $CONFIG["upload_folder"] . $index_id . "_" . $name;
                                            chmod($filePath, 0777);

                                            if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
                                                $img_width = substr($_REQUEST["imgwidth"], 0, -2);
                                                Resize_File($filePath, $img_width, 0);
                                                $sql = "UPDATE `" . $TABLE["News"] . "` 
					SET `image` = '" . mysql_escape_string($index_id . "_" . $name) . "' 
					WHERE id = '" . $index_id . "'";
                                                $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                            } else {
                                                $message = 'Cannot copy uploaded file to "' . $filePath . '". Try to set the right permissions (CHMOD 777) to "' . $CONFIG["upload_folder"] . '" folder.';
                                            }
                                        } else {
                                            $message .= 'Uploaded file must be an image. File is not uploaded. ';
                                        }
                                    }

                                    // upload summary thumbnail to the news article
                                    if (is_uploaded_file($_FILES["thumb"]['tmp_name'])) {

                                        $format = end(explode(".", $_FILES["thumb"]['name']));
                                        $formats = array("jpg", "jpeg", "JPG", "png", "PNG", "gif", "GIF");
                                        if (in_array($format, $formats) and getimagesize($_FILES['thumb']['tmp_name'])) {

                                            if ($thumb != "")
                                                unlink($CONFIG["upload_folder"] . $thumb);

                                            $sql = "SELECT * FROM " . $TABLE["Options"];
                                            $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                            $Options = mysql_fetch_assoc($sql_result);
                                            $OptionsVis = unserialize($Options['visual']);

                                            $name = $_FILES['thumb']['name'];
                                            $name = ereg_replace(" ", "_", $name);
                                            $name = ereg_replace("%20", "_", $name);

                                            $filePath = $CONFIG["upload_folder"] . $index_id . "_th_" . $name;
                                            chmod($filePath, 0777);

                                            if (move_uploaded_file($_FILES["thumb"]['tmp_name'], $filePath)) {
                                                $img_width = substr($_REQUEST["imgwidth"], 0, -2);
                                                Resize_File($filePath, $OptionsVis["summ_img_width"], 0);
                                                $sql = "UPDATE `" . $TABLE["News"] . "` 
					SET `thumb` = '" . mysql_escape_string($index_id . "_th_" . $name) . "' 
					WHERE id = '" . $index_id . "'";
                                                $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                            } else {
                                                $message = 'Cannot copy uploaded file to "' . $filePath . '". Try to set the right permissions (CHMOD 777) to "' . $CONFIG["upload_folder"] . '" folder.';
                                            }
                                        } else {
                                            $message .= 'Uploaded file for thumbnail must be an image. File is not uploaded. ';
                                        }
                                    }

                                    if ($_REQUEST["updatepreview"] == 'Update and Preview') {
                                        $_REQUEST["act"] = 'viewNews';
                                    } else {
                                        $_REQUEST["act"] = 'news';
                                    }
                                    $message .= 'News updated.';
                                } elseif ($_REQUEST["act"] == 'delNews') {

                                    $sql = "SELECT * FROM " . $TABLE["News"] . " WHERE id = '" . $_REQUEST["id"] . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql . " " . mysql_error());
                                    $imageArr = mysql_fetch_assoc($sql_result);
                                    $image = stripslashes($imageArr["image"]);
                                    if ($image != "")
                                        unlink($CONFIG["upload_folder"] . $image);
                                    $thumb = stripslashes($imageArr["thumb"]);
                                    if ($image != "")
                                        unlink($CONFIG["upload_folder"] . $thumb);

                                    $sql = "DELETE FROM " . $TABLE["News"] . " WHERE id='" . $_REQUEST["id"] . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql . " " . mysql_error());
                                    $_REQUEST["act"] = 'news';
                                    $message = 'News deleted.';
                                } elseif ($_REQUEST["act"] == "delImage") {

                                    $sql = "SELECT * FROM " . $TABLE["News"] . " WHERE id = '" . $_REQUEST["id"] . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql . " " . mysql_error());
                                    $imageArr = mysql_fetch_assoc($sql_result);
                                    $image = stripslashes($imageArr["image"]);
                                    if ($image != "")
                                        unlink($CONFIG["upload_folder"] . $image);

                                    $sql = "UPDATE `" . $TABLE["News"] . "` SET `image` = '' WHERE id = '" . $_REQUEST["id"] . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql . " " . mysql_error());

                                    $message = "Image deleted.";
                                    $_REQUEST["act"] = "editNews";
                                } elseif ($_REQUEST["act"] == "delThumb") {

                                    $sql = "SELECT * FROM " . $TABLE["News"] . " WHERE id = '" . $_REQUEST["id"] . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql . " " . mysql_error());
                                    $imageArr = mysql_fetch_assoc($sql_result);
                                    $image = stripslashes($imageArr["thumb"]);
                                    if ($image != "")
                                        unlink($CONFIG["upload_folder"] . $image);

                                    $sql = "UPDATE `" . $TABLE["News"] . "` SET `thumb` = '' WHERE id = '" . $_REQUEST["id"] . "'";
                                    $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql . " " . mysql_error());

                                    $message = "Image deleted.";
                                    $_REQUEST["act"] = "editNews";
                                }

                                if ($_REQUEST["act"] == '' or ! isset($_REQUEST["act"]))
                                    $_REQUEST["act"] = 'news';
                                ?> 

                                <div class="blue_line"></div>

                                <div class="divMenu">	
                                    <div class="menuButtons">
                                        <div class="menuButton"><a<?php if ($_REQUEST['act'] == 'news' or $_REQUEST['act'] == 'newNews' or $_REQUEST['act'] == 'rss') echo ' class="selected"'; ?> href="admin.php?act=news">News</a></div>
                                        <div class="menuButton"><a<?php if ($_REQUEST['act'] == 'news_options' or $_REQUEST['act'] == 'visual_options' or $_REQUEST['act'] == 'language_options') echo ' class="selected"'; ?> href="admin.php?act=news_options">Options</a></div>
                                        <div class="menuButton"><a<?php if ($_REQUEST['act'] == 'html') echo ' class="selected"'; ?> href="admin.php?act=html">Put on WebPage</a></div>
                                        <div class="menuButtonLogout"><a href="admin.php?act=logout">Logout</a></div>
                                        <div class="clear"></div>        
                                    </div>
                                </div>

                                <div class="blue_line"></div>


                                <?php
                                if ($_REQUEST["act"] == 'news' or $_REQUEST["act"] == 'newNews' or $_REQUEST["act"] == 'editNews' or $_REQUEST["act"] == 'viewNews' or $_REQUEST["act"] == 'rss') {
                                    ?>
                                    <div class="divSubMenu">	
                                        <div class="menuSubButtons">
                                            <div class="menuSubButton"><a<?php if ($_REQUEST['act'] == 'news') echo ' class="selected"'; ?> href="admin.php?act=news">News List</a></div>
                                            <div class="menuSubButton"><a<?php if ($_REQUEST['act'] == 'newNews') echo ' class="selected"'; ?> href="admin.php?act=newNews">Create News</a></div>
                                            <div class="menuSubButton"><a href="preview.php" target="_blank">News Preview</a></div>
                                            <div class="menuSubButton"><a<?php if ($_REQUEST['act'] == 'rss') echo ' class="selected"'; ?> href="admin.php?act=rss">RSS feed</a></div>
                                            <div class="clear"></div>        
                                        </div>
                                    </div>
                                    <?php
                                } elseif ($_REQUEST["act"] == 'news_options' or $_REQUEST["act"] == 'visual_options' or $_REQUEST["act"] == 'language_options') {
                                    ?>
                                    <div class="divSubMenu">	
                                        <div class="menuSubButtons">
                                            <div class="menuSubButton"><a<?php if ($_REQUEST['act'] == 'news_options') echo ' class="selected"'; ?> href="admin.php?act=news_options">News options</a></div>
                                            <div class="menuSubButton"><a<?php if ($_REQUEST['act'] == 'visual_options') echo ' class="selected"'; ?> href="admin.php?act=visual_options">Visual options</a></div>
                                            <div class="menuSubButton"><a<?php if ($_REQUEST['act'] == 'language_options') echo ' class="selected"'; ?> href="admin.php?act=language_options">Language options</a></div>
                                            <div class="clear"></div>        
                                        </div>
                                    </div>
    <?php } ?>

                                <div class="wrap_body">

                                    <?php if (isset($message)) { ?>
                                        <div class="message"><?php echo $message; ?></div>
    <?php } ?>


                                    <?php
                                    if ($_REQUEST["act"] == 'news') {

                                        $sql = "SELECT * FROM " . $TABLE["Options"];
                                        $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                        $Options = mysql_fetch_assoc($sql_result);
                                        $OptionsVis = unserialize($Options['visual']);
                                        $OptionsLang = unserialize($Options['language']);

                                        if (isset($_REQUEST["p"]) and $_REQUEST["p"] != '') {
                                            $pageNum = (int) mysql_real_escape_string(urldecode($_REQUEST["p"]));
                                            if ($pageNum <= 0)
                                                $pageNum = 1;
                                        } else {
                                            $pageNum = 1;
                                        }

                                        $orderByArr = array("publish_date", "title", "reviews");
                                        if (isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"] != '' and in_array($_REQUEST["orderBy"], $orderByArr)) {
                                            $orderBy = $_REQUEST["orderBy"];
                                        } else {
                                            $orderBy = "publish_date";
                                        }

                                        $orderTypeArr = array("DESC", "ASC");
                                        if (isset($_REQUEST["orderType"]) and $_REQUEST["orderType"] != '' and in_array($_REQUEST["orderType"], $orderTypeArr)) {
                                            $orderType = $_REQUEST["orderType"];
                                        } else {
                                            $orderType = "DESC";
                                        }
                                        if ($orderType == 'DESC') {
                                            $norderType = 'ASC';
                                        } else {
                                            $norderType = 'DESC';
                                        }
                                        ?>
                                        <div class="pageDescr">Below is a list of the news and you can edit and delete them.</div>

                                        <div class="searchForm">
                                            <form action="admin.php?act=news" method="post" name="form" class="formStyle">
                                                <input type="text" name="search" onfocus="searchdescr(this.value);" value="<?php if (isset($_REQUEST["search"])) echo $_REQUEST["search"];
                                        else echo 'enter part of news title'; ?>" class="searchfield" />
                                                <input type="submit" value="Search for news" class="submitButton" />
                                            </form>
                                        </div>

                                        <table border="0" cellspacing="0" cellpadding="8" class="allTables">
                                            <tr>
                                                <td class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=title">Title</a></td>
                                                <td width="22%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date">Date published</a></td>
                                                <td width="10%" class="headlist">Status</td>
                                                <td width="10%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=reviews">Reviews</a></td>
                                                <td class="headlist" colspan="3">&nbsp;</td>
                                            </tr>

                                            <?php
                                            if (isset($_REQUEST["search"]) and ( $_REQUEST["search"] != "")) {
                                                $findMe = mysql_escape_string($_REQUEST["search"]);
                                                $search = "WHERE title LIKE '%" . $findMe . "%'";
                                            } else {
                                                $search = '';
                                            }

                                            $sql = "SELECT count(*) as total FROM " . $TABLE["News"] . " " . $search;
                                            $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                            $row = mysql_fetch_array($sql_result);
                                            $count = $row["total"];
                                            $pages = ceil($count / 20);

                                            $sql = "SELECT * FROM " . $TABLE["News"] . " " . $search . " 
			ORDER BY " . $orderBy . " " . $orderType . "  
			LIMIT " . ($pageNum - 1) * 20 . ",20";
                                            $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);

                                            if (mysql_num_rows($sql_result) > 0) {
                                                while ($News = mysql_fetch_assoc($sql_result)) {
                                                    ?>
                                                    <tr>
                                                        <td class="bodylist"><?php echo ReadHTML($News["title"]); ?></td>
                                                        <td class="bodylist"><?php echo lang_date(date($OptionsVis["date_format"], strtotime($News["publish_date"]))); ?> </td>
                                                        <td class="bodylist"><?php echo ReadDB($News["status"]); ?></td>
                                                        <td class="bodylist"><?php if ($News["reviews"] == '') echo "0";
                                    else echo $News["reviews"]; ?></td>
                                                        <td class="bodylistAct"><a class="view" href='admin.php?act=viewNews&id=<?php echo $News["id"]; ?>'>Preview</a></td>
                                                        <td class="bodylistAct"><a href='admin.php?act=editNews&id=<?php echo $News["id"]; ?>'>Edit</a></td>
                                                        <td class="bodylistAct"><a class="delete" href="admin.php?act=delNews&id=<?php echo $News["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');">DELETE</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="7" style="border-bottom:1px solid #CCCCCC">No News!</td>
                                                </tr>
                                                        <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if ($pages > 0) {
                                                        ?>
                                                <tr>
                                                    <td colspan="7" class="bottomlist"><div class='paging'>Page: </div>
                                                <?php
                                                for ($i = 1; $i <= $pages; $i++) {
                                                    if ($i == $pageNum)
                                                        echo "<div class='paging'>" . $i . "</div>";
                                                    else
                                                        echo "<a href='admin.php?act=news&p=" . $i . "&search=" . $_REQUEST["search"] . "' class='paging'>" . $i . "</a>";
                                                    echo "&nbsp; ";
                                                }
                                                ?>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                        ?>
                                        </table>

        <?php
    } elseif ($_REQUEST["act"] == 'newNews') {
        $sql = "SELECT * FROM " . $TABLE["Options"];
        $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
        $Options = mysql_fetch_assoc($sql_result);
        $OptionsVis = unserialize($Options['visual']);
        ?>
                                        <form action="admin.php" method="post" name="form" enctype="multipart/form-data">
                                            <input type="hidden" name="act" value="addNews" />
                                            <div class="pageDescr">To create news please fill all the fields below and click on 'Create News' button.</div>
                                            <table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
                                                <tr>
                                                    <td colspan="2" valign="top" class="headlist">Create News</td>
                                                </tr>
                                                <tr>
                                                    <td class="formLeft">Status:</td>
                                                    <td>
                                                        <select name="status">
                                                            <option value="Published">Published</option>
                                                            <option value="Hidden">Hidden</option>
                                                        </select>
                                                    </td>
                                                </tr>          
                                                <tr>
                                                    <td class="formLeft">Title:</td>
                                                    <td><input type="text" name="title" size="100" maxlength="250" /></td>
                                                </tr>

                                                <tr>
                                                    <td class="formLeft" valign="top">Summary:</td>
                                                    <td><textarea name="summary" cols="80" rows="4"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLeft">Summary Photo:</td>
                                                    <td><input type="file" name="thumb" size="80" /></td>
                                                </tr> 
                                                <script src="nicEdit/nicEdit.js" type="text/javascript"></script>
                                                <script type="text/javascript">
                                                    bkLib.onDomLoaded(function() {
                                                        new nicEditor({iconsPath: 'nicEdit/nicEditorIcons.gif'}).panelInstance('content');
                                                    });
                                                </script>
                                                <tr>
                                                    <td class="formLeft" valign="top">Content:</td>
                                                    <td><textarea name="content" id="content" cols="80" rows="12"></textarea></td>
                                                </tr>

                                                <tr>
                                                    <td class="formLeft">Photo:</td>
                                                    <td><input type="file" name="image" size="80" /></td>
                                                </tr> 
                                                <tr>
                                                    <td class="formLeft">Photo Caption:</td>
                                                    <td><input type="text" name="caption" size="50" maxlength="100" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLeft">Image location in the text:</td>
                                                    <td>
                                                        <select name="imgpos">
                                                            <option value="left">left</option>
                                                            <option value="right">right</option>
                                                            <option value="top">top</option>
                                                            <option value="bottom">bottom</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="formLeft">Image width:</td>
                                                    <td>
                                                        <select name="imgwidth">
                                                            <option value="320px">320px</option>
                                                            <option value="300px">300px</option>
                                                            <option value="280px">280px</option>
                                                            <option value="260px">260px</option>
                                                            <option value="240px">240px</option>
                                                            <option value="220px">220px</option>
                                                            <option value="200px">200px</option>
                                                            <option value="180px">180px</option>
                                                            <option value="160px">160px</option>
                                                            <option value="140px">140px</option>
                                                            <option value="120px">120px</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="formLeft">Publish date:</td>
                                                    <td>
                                                        <input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " " . $OptionsVis["time_offset"])); ?>" readonly="readonly" /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit" type="submit" value="Create News" class="submitButton" /></td>
                                                </tr>
                                            </table>
                                        </form>


        <?php
    } elseif ($_REQUEST["act"] == 'editNews') {
        $sql = "SELECT * FROM " . $TABLE["News"] . " WHERE id='" . $_REQUEST["id"] . "'";
        $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
        $News = mysql_fetch_assoc($sql_result);
        ?>
                                        <form action="admin.php" method="post" name="form" enctype="multipart/form-data">
                                            <input type="hidden" name="act" value="updateNews" />
                                            <input type="hidden" name="id" value="<?php echo $News["id"]; ?>" />
                                            <div class="pageDescr">To edit news change details below and click on 'Update News' button.</div>
                                            <table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
                                                <tr>
                                                    <td colspan="2" valign="top" class="headlist">Edit News</td>
                                                </tr>
                                                <tr>
                                                    <td class="formLeft">Status:</td>
                                                    <td>
                                                        <select name="status">
                                                            <option value="Published"<?php if ($News["status"] == 'Published') echo ' selected="selected"'; ?>>Published</option>
                                                            <option value="Hidden"<?php if ($News["status"] == 'Hidden') echo ' selected="selected"'; ?>>Hidden</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="formLeft">Title:</td>
                                                    <td><input type="text" name="title" size="100" maxlength="250" value="<?php echo ReadHTML($News["title"]); ?>" /></td>
                                                </tr>

                                                <tr>
                                                    <td class="formLeft" valign="top">Summary:</td>
                                                    <td><textarea name="summary" cols="80" rows="4"><?php echo ReadHTML($News["summary"]); ?></textarea></td>
                                                </tr>

                                                <tr>
                                                    <td class="formLeft">Summary Photo:</td>
                                                    <td>
        <?php if (stripslashes($News["thumb"]) != "") { ?>
                                                            <img src="<?php echo $CONFIG["upload_folder"] . ReadDB($News["thumb"]); ?>" border="0" width="100" /> 			&nbsp;&nbsp;<a href="<?php $_SERVER["PHP_SELF"]; ?>?act=delThumb&id=<?php echo $News["id"]; ?>">delete</a><br /> 
                                                            If you upload new summary photo the old one will be deleted <br />
        <?php } ?>
                                                        <input type="file" name="thumb" size="70" />
                                                    </td>
                                                </tr> 
                                                <script src="nicEdit/nicEdit.js" type="text/javascript"></script>
                                                <script type="text/javascript">
                                                    bkLib.onDomLoaded(function() {
                                                        new nicEditor({iconsPath: 'nicEdit/nicEditorIcons.gif'}).panelInstance('content');
                                                    });
                                                </script>
                                                <tr>
                                                    <td class="formLeft" valign="top">Content:</td>
                                                    <td><textarea name="content" id="content" cols="80" rows="12"><?php echo ReadHTML($News["content"]); ?></textarea></td>
                                                </tr>

                                                <tr>
                                                    <td class="formLeft">Photo:</td>
                                                    <td>
        <?php if (stripslashes($News["image"]) != "") { ?>
                                                            <img src="<?php echo $CONFIG["upload_folder"] . ReadDB($News["image"]); ?>" border="0" width="160" /> 			&nbsp;&nbsp;<a href="<?php $_SERVER["PHP_SELF"]; ?>?act=delImage&id=<?php echo $News["id"]; ?>">delete</a><br /> 
                                                            If you upload new image the old one will be deleted <br />
        <?php } ?>
                                                        <input type="file" name="image" size="70" />
                                                    </td>
                                                </tr> 
                                                <tr>
                                                    <td class="formLeft">Photo Caption:</td>
                                                    <td><input type="text" name="caption" size="50" maxlength="100" value="<?php echo ReadHTML($News["caption"]); ?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLeft">Image location in the text:</td>
                                                    <td>
                                                        <select name="imgpos">
                                                            <option value="left"<?php if ($News["imgpos"] == 'left') echo ' selected="selected"' ?>>left</option>
                                                            <option value="right"<?php if ($News["imgpos"] == 'right') echo ' selected="selected"' ?>>right</option>
                                                            <option value="top"<?php if ($News["imgpos"] == 'top') echo ' selected="selected"' ?>>top</option>
                                                            <option value="bottom"<?php if ($News["imgpos"] == 'bottom') echo ' selected="selected"' ?>>bottom</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="formLeft">Image width:</td>
                                                    <td>
                                                        <select name="imgwidth">
                                                            <option value="320px"<?php if ($News["imgwidth"] == '320px') echo ' selected="selected"' ?>>320px</option>
                                                            <option value="300px"<?php if ($News["imgwidth"] == '300px') echo ' selected="selected"' ?>>300px</option>
                                                            <option value="280px"<?php if ($News["imgwidth"] == '280px') echo ' selected="selected"' ?>>280px</option>
                                                            <option value="260px"<?php if ($News["imgwidth"] == '260px') echo ' selected="selected"' ?>>260px</option>
                                                            <option value="240px"<?php if ($News["imgwidth"] == '240px') echo ' selected="selected"' ?>>240px</option>
                                                            <option value="220px"<?php if ($News["imgwidth"] == '220px') echo ' selected="selected"' ?>>220px</option>
                                                            <option value="200px"<?php if ($News["imgwidth"] == '200px') echo ' selected="selected"' ?>>200px</option>
                                                            <option value="180px"<?php if ($News["imgwidth"] == '180px') echo ' selected="selected"' ?>>180px</option>
                                                            <option value="160px"<?php if ($News["imgwidth"] == '160px') echo ' selected="selected"' ?>>160px</option>
                                                            <option value="140px"<?php if ($News["imgwidth"] == '140px') echo ' selected="selected"' ?>>140px</option>
                                                            <option value="120px"<?php if ($News["imgwidth"] == '120px') echo ' selected="selected"' ?>>120px</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="formLeft">Publish date:</td>
                                                    <td>
                                                        <input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo $News["publish_date"]; ?>" readonly="readonly" /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" ></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input name="submit" type="submit" value="Update News" class="submitButton" /> &nbsp; &nbsp; &nbsp; &nbsp; 
                                                        <input name="updatepreview" type="submit" value="Update and Preview" class="submitButton" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>


                                        <?php
                                    } elseif ($_REQUEST["act"] == 'viewNews') {

                                        $sql = "SELECT * FROM " . $TABLE["Options"];
                                        $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                        $Options = mysql_fetch_assoc($sql_result);
                                        $OptionsVis = unserialize($Options['visual']);
                                        $OptionsLang = unserialize($Options['language']);

                                        $sql = "SELECT * FROM " . $TABLE["News"] . " WHERE id='" . $_REQUEST["id"] . "'";
                                        $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
                                        $News = mysql_fetch_assoc($sql_result);
                                        ?>
                                        <div style="clear:both;padding-left:40px;padding-top:10px;padding-bottom:10px;"><a href="admin.php?act=editNews&id=<?php echo ReadDB($News['id']); ?>">Edit Article</a></div>

                                        <div style="font-family:<?php echo $OptionsVis["gen_font_family"]; ?>; font-size:<?php echo $OptionsVis["gen_font_size"]; ?>;margin:0 auto;width:<?php echo $OptionsVis["gen_width"]; ?>px; color:<?php echo $OptionsVis["gen_font_color"]; ?>;">


        <?php if ($OptionsLang["Back_to_home"] != '') { ?>
                                                <div style="text-align:<?php echo $OptionsVis["link_align"]; ?>">
                                                    <a href="admin.php?act=news" style='font-weight:<?php echo $OptionsVis["link_font_weight"]; ?>;color:<?php echo $OptionsVis["link_color"]; ?>;font-size:<?php echo $OptionsVis["link_font_size"]; ?>;text-decoration:underline'><?php echo $OptionsLang["Back_to_home"]; ?></a>
                                                </div>    
                                                <div style="clear:both; height:<?php echo $OptionsVis["dist_link_title"]; ?>;"></div>    
                                                <?php } ?>

                                            <div style="color:<?php echo $OptionsVis["title_color"]; ?>;font-family:<?php echo $OptionsVis["title_font"]; ?>;font-size:<?php echo $OptionsVis["title_size"]; ?>;font-weight:<?php echo $OptionsVis["title_font_weight"]; ?>;font-style:<?php echo $OptionsVis["title_font_style"]; ?>;text-align:<?php echo $OptionsVis["title_text_align"]; ?>;">	  
        <?php echo ReadHTML($News["title"]); ?>     
                                            </div>

                                            <div style="clear:both; height:<?php echo $OptionsVis["dist_title_date"]; ?>;"></div>

                                            <div style="color:<?php echo $OptionsVis["date_color"]; ?>; font-family:<?php echo $OptionsVis["date_font"]; ?>; font-size:<?php echo $OptionsVis["date_size"]; ?>;font-style: <?php echo $OptionsVis["date_font_style"]; ?>;text-align:<?php echo $OptionsVis["date_text_align"]; ?>;">
        <?php echo lang_date(date($OptionsVis["date_format"], strtotime($News["publish_date"]))); ?> 
        <?php if ($OptionsVis["showing_time"] != '') echo date($OptionsVis["showing_time"], strtotime($News["publish_date"])); ?>
                                            </div>

                                            <div style="clear:both; height:<?php echo $OptionsVis["dist_date_text"]; ?>;"></div>

                                            <div style="color:<?php echo $OptionsVis["summ_color"]; ?>; font-family:<?php echo $OptionsVis["summ_font"]; ?>; font-size:<?php echo $OptionsVis["summ_size"]; ?>;font-style: <?php echo $OptionsVis["summ_font_style"]; ?>;text-align:<?php echo $OptionsVis["summ_text_align"]; ?>;line-height:<?php echo $OptionsVis["summ_line_height"]; ?>;">
        <?php if (ReadDB($News["image"]) != '') { ?>

            <?php if (ReadDB($News["imgpos"]) == 'left') { ?>
                                                        <div style="float:left">
                                                            <img src="<?php echo $CONFIG["full_url"] . $CONFIG["upload_folder"] . ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-right:14px; padding-bottom:3px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" />
                                                            <div style="color:<?php echo $OptionsVis["capt_color"]; ?>;font-family:<?php echo $OptionsVis["capt_font"]; ?>;font-size:<?php echo $OptionsVis["capt_size"]; ?>;font-weight:<?php echo $OptionsVis["capt_font_weight"]; ?>;font-style:<?php echo $OptionsVis["capt_font_style"]; ?>;text-align:<?php echo $OptionsVis["title_text_align"]; ?>;padding-bottom:3px;padding-right:14px;"><?php echo ReadDB($News["caption"]); ?></div>
                                                        </div>
            <?php } ?>

            <?php if (ReadDB($News["imgpos"]) == 'right') { ?>
                                                        <div style="float:right">
                                                            <img src="<?php echo $CONFIG["full_url"] . $CONFIG["upload_folder"] . ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-left:14px; padding-bottom:3px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" />
                                                            <div style="color:<?php echo $OptionsVis["capt_color"]; ?>;font-family:<?php echo $OptionsVis["capt_font"]; ?>;font-size:<?php echo $OptionsVis["capt_size"]; ?>;font-weight:<?php echo $OptionsVis["capt_font_weight"]; ?>;font-style:<?php echo $OptionsVis["capt_font_style"]; ?>;text-align:<?php echo $OptionsVis["title_text_align"]; ?>;padding-bottom:3px;padding-left:14px;"><?php echo ReadDB($News["caption"]); ?></div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if (ReadDB($News["imgpos"]) == 'top') { ?>
                                                        <div style="clear:both; text-align:center">
                                                            <img src="<?php echo $CONFIG["full_url"] . $CONFIG["upload_folder"] . ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:3px;" width="<?php echo $News["imgwidth"]; ?>" />
                                                            <div style="color:<?php echo $OptionsVis["capt_color"]; ?>;font-family:<?php echo $OptionsVis["capt_font"]; ?>;font-size:<?php echo $OptionsVis["capt_size"]; ?>;font-weight:<?php echo $OptionsVis["capt_font_weight"]; ?>;font-style:<?php echo $OptionsVis["capt_font_style"]; ?>;text-align:<?php echo $OptionsVis["title_text_align"]; ?>;padding-bottom:3px;"><?php echo ReadDB($News["caption"]); ?></div>
                                                        </div>
                                                    <?php } ?>

        <?php } ?>
        <?php echo ReadDB($News["content"]); ?> 
        <?php if (ReadDB($News["image"]) != '') { ?>
            <?php if (ReadDB($News["imgpos"]) == 'bottom') { ?>
                                                        <div style="clear:both; text-align:center">
                                                            <img src="<?php echo $CONFIG["full_url"] . $CONFIG["upload_folder"] . ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:3px;padding-top:10px;" width="<?php echo $News["imgwidth"]; ?>" />
                                                            <div style="color:<?php echo $OptionsVis["capt_color"]; ?>;font-family:<?php echo $OptionsVis["capt_font"]; ?>;font-size:<?php echo $OptionsVis["capt_size"]; ?>;font-weight:<?php echo $OptionsVis["capt_font_weight"]; ?>;font-style:<?php echo $OptionsVis["capt_font_style"]; ?>;text-align:<?php echo $OptionsVis["title_text_align"]; ?>;padding-bottom:7px;"><?php echo ReadDB($News["caption"]); ?></div>
                                                        </div>
                                            <?php } ?>
                                        <?php } ?>
                                            </div>

                                            <div style="clear:both; height: 12px;"></div>
                                        </div>

        <?php
    } elseif ($_REQUEST["act"] == 'news_options') {
        $sql = "SELECT * FROM " . $TABLE["Options"];
        $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
        $Options = mysql_fetch_assoc($sql_result);
        ?>

                                        <div class="paddingtop"></div>

                                        <form action="admin.php" method="post" name="form">
                                            <input type="hidden" name="act" value="updateOptionsNews" />
                                            <table border="0" cellspacing="0" cellpadding="8" class="allTables">
                                                <tr>
                                                    <td colspan="3" class="headlist">News options</td>
                                                </tr>

                                                <tr>
                                                    <td valign="left" width="33%">Number of news per page: </td>
                                                    <td valign="left"><input name="per_page" type="text" size="3" value="<?php echo ReadDB($Options["per_page"]); ?>" /></td>
                                                </tr>

                                                <tr>
                                                    <td valign="left">Show news:<br />
                                                        <span style="font-size:11px">Choose how to display in the news listing</span></td>
                                                    <td valign="left">
                                                        <select name="shownews"> 
                                                            <option value="OnlyTitles"<?php if ($Options["shownews"] == 'OnlyTitles') echo ' selected="selected"'; ?>>Only Titles</option>       
                                                            <option value="TitleAndSummary"<?php if ($Options["shownews"] == 'TitleAndSummary') echo ' selected="selected"'; ?>>Title and Summary</option>
                                                            <option value="FullNews"<?php if ($Options["shownews"] == 'FullNews') echo ' selected="selected"'; ?>>Full News</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="left">Show search box:<br />
                                                        <span style="font-size:11px">Choose how to display in the news listing</span></td>
                                                    <td valign="left">
                                                        <select name="showsearch"> 
                                                            <option value="yes"<?php if ($Options["showsearch"] == 'yes') echo ' selected="selected"'; ?>>yes</option>       
                                                            <option value="no"<?php if ($Options["showsearch"] == 'no') echo ' selected="selected"'; ?>>no</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="left" width="33%">URL of the page where you placed the news: </td>
                                                    <td valign="left">
                                                        <input name="news_link" type="text" size="60" value="<?php echo ReadDB($Options["news_link"]); ?>" />
                                                        <div style="padding-top:6px;font-size:11px;">for example http://www.yourwebsite.com/newspage.php</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
                                                </tr>
                                            </table>    
                                        </form>


        <?php
    } elseif ($_REQUEST["act"] == 'visual_options') {
        $sql = "SELECT * FROM " . $TABLE["Options"];
        $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
        $Options = mysql_fetch_assoc($sql_result);
        $OptionsVis = unserialize($Options['visual']);
        ?>

                                        <div class="paddingtop"></div>

                                        <form action="admin.php" method="post" name="form">
                                            <input type="hidden" name="act" value="updateOptionsVisual" />

                                            <table border="0" cellspacing="0" cellpadding="8" class="allTables">
                                                <tr>
                                                    <td colspan="3" class="headlist">Set news front-end visual style.</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="3" class="subinfo" style="font-family: "Times New Roman", Times, serif">General style: </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">General font-family:</td>
                                                    <td valign="top">
                                                        <select name="gen_font_family">
                                                            <option value="Arial"<?php if ($OptionsVis['gen_font_family'] == 'Arial') echo ' selected="selected"'; ?>>Arial</option>
                                                            <option value="Courier New"<?php if ($OptionsVis['gen_font_family'] == 'Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                                                            <option value="Georgia"<?php if ($OptionsVis['gen_font_family'] == 'Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                                                            <option value="Times New Roman"<?php if ($OptionsVis['gen_font_family'] == 'Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                                                            <option value="Trebuchet MS"<?php if ($OptionsVis['gen_font_family'] == 'Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                                                            <option value="Verdana"<?php if ($OptionsVis['gen_font_family'] == 'Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                                                            <option value="inherit"<?php if ($OptionsVis['gen_font_family'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">General font-size:</td>
                                                    <td valign="top">
                                                        <select name="gen_font_size">
                                                            <option value="inherit"<?php if ($OptionsVis['gen_font_size'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                            <option value="10px"<?php if ($OptionsVis['gen_font_size'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['gen_font_size'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['gen_font_size'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['gen_font_size'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['gen_font_size'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['gen_font_size'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                        </select>
                                                    </td>
                                                </tr> 

                                                <tr>
                                                    <td class="langLeft">General font-color:</td>
                                                    <td valign="top"><input name="gen_font_color" type="text" size="7" value="<?php echo $OptionsVis["gen_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["gen_font_color"]); ?>;background-color:<?php echo $OptionsVis["gen_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.gen_font_color, 'pickcolor');
                                                            return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">General background-color:</td>
                                                    <td valign="top"><input name="gen_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["gen_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["gen_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["gen_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.gen_bgr_color, 'pickcolor');
                                                            return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
                                                </tr>          
                                                <tr>
                                                    <td class="langLeft">General news width:</td>
                                                    <td valign="top"><input name="gen_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["gen_width"]); ?>" />px</td>
                                                </tr>  
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
                                                </tr> 

                                                <tr>
                                                    <td colspan="3" class="subinfo">News title style: </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Title color:</td>
                                                    <td valign="top"><input name="title_color" type="text" size="7" value="<?php echo $OptionsVis["title_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["title_color"]); ?>;background-color:<?php echo $OptionsVis["title_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.title_color, 'pickcolor');
                                                            return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Title font-family:</td>
                                                    <td valign="top">
                                                        <select name="title_font">
                                                            <option value="Arial"<?php if ($OptionsVis['title_font'] == 'Arial') echo ' selected="selected"'; ?>>Arial</option>
                                                            <option value="Courier New"<?php if ($OptionsVis['title_font'] == 'Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                                                            <option value="Georgia"<?php if ($OptionsVis['title_font'] == 'Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                                                            <option value="Times New Roman"<?php if ($OptionsVis['title_font'] == 'Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                                                            <option value="Trebuchet MS"<?php if ($OptionsVis['title_font'] == 'Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                                                            <option value="Verdana"<?php if ($OptionsVis['title_font'] == 'Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                                                            <option value="inherit"<?php if ($OptionsVis['title_font'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Title font-size:</td>
                                                    <td valign="top">
                                                        <select name="title_size">
                                                            <option value="inherit"<?php if ($OptionsVis['title_size'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                            <option value="10px"<?php if ($OptionsVis['title_size'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['title_size'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['title_size'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['title_size'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['title_size'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['title_size'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                            <option value="20px"<?php if ($OptionsVis['title_size'] == '20px') echo ' selected="selected"'; ?>>20px</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Title font-weight:</td>
                                                    <td valign="top">
                                                        <select name="title_font_weight">
                                                            <option value="normal"<?php if ($OptionsVis['title_font_weight'] == 'normal') echo ' selected="selected"'; ?>>normal</option>
                                                            <option value="bold"<?php if ($OptionsVis['title_font_weight'] == 'bold') echo ' selected="selected"'; ?>>bold</option>
                                                            <option value="inherit"<?php if ($OptionsVis['title_font_weight'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Title font-style:</td>
                                                    <td valign="top">
                                                        <select name="title_font_style">
                                                            <option value="normal"<?php if ($OptionsVis['title_font_style'] == 'normal') echo ' selected="selected"'; ?>>normal</option>
                                                            <option value="italic"<?php if ($OptionsVis['title_font_style'] == 'italic') echo ' selected="selected"'; ?>>italic</option>
                                                            <option value="oblique"<?php if ($OptionsVis['title_font_style'] == 'oblique') echo ' selected="selected"'; ?>>oblique</option>
                                                            <option value="inherit"<?php if ($OptionsVis['title_font_style'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Title text-align:</td>
                                                    <td valign="top">
                                                        <select name="title_text_align">
                                                            <option value="center"<?php if ($OptionsVis['title_text_align'] == 'center') echo ' selected="selected"'; ?>>center</option>
                                                            <option value="justify"<?php if ($OptionsVis['title_text_align'] == 'justify') echo ' selected="selected"'; ?>>justify</option>
                                                            <option value="left"<?php if ($OptionsVis['title_text_align'] == 'left') echo ' selected="selected"'; ?>>left</option>right
                                                            <option value="right"<?php if ($OptionsVis['title_text_align'] == 'right') echo ' selected="selected"'; ?>>right</option>
                                                            <option value="inherit"<?php if ($OptionsVis['title_text_align'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
                                                </tr> 

                                                <tr>
                                                    <td colspan="3" class="subinfo">News date style: </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Date color:</td>
                                                    <td valign="top"><input name="date_color" type="text" size="7" value="<?php echo $OptionsVis["date_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["date_color"]); ?>;background-color:<?php echo $OptionsVis["date_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.date_color, 'pickcolor');
                                                            return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Date font-family:</td>
                                                    <td valign="top">
                                                        <select name="date_font">
                                                            <option value="Arial"<?php if ($OptionsVis['date_font'] == 'Arial') echo ' selected="selected"'; ?>>Arial</option>
                                                            <option value="Courier New"<?php if ($OptionsVis['date_font'] == 'Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                                                            <option value="Georgia"<?php if ($OptionsVis['date_font'] == 'Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                                                            <option value="Times New Roman"<?php if ($OptionsVis['date_font'] == 'Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                                                            <option value="Trebuchet MS"<?php if ($OptionsVis['date_font'] == 'Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                                                            <option value="Verdana"<?php if ($OptionsVis['date_font'] == 'Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                                                            <option value="inherit"<?php if ($OptionsVis['date_font'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Date font-size:</td>
                                                    <td valign="top">
                                                        <select name="date_size">
                                                            <option value="inherit"<?php if ($OptionsVis['date_size'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                            <option value="9px"<?php if ($OptionsVis['date_size'] == '9px') echo ' selected="selected"'; ?>>9px</option>
                                                            <option value="10px"<?php if ($OptionsVis['date_size'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['date_size'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['date_size'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['date_size'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['date_size'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['date_size'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                            <option value="20px"<?php if ($OptionsVis['date_size'] == '20px') echo ' selected="selected"'; ?>>20px</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Date font-style:</td>
                                                    <td valign="top">
                                                        <select name="date_font_style">
                                                            <option value="normal"<?php if ($OptionsVis['date_font_style'] == 'normal') echo ' selected="selected"'; ?>>normal</option>
                                                            <option value="italic"<?php if ($OptionsVis['date_font_style'] == 'italic') echo ' selected="selected"'; ?>>italic</option>
                                                            <option value="oblique"<?php if ($OptionsVis['date_font_style'] == 'oblique') echo ' selected="selected"'; ?>>oblique</option>
                                                            <option value="inherit"<?php if ($OptionsVis['date_font_style'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Date text-align:</td>
                                                    <td valign="top">
                                                        <select name="date_text_align">
                                                            <option value="center"<?php if ($OptionsVis['date_text_align'] == 'center') echo ' selected="selected"'; ?>>center</option>
                                                            <option value="justify"<?php if ($OptionsVis['date_text_align'] == 'justify') echo ' selected="selected"'; ?>>justify</option>
                                                            <option value="left"<?php if ($OptionsVis['date_text_align'] == 'left') echo ' selected="selected"'; ?>>left</option>
                                                            <option value="right"<?php if ($OptionsVis['date_text_align'] == 'right') echo ' selected="selected"'; ?>>right</option>
                                                            <option value="inherit"<?php if ($OptionsVis['date_text_align'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Date format:</td>
                                                    <td valign="top">
                                                        <select name="date_format">
                                                            <option value="l - F j, Y"<?php if ($OptionsVis['date_format'] == 'l - F j, Y') echo ' selected="selected"'; ?>>Monday - January 18, 2010</option>
                                                            <option value="l - F j Y"<?php if ($OptionsVis['date_format'] == 'l - F j Y') echo ' selected="selected"'; ?>>Monday - January 18 2010</option>
                                                            <option value="l, F j Y"<?php if ($OptionsVis['date_format'] == 'l, F j Y') echo ' selected="selected"'; ?>>Monday, January 18 2010</option>
                                                            <option value="l, F j, Y"<?php if ($OptionsVis['date_format'] == 'l, F j, Y') echo ' selected="selected"'; ?>>Monday, January 18, 2010</option>
                                                            <option value="l F j Y"<?php if ($OptionsVis['date_format'] == 'l F j Y') echo ' selected="selected"'; ?>>Monday January 18 2010</option>
                                                            <option value="l F j, Y"<?php if ($OptionsVis['date_format'] == 'l F j Y') echo ' selected="selected"'; ?>>Monday January 18, 2010</option>
                                                            <option value="F j Y"<?php if ($OptionsVis['date_format'] == 'F j Y') echo ' selected="selected"'; ?>>January 18 2010</option>
                                                            <option value="F j, Y"<?php if ($OptionsVis['date_format'] == 'F j, Y') echo ' selected="selected"'; ?>>January 18, 2010</option>
                                                            <option value="F Y"<?php if ($OptionsVis['date_format'] == 'F Y') echo ' selected="selected"'; ?>>January 2010</option>
                                                            <option value="m-d-Y"<?php if ($OptionsVis['date_format'] == 'm-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                                                            <option value="m.d.Y"<?php if ($OptionsVis['date_format'] == 'm.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                                                            <option value="m/d/Y"<?php if ($OptionsVis['date_format'] == 'm/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                                                            <option value="m-d-y"<?php if ($OptionsVis['date_format'] == 'm-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                                                            <option value="m.d.y"<?php if ($OptionsVis['date_format'] == 'm.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                                                            <option value="m/d/y"<?php if ($OptionsVis['date_format'] == 'm/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                                                            <option value="l - j F, Y"<?php if ($OptionsVis['date_format'] == 'l - j F, Y') echo ' selected="selected"'; ?>>Monday - 18 January, 2010</option>
                                                            <option value="l - j F Y"<?php if ($OptionsVis['date_format'] == 'l - j F Y') echo ' selected="selected"'; ?>>Monday - 18 January 2010</option>
                                                            <option value="l, j F Y"<?php if ($OptionsVis['date_format'] == 'l, j F Y') echo ' selected="selected"'; ?>>Monday, 18 January 2010</option>
                                                            <option value="l, j F, Y"<?php if ($OptionsVis['date_format'] == 'l, j F, Y') echo ' selected="selected"'; ?>>Monday, 18 January, 2010</option>
                                                            <option value="l j F Y"<?php if ($OptionsVis['date_format'] == 'l j F Y') echo ' selected="selected"'; ?>>Monday 18 January 2010</option>
                                                            <option value="l j F, Y"<?php if ($OptionsVis['date_format'] == 'l j F, Y') echo ' selected="selected"'; ?>>Monday 18 January, 2010</option>
                                                            <option value="d F Y"<?php if ($OptionsVis['date_format'] == 'd F Y') echo ' selected="selected"'; ?>>18 January 2010</option>
                                                            <option value="d F, Y"<?php if ($OptionsVis['date_format'] == 'd F, Y') echo ' selected="selected"'; ?>>18 January, 2010</option>
                                                            <option value="d-m-Y"<?php if ($OptionsVis['date_format'] == 'd-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                                                            <option value="d.m.Y"<?php if ($OptionsVis['date_format'] == 'd.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                                                            <option value="d/m/Y"<?php if ($OptionsVis['date_format'] == 'd/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                                                            <option value="d-m-y"<?php if ($OptionsVis['date_format'] == 'd-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                                                            <option value="d.m.y"<?php if ($OptionsVis['date_format'] == 'd.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                                                            <option value="d/m/y"<?php if ($OptionsVis['date_format'] == 'd/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="langLeft">Showing the time:</td>
                                                    <td valign="top">
                                                        <select name="showing_time">
                                                            <option value=""<?php if ($OptionsVis['showing_time'] == '') echo ' selected="selected"'; ?>>without time</option>
                                                            <option value="G:i"<?php if ($OptionsVis['showing_time'] == 'G:i') echo ' selected="selected"'; ?>>24h format</option>
                                                            <option value="g:i a"<?php if ($OptionsVis['showing_time'] == 'g:i a') echo ' selected="selected"'; ?>>12h format</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="langLeft">Time offset of the webserver:</td>
                                                    <td valign="top">
                                                        <select name="time_offset">
                                                            <option value="-11 hours"<?php if ($OptionsVis['time_offset'] == '-11 hours') echo ' selected="selected"'; ?>>-11 hours</option>
                                                            <option value="-10 hours"<?php if ($OptionsVis['time_offset'] == '-10') echo ' selected="selected"'; ?>>-10 hours</option>
                                                            <option value="-9 hours"<?php if ($OptionsVis['time_offset'] == '-9 hours') echo ' selected="selected"'; ?>>-9 hours</option>
                                                            <option value="-8 hours"<?php if ($OptionsVis['time_offset'] == '-8 hours') echo ' selected="selected"'; ?>>-8 hours</option>
                                                            <option value="-7 hours"<?php if ($OptionsVis['time_offset'] == '-7 hours') echo ' selected="selected"'; ?>>-7 hours</option>
                                                            <option value="-6 hours"<?php if ($OptionsVis['time_offset'] == '-6 hours') echo ' selected="selected"'; ?>>-6 hours</option>
                                                            <option value="-5 hours"<?php if ($OptionsVis['time_offset'] == '-5 hours') echo ' selected="selected"'; ?>>-5 hours</option>
                                                            <option value="-4 hours"<?php if ($OptionsVis['time_offset'] == '-4 hours') echo ' selected="selected"'; ?>>-4 hours</option>
                                                            <option value="-3 hours"<?php if ($OptionsVis['time_offset'] == '-3 hours') echo ' selected="selected"'; ?>>-3 hours</option>
                                                            <option value="-2 hours"<?php if ($OptionsVis['time_offset'] == '-2 hours') echo ' selected="selected"'; ?>>-2 hours</option>
                                                            <option value="-1 hour"<?php if ($OptionsVis['time_offset'] == '-1 hour') echo ' selected="selected"'; ?>>-1 hour</option>
                                                            <option value="0 hour"<?php if ($OptionsVis['time_offset'] == '0 hour') echo ' selected="selected"'; ?>>no offset</option>
                                                            <option value="+1 hour"<?php if ($OptionsVis['time_offset'] == '+1 hour') echo ' selected="selected"'; ?>>+1 hour</option>
                                                            <option value="+2 hours"<?php if ($OptionsVis['time_offset'] == '+2 hours') echo ' selected="selected"'; ?>>+2 hours</option>
                                                            <option value="+3 hours"<?php if ($OptionsVis['time_offset'] == '+3 hours') echo ' selected="selected"'; ?>>+3 hours</option>
                                                            <option value="+4 hours"<?php if ($OptionsVis['time_offset'] == '+4 hours') echo ' selected="selected"'; ?>>+4 hours</option>
                                                            <option value="+5 hours"<?php if ($OptionsVis['time_offset'] == '+5 hours') echo ' selected="selected"'; ?>>+5 hours</option>
                                                            <option value="+6 hours"<?php if ($OptionsVis['time_offset'] == '+6 hours') echo ' selected="selected"'; ?>>+6 hours</option>
                                                            <option value="+7 hours"<?php if ($OptionsVis['time_offset'] == '+7 hours') echo ' selected="selected"'; ?>>+7 hours</option>
                                                            <option value="+8 hours"<?php if ($OptionsVis['time_offset'] == '+8 hours') echo ' selected="selected"'; ?>>+8 hours</option>
                                                            <option value="+9 hours"<?php if ($OptionsVis['time_offset'] == '+9 hours') echo ' selected="selected"'; ?>>+9 hours</option>
                                                            <option value="+10 hours"<?php if ($OptionsVis['time_offset'] == '+10 hours') echo ' selected="selected"'; ?>>+10 hours</option>
                                                            <option value="+11 hours"<?php if ($OptionsVis['time_offset'] == '+11 hours') echo ' selected="selected"'; ?>>+11 hours</option>
                                                        </select>
                                                    </td>
                                                </tr>     

                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
                                                </tr> 

                                                <tr>
                                                    <td colspan="3" class="subinfo">News summary and content style: </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Summary and content color:</td>
                                                    <td valign="top"><input name="summ_color" type="text" size="7" value="<?php echo $OptionsVis["summ_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["summ_color"]); ?>;background-color:<?php echo $OptionsVis["summ_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.summ_color, 'pickcolor');
                                                            return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Summary and content font-family:</td>
                                                    <td valign="top">
                                                        <select name="summ_font">
                                                            <option value="Arial"<?php if ($OptionsVis['summ_font'] == 'Arial') echo ' selected="selected"'; ?>>Arial</option>
                                                            <option value="Courier New"<?php if ($OptionsVis['summ_font'] == 'Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                                                            <option value="Georgia"<?php if ($OptionsVis['summ_font'] == 'Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                                                            <option value="Times New Roman"<?php if ($OptionsVis['summ_font'] == 'Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                                                            <option value="Trebuchet MS"<?php if ($OptionsVis['summ_font'] == 'Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                                                            <option value="Verdana"<?php if ($OptionsVis['summ_font'] == 'Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                                                            <option value="inherit"<?php if ($OptionsVis['summ_font'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Summary and content font-size:</td>
                                                    <td valign="top">
                                                        <select name="summ_size">
                                                            <option value="inherit"<?php if ($OptionsVis['summ_size'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                            <option value="9px"<?php if ($OptionsVis['summ_size'] == '9px') echo ' selected="selected"'; ?>>9px</option>
                                                            <option value="10px"<?php if ($OptionsVis['summ_size'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['summ_size'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['summ_size'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['summ_size'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['summ_size'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['summ_size'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                            <option value="20px"<?php if ($OptionsVis['summ_size'] == '20px') echo ' selected="selected"'; ?>>20px</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Summary and content font-style:</td>
                                                    <td valign="top">
                                                        <select name="summ_font_style">
                                                            <option value="normal"<?php if ($OptionsVis['summ_font_style'] == 'normal') echo ' selected="selected"'; ?>>normal</option>
                                                            <option value="italic"<?php if ($OptionsVis['summ_font_style'] == 'italic') echo ' selected="selected"'; ?>>italic</option>
                                                            <option value="oblique"<?php if ($OptionsVis['summ_font_style'] == 'oblique') echo ' selected="selected"'; ?>>oblique</option>
                                                            <option value="inherit"<?php if ($OptionsVis['summ_font_style'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Summary and content text-align:</td>
                                                    <td valign="top">
                                                        <select name="summ_text_align">
                                                            <option value="center"<?php if ($OptionsVis['summ_text_align'] == 'center') echo ' selected="selected"'; ?>>center</option>
                                                            <option value="justify"<?php if ($OptionsVis['summ_text_align'] == 'justify') echo ' selected="selected"'; ?>>justify</option>
                                                            <option value="left"<?php if ($OptionsVis['summ_text_align'] == 'left') echo ' selected="selected"'; ?>>left</option>
                                                            <option value="right"<?php if ($OptionsVis['summ_text_align'] == 'right') echo ' selected="selected"'; ?>>right</option>
                                                            <option value="inherit"<?php if ($OptionsVis['summ_text_align'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Summary and content line-height:</td>
                                                    <td valign="top">
                                                        <select name="summ_line_height">
                                                            <option value="inherit"<?php if ($OptionsVis['summ_line_height'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                            <option value="12px"<?php if ($OptionsVis['summ_line_height'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['summ_line_height'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['summ_line_height'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['summ_line_height'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                            <option value="20px"<?php if ($OptionsVis['summ_line_height'] == '20px') echo ' selected="selected"'; ?>>20px</option>
                                                            <option value="22px"<?php if ($OptionsVis['summ_line_height'] == '22px') echo ' selected="selected"'; ?>>22px</option>
                                                        </select>
                                                    </td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">Summary image width:</td>
                                                    <td valign="top"><input name="summ_img_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["summ_img_width"]); ?>" />px</td>
                                                </tr>    
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
                                                </tr>


                                                <tr>
                                                    <td colspan="3" class="subinfo">News image caption style: </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Caption color:</td>
                                                    <td valign="top"><input name="capt_color" type="text" size="7" value="<?php echo $OptionsVis["capt_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["capt_color"]); ?>;background-color:<?php echo $OptionsVis["capt_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.capt_color, 'pickcolor');
                                                            return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Caption font-family:</td>
                                                    <td valign="top">
                                                        <select name="capt_font">
                                                            <option value="Arial"<?php if ($OptionsVis['capt_font'] == 'Arial') echo ' selected="selected"'; ?>>Arial</option>
                                                            <option value="Courier New"<?php if ($OptionsVis['capt_font'] == 'Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                                                            <option value="Georgia"<?php if ($OptionsVis['capt_font'] == 'Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                                                            <option value="Times New Roman"<?php if ($OptionsVis['capt_font'] == 'Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                                                            <option value="Trebuchet MS"<?php if ($OptionsVis['capt_font'] == 'Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                                                            <option value="Verdana"<?php if ($OptionsVis['capt_font'] == 'Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                                                            <option value="inherit"<?php if ($OptionsVis['capt_font'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Caption font-size:</td>
                                                    <td valign="top">
                                                        <select name="capt_size">
                                                            <option value="inherit"<?php if ($OptionsVis['capt_size'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                            <option value="9px"<?php if ($OptionsVis['capt_size'] == '9px') echo ' selected="selected"'; ?>>9px</option>
                                                            <option value="10px"<?php if ($OptionsVis['capt_size'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['capt_size'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['capt_size'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['capt_size'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['capt_size'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['capt_size'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                            <option value="20px"<?php if ($OptionsVis['capt_size'] == '20px') echo ' selected="selected"'; ?>>20px</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Caption font-weight:</td>
                                                    <td valign="top">
                                                        <select name="capt_font_weight">
                                                            <option value="normal"<?php if ($OptionsVis['capt_font_weight'] == 'normal') echo ' selected="selected"'; ?>>normal</option>
                                                            <option value="bold"<?php if ($OptionsVis['capt_font_weight'] == 'bold') echo ' selected="selected"'; ?>>bold</option>
                                                            <option value="inherit"<?php if ($OptionsVis['capt_font_weight'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Caption font-style:</td>
                                                    <td valign="top">
                                                        <select name="capt_font_style">
                                                            <option value="normal"<?php if ($OptionsVis['capt_font_style'] == 'normal') echo ' selected="selected"'; ?>>normal</option>
                                                            <option value="italic"<?php if ($OptionsVis['capt_font_style'] == 'italic') echo ' selected="selected"'; ?>>italic</option>
                                                            <option value="oblique"<?php if ($OptionsVis['capt_font_style'] == 'oblique') echo ' selected="selected"'; ?>>oblique</option>
                                                            <option value="inherit"<?php if ($OptionsVis['capt_font_style'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="langLeft">Caption text-align:</td>
                                                    <td valign="top">
                                                        <select name="capt_text_align">
                                                            <option value="center"<?php if ($OptionsVis['capt_text_align'] == 'center') echo ' selected="selected"'; ?>>center</option>
                                                            <option value="justify"<?php if ($OptionsVis['capt_text_align'] == 'justify') echo ' selected="selected"'; ?>>justify</option>
                                                            <option value="left"<?php if ($OptionsVis['capt_text_align'] == 'left') echo ' selected="selected"'; ?>>left</option>right
                                                            <option value="right"<?php if ($OptionsVis['capt_text_align'] == 'right') echo ' selected="selected"'; ?>>right</option>
                                                            <option value="inherit"<?php if ($OptionsVis['capt_text_align'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
                                                </tr> 


                                                <tr>
                                                    <td colspan="3" class="subinfo">News paging: </td>
                                                </tr>

                                                <tr>
                                                    <td class="langLeft">Paging font-size:</td>
                                                    <td valign="top">
                                                        <select name="pag_font_size">
                                                            <option value="inherit"<?php if ($OptionsVis['pag_font_size'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                            <option value="10px"<?php if ($OptionsVis['pag_font_size'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['pag_font_size'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['pag_font_size'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['pag_font_size'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['pag_font_size'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['pag_font_size'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                        </select>
                                                    </td>
                                                </tr>    
                                                <tr>
                                                    <td class="langLeft">Paging font color:</td>
                                                    <td valign="top"><input name="pag_color" type="text" size="7" value="<?php echo $OptionsVis["pag_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_color"]); ?>;background-color:<?php echo $OptionsVis["pag_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_color, 'pickcolor');
                                                            return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">Paging font-weight:</td>
                                                    <td valign="top">
                                                        <select name="pag_font_weight">
                                                            <option value="normal"<?php if ($OptionsVis['pag_font_weight'] == 'normal') echo ' selected="selected"'; ?>>normal</option>
                                                            <option value="bold"<?php if ($OptionsVis['pag_font_weight'] == 'bold') echo ' selected="selected"'; ?>>bold</option>
                                                            <option value="inherit"<?php if ($OptionsVis['pag_font_weight'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>   
                                                <tr>
                                                    <td class="langLeft">Paging alignment:</td>
                                                    <td valign="top">
                                                        <select name="pag_align">
                                                            <option value="left"<?php if ($OptionsVis['pag_align'] == 'left') echo ' selected="selected"'; ?>>left</option>
                                                            <option value="center"<?php if ($OptionsVis['pag_align'] == 'center') echo ' selected="selected"'; ?>>center</option>
                                                            <option value="right"<?php if ($OptionsVis['pag_align'] == 'right') echo ' selected="selected"'; ?>>right</option>
                                                            <option value="inherit"<?php if ($OptionsVis['pag_align'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>            
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
                                                </tr>


                                                <tr>
                                                    <td colspan="3" class="subinfo">News 'Back' link: </td>
                                                </tr>

                                                <tr>
                                                    <td class="langLeft">Back link font-size:</td>
                                                    <td valign="top">
                                                        <select name="link_font_size">
                                                            <option value="inherit"<?php if ($OptionsVis['link_font_size'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                            <option value="10px"<?php if ($OptionsVis['link_font_size'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['link_font_size'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['link_font_size'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['link_font_size'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['link_font_size'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['link_font_size'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                        </select>
                                                    </td>
                                                </tr>    
                                                <tr>
                                                    <td class="langLeft">Back link font color:</td>
                                                    <td valign="top"><input name="link_color" type="text" size="7" value="<?php echo $OptionsVis["link_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["link_color"]); ?>;background-color:<?php echo $OptionsVis["link_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.link_color, 'pickcolor');
                                                            return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">Back link font-weight:</td>
                                                    <td valign="top">
                                                        <select name="link_font_weight">
                                                            <option value="normal"<?php if ($OptionsVis['link_font_weight'] == 'normal') echo ' selected="selected"'; ?>>normal</option>
                                                            <option value="bold"<?php if ($OptionsVis['link_font_weight'] == 'bold') echo ' selected="selected"'; ?>>bold</option>
                                                            <option value="inherit"<?php if ($OptionsVis['link_font_weight'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>   
                                                <tr>
                                                    <td class="langLeft">Back link alignment:</td>
                                                    <td valign="top">
                                                        <select name="link_align">
                                                            <option value="left"<?php if ($OptionsVis['link_align'] == 'left') echo ' selected="selected"'; ?>>left</option>
                                                            <option value="center"<?php if ($OptionsVis['link_align'] == 'center') echo ' selected="selected"'; ?>>center</option>
                                                            <option value="right"<?php if ($OptionsVis['link_align'] == 'right') echo ' selected="selected"'; ?>>right</option>
                                                            <option value="inherit"<?php if ($OptionsVis['link_align'] == 'inherit') echo ' selected="selected"'; ?>>inherit</option>
                                                        </select>
                                                    </td>
                                                </tr>            
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="3" class="subinfo">Distances: </td>
                                                </tr>

                                                <tr>
                                                    <td class="langLeft">Distance between title and date:</td>
                                                    <td valign="top">
                                                        <select name="dist_title_date">
                                                            <option value="0px"<?php if ($OptionsVis['dist_title_date'] == '0px') echo ' selected="selected"'; ?>>0px</option>
                                                            <option value="1px"<?php if ($OptionsVis['dist_title_date'] == '1px') echo ' selected="selected"'; ?>>1px</option>
                                                            <option value="2px"<?php if ($OptionsVis['dist_title_date'] == '2px') echo ' selected="selected"'; ?>>2px</option>
                                                            <option value="3px"<?php if ($OptionsVis['dist_title_date'] == '3px') echo ' selected="selected"'; ?>>3px</option>
                                                            <option value="4px"<?php if ($OptionsVis['dist_title_date'] == '4px') echo ' selected="selected"'; ?>>4px</option>
                                                            <option value="5px"<?php if ($OptionsVis['dist_title_date'] == '5px') echo ' selected="selected"'; ?>>5px</option>
                                                            <option value="6px"<?php if ($OptionsVis['dist_title_date'] == '6px') echo ' selected="selected"'; ?>>6px</option>
                                                            <option value="7px"<?php if ($OptionsVis['dist_title_date'] == '7px') echo ' selected="selected"'; ?>>7px</option>
                                                            <option value="8px"<?php if ($OptionsVis['dist_title_date'] == '8px') echo ' selected="selected"'; ?>>8px</option>
                                                            <option value="9px"<?php if ($OptionsVis['dist_title_date'] == '9px') echo ' selected="selected"'; ?>>9px</option>
                                                            <option value="10px"<?php if ($OptionsVis['dist_title_date'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['dist_title_date'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['dist_title_date'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['dist_title_date'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['dist_title_date'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                        </select>
                                                    </td>
                                                </tr>   
                                                <tr>
                                                    <td class="langLeft">Distance between date and news text:</td>
                                                    <td valign="top">
                                                        <select name="dist_date_text">
                                                            <option value="1px"<?php if ($OptionsVis['dist_date_text'] == '1px') echo ' selected="selected"'; ?>>1px</option>
                                                            <option value="2px"<?php if ($OptionsVis['dist_date_text'] == '2px') echo ' selected="selected"'; ?>>2px</option>
                                                            <option value="3px"<?php if ($OptionsVis['dist_date_text'] == '3px') echo ' selected="selected"'; ?>>3px</option>
                                                            <option value="4px"<?php if ($OptionsVis['dist_date_text'] == '4px') echo ' selected="selected"'; ?>>4px</option>
                                                            <option value="5px"<?php if ($OptionsVis['dist_date_text'] == '5px') echo ' selected="selected"'; ?>>5px</option>
                                                            <option value="6px"<?php if ($OptionsVis['dist_date_text'] == '6px') echo ' selected="selected"'; ?>>6px</option>
                                                            <option value="7px"<?php if ($OptionsVis['dist_date_text'] == '7px') echo ' selected="selected"'; ?>>7px</option>
                                                            <option value="8px"<?php if ($OptionsVis['dist_date_text'] == '8px') echo ' selected="selected"'; ?>>8px</option>
                                                            <option value="9px"<?php if ($OptionsVis['dist_date_text'] == '9px') echo ' selected="selected"'; ?>>9px</option>
                                                            <option value="10px"<?php if ($OptionsVis['dist_date_text'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['dist_date_text'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['dist_date_text'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['dist_date_text'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['dist_date_text'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['dist_date_text'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                            <option value="20px"<?php if ($OptionsVis['dist_date_text'] == '20px') echo ' selected="selected"'; ?>>20px</option>
                                                        </select>
                                                    </td>
                                                </tr>   
                                                <tr>
                                                    <td class="langLeft">Distance between news:</td>
                                                    <td valign="top">
                                                        <select name="dist_btw_news">
                                                            <option value="10px"<?php if ($OptionsVis['dist_btw_news'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="12px"<?php if ($OptionsVis['dist_btw_news'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['dist_btw_news'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['dist_btw_news'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['dist_btw_news'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                            <option value="20px"<?php if ($OptionsVis['dist_btw_news'] == '20px') echo ' selected="selected"'; ?>>20px</option>
                                                            <option value="22px"<?php if ($OptionsVis['dist_btw_news'] == '22px') echo ' selected="selected"'; ?>>22px</option>
                                                            <option value="24px"<?php if ($OptionsVis['dist_btw_news'] == '24px') echo ' selected="selected"'; ?>>24px</option>
                                                            <option value="26px"<?php if ($OptionsVis['dist_btw_news'] == '26px') echo ' selected="selected"'; ?>>26px</option>
                                                            <option value="28px"<?php if ($OptionsVis['dist_btw_news'] == '28px') echo ' selected="selected"'; ?>>28px</option>
                                                            <option value="30px"<?php if ($OptionsVis['dist_btw_news'] == '30px') echo ' selected="selected"'; ?>>30px</option>
                                                            <option value="32px"<?php if ($OptionsVis['dist_btw_news'] == '32px') echo ' selected="selected"'; ?>>32px</option>
                                                            <option value="36px"<?php if ($OptionsVis['dist_btw_news'] == '36px') echo ' selected="selected"'; ?>>36px</option>
                                                            <option value="40px"<?php if ($OptionsVis['dist_btw_news'] == '40px') echo ' selected="selected"'; ?>>40px</option>
                                                            <option value="44px"<?php if ($OptionsVis['dist_btw_news'] == '44px') echo ' selected="selected"'; ?>>44px</option>
                                                            <option value="48px"<?php if ($OptionsVis['dist_btw_news'] == '48px') echo ' selected="selected"'; ?>>48px</option>
                                                            <option value="50px"<?php if ($OptionsVis['dist_btw_news'] == '50px') echo ' selected="selected"'; ?>>50px</option>
                                                            <option value="55px"<?php if ($OptionsVis['dist_btw_news'] == '55px') echo ' selected="selected"'; ?>>55px</option>
                                                            <option value="60px"<?php if ($OptionsVis['dist_btw_news'] == '60px') echo ' selected="selected"'; ?>>60px</option>
                                                            <option value="65px"<?php if ($OptionsVis['dist_btw_news'] == '65px') echo ' selected="selected"'; ?>>65px</option>
                                                            <option value="70px"<?php if ($OptionsVis['dist_btw_news'] == '70px') echo ' selected="selected"'; ?>>70px</option>
                                                            <option value="80px"<?php if ($OptionsVis['dist_btw_news'] == '80px') echo ' selected="selected"'; ?>>80px</option>
                                                        </select>
                                                    </td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">Distance between 'Back' link and news title:</td>
                                                    <td valign="top">
                                                        <select name="dist_link_title">
                                                            <option value="1px"<?php if ($OptionsVis['dist_link_title'] == '1px') echo ' selected="selected"'; ?>>1px</option>
                                                            <option value="2px"<?php if ($OptionsVis['dist_link_title'] == '2px') echo ' selected="selected"'; ?>>2px</option>
                                                            <option value="3px"<?php if ($OptionsVis['dist_link_title'] == '3px') echo ' selected="selected"'; ?>>3px</option>
                                                            <option value="4px"<?php if ($OptionsVis['dist_link_title'] == '4px') echo ' selected="selected"'; ?>>4px</option>
                                                            <option value="5px"<?php if ($OptionsVis['dist_link_title'] == '5px') echo ' selected="selected"'; ?>>5px</option>
                                                            <option value="6px"<?php if ($OptionsVis['dist_link_title'] == '6px') echo ' selected="selected"'; ?>>6px</option>
                                                            <option value="7px"<?php if ($OptionsVis['dist_link_title'] == '7px') echo ' selected="selected"'; ?>>7px</option>
                                                            <option value="8px"<?php if ($OptionsVis['dist_link_title'] == '8px') echo ' selected="selected"'; ?>>8px</option>
                                                            <option value="9px"<?php if ($OptionsVis['dist_link_title'] == '9px') echo ' selected="selected"'; ?>>9px</option>
                                                            <option value="10px"<?php if ($OptionsVis['dist_link_title'] == '10px') echo ' selected="selected"'; ?>>10px</option>
                                                            <option value="11px"<?php if ($OptionsVis['dist_link_title'] == '11px') echo ' selected="selected"'; ?>>11px</option>
                                                            <option value="12px"<?php if ($OptionsVis['dist_link_title'] == '12px') echo ' selected="selected"'; ?>>12px</option>
                                                            <option value="14px"<?php if ($OptionsVis['dist_link_title'] == '14px') echo ' selected="selected"'; ?>>14px</option>
                                                            <option value="16px"<?php if ($OptionsVis['dist_link_title'] == '16px') echo ' selected="selected"'; ?>>16px</option>
                                                            <option value="18px"<?php if ($OptionsVis['dist_link_title'] == '18px') echo ' selected="selected"'; ?>>18px</option>
                                                            <option value="20px"<?php if ($OptionsVis['dist_link_title'] == '20px') echo ' selected="selected"'; ?>>20px</option>
                                                        </select>
                                                    </td>
                                                </tr>    
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit8" type="submit" value="Save" class="submitButton" /></td>
                                                </tr>

                                            </table>
                                        </form> 


        <?php
    } elseif ($_REQUEST["act"] == 'language_options') {
        $sql = "SELECT * FROM " . $TABLE["Options"];
        $sql_result = mysql_query($sql, $conn) or die('MySQL query error: ' . $sql);
        $Options = mysql_fetch_assoc($sql_result);
        $OptionsLang = unserialize($Options['language']);
        ?>

                                        <div class="paddingtop"></div>

                                        <form action="admin.php" method="post" name="frm">
                                            <input type="hidden" name="act" value="updateOptionsLanguage" />

                                            <table border="0" cellspacing="0" cellpadding="8" class="allTables">
                                                <tr>
                                                    <td colspan="3" class="headlist">Translate front-end in your own language</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="subinfo">News navigation and paging: </td>
                                                </tr>

                                                <tr>
                                                    <td class="langLeft">'Back' link:</td>
                                                    <td valign="top"><input name="Back_to_home" type="text" size="50" value="<?php echo ReadDB($OptionsLang["Back_to_home"]); ?>" />  &nbsp; <sub> - leave blank if you do not want 'Back' link </sub></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">'Search' button:</td>
                                                    <td valign="top"><input name="Search_button" type="text" size="50" value="<?php echo ReadDB($OptionsLang["Search_button"]); ?>" /></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">'Read more' link:</td>
                                                    <td valign="top"><input name="Read_more" type="text" size="50" value="<?php echo ReadDB($OptionsLang["Read_more"]); ?>" /></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">Pages:</td>
                                                    <td valign="top"><input name="Paging" type="text" size="50" value="<?php echo ReadDB($OptionsLang["Paging"]); ?>" /></td>
                                                </tr>    
                                                <tr>
                                                    <td class="langLeft">No news published:</td>
                                                    <td valign="top"><input name="No_news_published" type="text" size="50" value="<?php echo ReadDB($OptionsLang["No_news_published"]); ?>" /></td>
                                                </tr>               
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" height="8" style="border-bottom:solid 1px #e4e4e4"></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="3" class="subinfo">Days of the week in the date: </td>
                                                </tr>      
                                                <tr>
                                                    <td class="langLeft">Monday:</td>
                                                    <td valign="top"><input name="Monday" type="text" size="30" value="<?php echo ReadDB($OptionsLang["Monday"]); ?>" /></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">Tuesday:</td>
                                                    <td valign="top"><input name="Tuesday" type="text" size="30" value="<?php echo ReadDB($OptionsLang["Tuesday"]); ?>" /></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">Wednesday:</td>
                                                    <td valign="top"><input name="Wednesday" type="text" size="30" value="<?php echo ReadDB($OptionsLang["Wednesday"]); ?>" /></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">Thursday:</td>
                                                    <td valign="top"><input name="Thursday" type="text" size="30" value="<?php echo ReadDB($OptionsLang["Thursday"]); ?>" /></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">Friday:</td>
                                                    <td valign="top"><input name="Friday" type="text" size="30" value="<?php echo ReadDB($OptionsLang["Friday"]); ?>" /></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">Saturday:</td>
                                                    <td valign="top"><input name="Saturday" type="text" size="30" value="<?php echo ReadDB($OptionsLang["Saturday"]); ?>" /></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">Sunday:</td>
                                                    <td valign="top"><input name="Sunday" type="text" size="30" value="<?php echo ReadDB($OptionsLang["Sunday"]); ?>" /></td>
                                                </tr>           
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" height="8" style="border-bottom:solid 1px #e4e4e4"></td>
                                                </tr>


                                                <tr>
                                                    <td colspan="3" class="subinfo">Months in the date: </td>
                                                </tr>      
                                                <tr>
                                                    <td class="langLeft">January:</td>
                                                    <td valign="top"><input name="January" type="text" size="30" value="<?php echo ReadDB($OptionsLang["January"]); ?>" /></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">February:</td>
                                                    <td valign="top"><input name="February" type="text" size="30" value="<?php echo ReadDB($OptionsLang["February"]); ?>" /></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">March:</td>
                                                    <td valign="top"><input name="March" type="text" size="30" value="<?php echo ReadDB($OptionsLang["March"]); ?>" /></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">April:</td>
                                                    <td valign="top"><input name="April" type="text" size="30" value="<?php echo ReadDB($OptionsLang["April"]); ?>" /></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">May:</td>
                                                    <td valign="top"><input name="May" type="text" size="30" value="<?php echo ReadDB($OptionsLang["May"]); ?>" /></td>
                                                </tr>  
                                                <tr>
                                                    <td class="langLeft">June:</td>
                                                    <td valign="top"><input name="June" type="text" size="30" value="<?php echo ReadDB($OptionsLang["June"]); ?>" /></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">July:</td>
                                                    <td valign="top"><input name="July" type="text" size="30" value="<?php echo ReadDB($OptionsLang["July"]); ?>" /></td>
                                                </tr>   
                                                <tr>
                                                    <td class="langLeft">August:</td>
                                                    <td valign="top"><input name="August" type="text" size="30" value="<?php echo ReadDB($OptionsLang["August"]); ?>" /></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">September:</td>
                                                    <td valign="top"><input name="September" type="text" size="30" value="<?php echo ReadDB($OptionsLang["September"]); ?>" /></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">October:</td>
                                                    <td valign="top"><input name="October" type="text" size="30" value="<?php echo ReadDB($OptionsLang["October"]); ?>" /></td>
                                                </tr> 
                                                <tr>
                                                    <td class="langLeft">November:</td>
                                                    <td valign="top"><input name="November" type="text" size="30" value="<?php echo ReadDB($OptionsLang["November"]); ?>" /></td>
                                                </tr>   
                                                <tr>
                                                    <td class="langLeft">December:</td>
                                                    <td valign="top"><input name="December" type="text" size="30" value="<?php echo ReadDB($OptionsLang["December"]); ?>" /></td>
                                                </tr>       
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" height="8" style="border-bottom:solid 1px #e4e4e4"></td>
                                                </tr>

                                            </table>
                                        </form>

        <?php
    } elseif ($_REQUEST["act"] == 'html') {
        ?>
                                        <div class="pageDescr">There are two easy ways to put the news script on your website.</div>

                                        <table border="0" cellspacing="0" cellpadding="8" class="allTables">
                                            <tr>
                                                <td class="copycode">1) <strong>Using iframe code</strong> - just copy the code below and put it on your web page where you want the news to appear.</td>
                                            </tr>
                                            <tr>
                                                <td class="putonwebpage">        	
                                                    <div class="divCode">&lt;iframe src=&quot;<?php echo $CONFIG["full_url"]; ?>preview.php&quot; width=&quot;100%&quot; height=&quot;700px&quot; frameborder=&quot;0&quot; scrolling=&quot;auto&quot;&gt;&lt;/iframe&gt;   </div>     
                                                </td>
                                            </tr>
                                        </table>

                                        <table border="0" cellspacing="0" cellpadding="8" class="allTables">

                                            <tr>
                                                <td class="copycode">2) <strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the news to be.</td>
                                            </tr>

                                            <tr>
                                                <td class="putonwebpage">        	
                                                    <div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>news.php&quot;); ?&gt; </div>     
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="putonwebpage">        	
                                                    <div>If you have any problems, please do not hesitate to contact us at info@newsscriptphp.com</div>     
                                                </td>
                                            </tr>

                                        </table>

        <?php
    } elseif ($_REQUEST["act"] == 'rss') {
        ?>

                                        <div class="pageDescr">The RSS feed allows other people to keep track of your news using rss readers and to use your news on their websites. <br />
                                            Every time you publish a new article it will appear on your RSS feed and every one using it will be informed about it.</div>

                                        <table border="0" cellspacing="0" cellpadding="8" class="allTables">

                                            <tr>
                                                <td class="copycode">You can view the RSS feed <a href="rss.php" target="_blank">here</a> or use the code below to place it on your website as RSS link.</td>
                                            </tr>

                                            <tr>
                                                <td class="putonwebpage">        	
                                                    <div class="divCode">&lt;a href=&quot;<?php echo $CONFIG["full_url"]; ?>rss.php&quot; target=&quot;_blank&quot;&gt;RSS feed&lt;/a&gt;</div>     
                                                </td>
                                            </tr>

                                        </table>

        <?php
    }
    ?>
                                    </td>
                                    </tr> 
                                    </table>
                                </div>

                                <div class="clearfooter"></div>
                                <div class="blue_line"></div>
                                <div class="divProfiAnts"> <a class="footerlink" href="http://pes-systems.net/" target="_blank">Powered by Pes-Systems</a> </div>


    <?php
} else { ////// Login Form //////
    ?>
                                <div class="loginDiv">
                                    <div class="message"><?php echo $message; ?></div>
                                    <form action="admin.php" method="post" role="form">
                                        <input type="hidden" name="act" value="login">
                                            <table border="0" cellspacing="0" cellpadding="0" class="loginTable">
                                                <tr>
                                                    <td class="loginhead" height="57" valign="middle"><h4><span class="label label-primary">LOGIN DE ACCESO <span class="glyphicon glyphicon-user"></span></span></h4></td>
                                                </tr>
                                                <tr>
                                                    <td valign="top">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="8">
                                                            <tr>
                                                                <div class="form-group">
                                                                    <td><label for="username">Username </label></td>
                                                                    <td class="userpassfield"><input name="user" id="username" type="text" class="loginfield form-control" /></td>
                                                                </div>
                                                            </tr>
                                                            <tr>
                                                                <div class="form-group">
                                                                    <td><label for="username">Password </label></td>
                                                                    <td class="userpassfield"><input name="pass" type="password" class="loginfield form-control" /></td>
                                                                </div>
                                                            </tr>
                                                            <tr>
                                                                <div class="form-group">
                                                                    <td class="userpass">&nbsp;</td>
                                                                    <td class="userpassfield"><input type="submit" name="button" value="Login" class="loginButon btn btn-primary" /></td>
                                                                </div>
                                                            </tr>
                                                        </table></td>
                                                </tr>
                                                <tr>
                                                    <td height="63" valign="bottom">&nbsp;</td>
                                                </tr>
                                            </table>
                                    </form>
                                </div>
    <?php
}
?>
                        </center>
                        <!--</div>--> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
                        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.js"><\/script>')</script>

                        <script src="js/vendor/bootstrap.min.js"></script>
                    </body>
                    </html>