<?php

$config = include($_SERVER["DOCUMENT_ROOT"] . '/assets/config.php');

$TITLE = "リソースパックページ";
$URL = 'https://packs.mlserver.xyz/';
$DESCRIPTION = "リソースパックページ";

/// Access-Control-Allow-Originエラーを回避する
header("Access-Control-Allow-Origin: *");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="ja">
	<head>
        <?php echo $html["common_head"]; ?>
		<title><?php echo $TITLE; ?></title>
		<meta property="og:url" content="<?php echo $URL; ?>/" />
		<meta property="og:title" content="<?php echo $TITLE; ?> | MonsterLifeServer" />
		<meta property="og:description" content="<?php echo $DESCRIPTION; ?>" />
        <link rel="stylesheet" href="./css/style.min.css">
    </head>
    <body>
        <?php include( $_SERVER["DOCUMENT_ROOT"] . "/assets/include/header.php"); ?>
        <div class="wrapper">
            <div class="mainBox">
                <div class="contents">
                    <!-- パンくずリスト&最終更新日 -->
                    <div class="top-label">
                        <div class="item-left">
                            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                                <li itemprop="itemListElement" itemscope
                                    itemtype="https://schema.org/ListItem">
                                    <a itemprop="item" href="https://www.mlserver.xyz/">
                                        <span itemprop="name">ホーム</span>
                                    </a>
                                    <meta itemprop="position" content="1" />
                                </li>

                                <li itemprop="itemListElement" itemscope
                                    itemtype="https://schema.org/ListItem">
                                    <a itemprop="item" href="https://packs.mlserver.xyz/">
                                        <span itemprop="name"><?php echo $TITLE; ?></span>
                                    </a>
                                    <meta itemprop="position" content="2" />
                                </li>
                            </ol>
                        </div>
                        <div class="item-right">
                            <p class="fileupdate right"><span class="title">最終更新日時: </span>
                            <?php
                                $filetime = filemtime(basename(__FILE__));
                                echo '<span class="date">'.date('Y/m/d ', $filetime).'</span>';
                                echo '<span class="time">'.date('H時i分', $filetime).'</span>'; 
                            ?></p>
                        </div>
                    </div>
                    <!-- パンくずリスト&最終更新日 -->

                    <h1 class="design">リソースパック</h1>
                    <p>これらのリソースパックの所有権はMonsterLifeServerにあります。二次配布することが禁止されているのでご注意ください。</p>
                    <div id="packs">

                        <?php
                            $url_latest = 'https://api.github.com/repos/MonsterLifeServer/resoucepacks/releases/latest';
                            $mcmeta_url = 'https://raw.githubusercontent.com/MonsterLifeServer/resoucepacks/master/%NAME%/pack.mcmeta';
                            $sh_url = "https://github.com/MonsterLi...";

                            $context = stream_context_create(array('http' => array(
                                'method' => 'GET',
                                'header' => 'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
                            )));
                            $res = file_get_contents($url_latest, false, $context);
                            $json = json_decode($res);

                            $release_name = (string) $json->name;
                            $assets = (array) $json->assets;

                            $temp3 = '';

                            foreach ($assets as $item) {
                                $name = $item->name; /* Filename */
                                $name = explode('.zip', $name)[0]; /* delete .zip */
                                $updated_at = $item->updated_at; /* file updated at time */
                                $download_url = $item->browser_download_url; /* file download url */

                                $temp2 = str_replace("%NAME%", $name, $mcmeta_url);
                                $res2 = file_get_contents($temp2);
                                $json2 = json_decode($res2);
                                $description = $json2->pack->description; /* resoucepack description */

                                $now = date('Y-m-d H:i:s');
                                $elapsed_time = strtotime($now) - strtotime($updated_at);

                                $updated_at = "";
                                $pass_seconds = $elapsed_time;
                                $pass_minutes = floor($pass_seconds / (60));
                                $pass_hours = floor($pass_seconds / (60 * 60));
                                $pass_dates = floor($pass_seconds / (24 * 60 * 60));
                                $pass_years = floor($pass_seconds / (365 * 24 * 60 * 60));
                                if ($pass_seconds < 60) $updated_at = $pass_seconds . "秒前";
                                else if ($pass_minutes < 60) $updated_at = $pass_minutes . "分前";
                                else if ($pass_hours < 24) $updated_at = $pass_hours . "時間前";
                                else if ($pass_years < 1) $updated_at = $pass_dates . "日前";
                                else $updated_at = $pass_years . "年前";
                                
                                $temp3 .= "<div class='PackCard'>";
                                $temp3 .= "<div class='PackCard_img'><img src='https://raw.githubusercontent.com/MonsterLifeServer/resoucepacks/master/".$name."/pack.png'></img></div>";
                                $temp3 .= "<div class='PackCard_content'><b>".$name."</b><br />";
                                $temp3 .= "<div class='content'>".$description."</div>";
                                $temp3 .= "<div class='updated'>".$updated_at."</div></div>";
                                $temp3 .= "<div class='PackCard_url'>".$sh_url."</div>";
                                $temp3 .= "<a href='".$download_url."'></a>";
                                $temp3 .= "</div>";
                            }
                            echo $temp3;
                        ?>

                    </div>

                </div>
            </div>
        </div>
        <?php include( $_SERVER["DOCUMENT_ROOT"] . "/assets/include/footer.php"); ?>
    </body>
    <?php echo $html["common_foot"]; ?>
</html>