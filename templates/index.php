// Простой шаблон, изменяемая часть шаблона index.php. Файлы top.php и bottom.php - это не изменяемые части
require_once ("templates/top.php");
    if (!_GET['id']{
        $file = (int)$_GET['id'];
    }else{
        $file = "index";
    }
    $query = "SELECT * FROM news WHERE id='".$file."' AND hide='show'";
        $adr = mysql_query($query);
    if (!$adr) exit($query);
    $tbl_users = mysql_fetch_array($adr);
    echo $tbl_users['name'];
    echo $tbl_users['body'];
require_once ("templates/bottom.php");    