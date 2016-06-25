<?php
include_once("../libraries/config.php");
session_unset();
session_destroy();
include_once("../../header.html");
include_once("../../banner.html");
echo "<div class='notice'>Đăng xuất thành công";
echo '<a href = "javascript:history.back()" style="font-size: 20px;display:block;margin-top: 10px">Back to previous page (auto after 3s)</a>';
echo '</div>';
echo "<script>window.setTimeout('history.back()',3000);</script>";
include_once("../../footer.html");
?>