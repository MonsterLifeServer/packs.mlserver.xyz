<?php
class HomePageFunction {

    public $conf_path;
    public $title;
    public $pageUrl;
    public $description;

    public function __construct($conf_path = "", $title = "MonsterLifeServer") {
        $this->conf_path = $conf_path;
        $this->title = $title;

        $this->pageUrl = $this->getUrl().'/';
        $this->description = "ミニゲーム企画鯖『MonsterLifeServer』のホームページです。";
    }

    public function startsWith($haystack, $needle) {
        return (strpos($haystack, $needle) === 0);
    }

    public function setPageUrl($url) {
        if ($this->startsWith($url, $this->getUrl()) === FALSE) {
            $url = $this->getUrl() . $url;
        }
        $this->pageUrl = $url;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function printMetaData() {
        include($this->conf_path);
        echo $html["common_head"];
        $title = $this->getTitle();
        if (strpos($title, "MonsterLifeServer") === false) {
            $title = $title . " | MonsterLifeServer";
        }
        echo '<title>'.$title.'</title>';
		echo '<meta property="og:url" content="'.$this->getPageUrl().'" />';
		echo '<meta property="og:title" content="'.$this->getTitle().'" />';
		echo '<meta property="og:description" content="'.$this->getDescription().'" />';
    }

    public function printFootScript() {
        include($this->conf_path);
        echo '<script src="'.$this->getUrl().'/assets/js/main-bottom.js"></script>';
    }

    /**
     * 
     */
    public function isNearDate($text){
        $date = new DateTime();
        $date->setTimeZone( new DateTimeZone('Asia/Tokyo'));
        $str = $date->format('Y/m/d');
        for ($i = 1; $i <= 7; $i++) {
            if ($str === $text) {
                return true;
            }
            $str = date('Y/m/d', strtotime('+' . $i . ' day'));
        }
        return false; 
    }

    public function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
    
    public function getCategoryColorCode($text) {
        if (strpos($text, "青鬼ゲーム") !== false) {
            return "#6354A5";
        } 
    
        else if (strpos($text, "DbD") !== false) {
            return "#2D343B";
        }
    
        else if ("MonsterBOT" === $text || "Discord" === $text) {
            return "#7289DA";
        }
        else if ("重要" === $text) {
            return "#ff0000";
        }
        
        else { return "#F5A9A9; color: #000000";}
    }
    
    public function getResoucePackURL($id) {
        $api = "https://api.mlserver.xyz/resoucepack.php";
        $res = file_get_contents($api);
        $json = json_decode($res);
    
        $array = (array) $json->res;
    
        foreach ($array as $item) {
            if (strpos($item->name, $id)) {
                return $item->download_url;
            }
        }
        return null;
    }

    public function getPageUrl() {
        return $this->pageUrl;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getConf() {
        include($this->conf_path);
        return $conf;
    }

    public function getUrl() {
        include($this->conf_path);
        return $conf["url"];
    }

    public function getSqlHost() {
        include($this->conf_path);
        return $conf["sql"]["host"];
    }

    public function getSqlDataBase() {
        include($this->conf_path);
        return $conf["sql"]["db"];
    }

    public function getSqlPort() {
        include($this->conf_path);
        return $conf["sql"]["port"];
    }

    public function getSqlUser() {
        include($this->conf_path);
        return $conf["sql"]["user"];
    }

    public function getSqlPassWord() {
        include($this->conf_path);
        return $conf["sql"]["password"];
    }

    public function getProgressToken() {
        include($this->conf_path);
        return $conf["github"]["progress_token"];
    }

    public function getProgressUser() {
        include($this->conf_path);
        return $conf["github"]["progress_user"];
    }

    public function getGitHubAPIUrl() {
        include($this->conf_path);
        return $conf["github"]["api_url"];
    }

    public function getGitHubSorceUrl() {
        include($this->conf_path);
        return $conf["github"]["sorce_url"];
    }

    public function getProgressProjects() {
        include($this->conf_path);
        return $github_project;
    }

}

?>