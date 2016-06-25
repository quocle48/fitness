<?php
	Class Store{
		
	}
	Class Product{
		var $id;
		var $name;
		var $type;
		var $brand; //Nhà sản xuất
		var $size; // array size
		var $content;
		var $price;
		var $off; //Số % giảm giá
		var $quantity; //array Số lượng với size tương ứng 

		function Product(){}
		function Product($id, $name, $type, $brand, $content, $price, $off, $status){ //Hàm tạo
			$this->id=$id;
			$this->name=$name;
			$this->type=$type;
			$this->brand=$brand;
			$this->content=$content;
			$this->price=$price;
			$this->off=$off;
			$this->status=$status;
		}

		function getId(){
			return $this->id;
		}
		function setId($id){
			$this->id = $id;
		}
		
		function getName(){
			return $this->name;
		}
		function setName($name){
			$this->name = $name;
		}
		
		function getType(){
			return $this->type;
		}
		function setType($type){
			$this->type = $type;
		}
		
		function getBrand(){
			return $this->brand;
		}
		function setBrand($brand){
			$this->brand = $brand;
		}
		
		function getContent(){
			return $this->content;
		}
		function setContent($content){
			$this->content = $content;
		}
		
		function getPrice(){
			return $this->price;
		}
		function setPrice($price){
			$this->price = $price;
		}
		
		function getOff(){
			return $this->off;
		}
		function setOff($off){
			$this->off = $off;
		}
		
		function getQuantity(){
			return $this->quantity;
		}
		function setQuantity($quantity){
			$this->quantity = $quantity;
		}
		
		function getPriceOff(){
			return $this->price*(1-$this->off/100);
		}
		
		function getStatus(){
			return $this->quantity>0?"Còn hàng":"Hết hàng";
		}
		
		function Sell($value){
			if($this->quantity<$value) return false;
			else $this->quantity -= $value;
		}
		
		function Import($value){
			//Hàm nhập hàng còn thiếu
			 $this->quantity += $value;
		}
	}

	//Ví dụ về cách sử dụng
	$pro1=;
	echo $pro1->getId();
?>