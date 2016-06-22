<?php 
	Class Product{
		var $id;
		var $title; //Thuộc tính
		

		function Product($id,$title){ //Hàm tạo
			$this->id=$id;
			$this->title=$title;
		}

		function getId(){ //Các hàm thành phần
			return $this->id;
		}
	}

	//Nếu có phân loại hay kế thừa thì viết thêm dưới ni


	//Ví dụ về cách sử dụng
	$pro1=new Product(1,"Giày Undermour");
	echo $pro1->getId();
?>