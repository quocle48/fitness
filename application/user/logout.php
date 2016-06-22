<?php
include("../../header.html"); 
include("../../banner.html");
session_destroy();
session_unset();
echo "<div class='notice'>Đăng xuất thành công";
echo '<a href = "javascript:history.back()" style="font-size: 20px;display:block;margin-top: 10px">Back to previous page (auto after 3s)</a>';
echo '</div>';
echo "<script>window.setTimeout('history.back()',3000);</script>";
include("../../footer.html");
?>