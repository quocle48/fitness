<?php 
    $conn=connectDb();
    $conn->exec("set names utf8");
    $sProduct = $conn->prepare("select * from product p ,store s , type_product t_p where p.id_product = s.id_product and p.id_type = t_p.id_type "); 
    $sProduct->execute();

    if($sProduct->rowCount()>0)
     {
            while($row=$sProduct->fetch(PDO::FETCH_ASSOC))
            {
               
            ?>
            <div class="list-items col-xs-12 col-sm-4 col-md-4 col-lg-3">
            	<div class="product">
                <a href="<?php echo $home.'product/index.php?id=1';?>">
                    <img src="<?php echo $home; ?>img/product.jpg">
                </a>
                <div class="hot-sell">
                    <span>20</span>
                    <span style="font-size: 13px;margin-left:-3px">%</span>
                </div>
                <div class="info-item">
                    <a href="<?php echo $home.'product/index.php?id=1';?>" title="Giày Underamour hàng USA nhập khẩu new 100%">
                    <?php echo $row['name']; ?></a>
                    <div class="price-item">
                        <div class="sell-price"><?php echo $row['price']; ?></div>
                        <div class="price"><?php echo $row['price']; ?> VNĐ</div>
                    </div>
                </div>
                <button class="buy-now">MUA NGAY</button>
          		</div>
            </div>
            
            <?php 
            }
     }
     else
     {
          echo "Loi! ";
     }

?>
  