<?php 
    include_once("../application/libraries/config.php"); 
    include_once("../application/libraries/pagination.php"); 

    $conn=connectDb();
    $conn->exec("set names utf8");
    $sProduct = $conn->prepare("select * from product p ,category_product c where  p.category_id = c.id "); 
    $sProduct->execute();

    function getName($name){
        $newname=$name;

        if(strlen($newname)>22){
            $i=22;
            while($newname[$i]!=' ') $i--;
           $newname=substr($newname,0, $i);
           $newname=$newname."...";
        } 

        return $newname;
    }

    if($sProduct->rowCount()>0)
    {
            while($row=$sProduct->fetch(PDO::FETCH_ASSOC))
            {
               
                ?>
                <div class="list-items col-xs-12 col-sm-4 col-md-4 col-lg-3">
                	<div class="product">
                    <a href="<?php echo $home.'product/index.php?id=1';?>">
                        <img src="<?php echo $home.$row['img']; ?>">
                    </a>
                    <div class="hot-sell">
                        <span><?php echo $row['sale'];?></span>
                        <span style="font-size: 13px;margin-left:-3px">%</span>
                    </div>
                    <div class="info-item">
                        <a href="<?php echo $home.'product/index.php?id=1';?>" title="<?php echo $row['name']; ?>">
                        <?php 
                            echo getName($row['name']);
                        ?>    
                        </a>
                        <div class="price-item">
                            <div class="sell-price"><?php echo number_format($row['price']); ?> VNĐ</div>
                            <div class="price"><?php echo number_format($row['price']*(1-$row['sale']/100),0,",","."); ?> VNĐ</div>
                        </div>
                    </div>
                    <button class="buy-now">MUA NGAY</button>
              		</div>
                </div>
                
            <?php 
            }
    }
    else
        echo "Không có hàng!";
    

?>
  