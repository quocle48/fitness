<?php 
	Class Product{
		var $id;
		var $name;
		var $type;
		var $manufacturer; //Nhà sản xuất
		var $content;
		var $price;
		var $off; //Số % giảm giá
		var $quantity; //Số lượng
		
		function Product($id, $name, $type, $manufacturer, $content, $price, $off, $status){ //Hàm tạo
			$this->id=$id;
			$this->name=$name;
			$this->type=$type;
			$this->manufacturer=$manufacturer;
			$this->content=$content;
			$this->price=$price;
			$this->off=$off;
			$this->status=$status;
		}

		function getId(){ //Các hàm thành phần
			return $this->id;
		}
		function setId(var $id){
			$this->id = $id;
		}
		
		function getName(){ //Các hàm thành phần
			return $this->name;
		}
		function setName(var $name){
			$this->name = $name;
		}
		
		function get_Type(){ //Các hàm thành phần
			return $this->type;
		}
		function set_Type(var $type){
			$this->type = $type;
		}
		
		function getManufacturer(){ //Các hàm thành phần
			return $this->manufacturer;
		}
		function setManufacturer(var $manufacturer){
			$this->manufacturer = $manufacturer;
		}
		
		function getContent(){ //Các hàm thành phần
			return $this->content;
		}
		function setContent(var $content){
			$this->content = $content;
		}
		
		function getPrice(){ //Các hàm thành phần
			return $this->price;
		}
		function setPrice(var $price){
			$this->price = $price;
		}
		
		function getOff(){ //Các hàm thành phần
			return $this->off;
		}
		function setOff(var $off){
			$this->off = $off;
		}
		
		function getQuantity(){ //Các hàm thành phần
			return $this->quantity;
		}
		function setQuantity(var $quantity){
			$this->quantity = $quantity;
		}
		
		function Price_Off(var $price, var $off){
			return $price*($off/100);
		}
		
		function Product_Status(var $quantity){
			if($quantity == 0) echo "Hết hàng";
			else echo "Số lượng: $quantity";
		}
		
		function Product_Sell(var $quantity_sell){
			//Hàm bán còn thiếu
			$quantity -= $quantity_sell;
		}
		
		function Product_In(var $quantity_in){
			//Hàm nhập hàng còn thiếu
			$quantity += $quantity_in;
		}
	}

	//Nếu có phân loại hay kế thừa thì viết thêm dưới ni
	Class Phu_kien extends Product{
		
	}
	Class Trang_phuc extends Product{
		var $size;
		
		function getSize(){ //Các hàm thành phần
			return $this->size;
		}
		function setSize(var $size){
			$this->size = $size;
		}
	}
	Class TPBS extends Product{
		var $dosage; //Số liều dùng
		
		function getDosage(){ //Các hàm thành phần
			return $this->dosage;
		}
		function setDosage(var $dosage){
			$this->dosage = $dosage;
		}
		
		function Dosage_Price(var $price, var $dosage){ //Giá liều dùng
			return $price/$dosage;
		}
	}

	//Ví dụ về cách sử dụng
	$pro1=new Product(1,"Giày Undermour");
	echo $pro1->getId();
?>