<?php 
	include_once("../../application/libraries/config.php"); 
	include_once("../../application/libraries/pagination.php"); 
	
	Class Post{
		var $idPost;
		var $title; //Thuộc tính
		var $idUser;
		var $timePost;
		var $lesson;
		var $category;
		var $content;
		var $tag;
		var $like;
		
		// Hàm tạo :
		function __construct($id_post, $title, $id_user, $time, $lesson, $category, $content, $tag, $like){
			$this->idPost = $id_post;
			$this->title = $title;
			$this->idUser= $id_user;
			$this->timePost = $time;
			$this->lesson = $lesson;
			$this->category = $category;
			$this->content = $content;
			$this->tag = $tag;
			$this->like = $like;
			
		}
		function __construct($id_post, $title, $id_user, $time, $lesson, $category, $content, $tag, $like){
			$this->idPost = $id_post;
			$this->title = $title;
			$this->idUser= $id_user;
			$this->timePost = $time;
			$this->lesson = $lesson;
			$this->category = $category;
			$this->content = $content;
			$this->tag = $tag;
			$this->like = $like;
			
		}
		//Hàm getset cho các thuộc tính
		function setIdPost(var $idPost){ 
			$this->idPost = $idPost;
		}
		function getIdPost(){ 
			return $this->idPost;
		}
		
		function setIdUser(var $idUser){ 
			$this->idUser= $idUser;
		}
		function getIdUser(){ 
			return $this->idUser;
		}
		
		function setTitle(var $title){ 
			$this->title = $title;
		}
		function getTitle(){ 
			return $this->title;
		}
		function setTime(var $time){ 
			$this->timePost = $time;
		}
		function getTime(){ 
			return $this->timePost;
		}
		
		function setLesson(var $lesson){ 
			$this->lesson = $lesson;
		}
		function getLesson(){ 
			return $this->idUser;
		}
		
		function setCategory(var $category){ 
			$this->category = $category;
		}	
		function getCategory(){ 
			return $this->category;
		}
		
		function setContent (var $content){ 
			$this->content = $content;
		}	
		function getContent(){ 
			return $this->content;
		}
		
		function setTag(var $tag){ 
			$this->tag = $tag;
		}	
		function getTag(){ 
			return $this->tag;
		}
		
		//getset like
		function setLike(var $like){ 
			$this->like += $like;
		}	

		function getLike(){ 
			return $this->like;
		}
	}

	//Nếu có phân loại hay kế thừa thì viết thêm dưới ni


	//Ví dụ về cách sử dụng
	$pro1=new Product( );
	echo $pro1->getId();
?>