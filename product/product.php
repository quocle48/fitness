<?php 
	Class Product{
		$id = "";
		$title = ""; //Thuộc tính
		

		function Product($id,$title){ //Hàm tạo
			$this->id=$id;
			$this->title=$title;
		}

		function getId(){ //Các hàm thành phần
			return $this->id;
		}
	}

	//Nếu có phân loại hay kế thừa thì viết thêm dưới ni
?>