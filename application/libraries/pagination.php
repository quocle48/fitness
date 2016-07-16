<?php
/**
- Pagination
- Author : Localhost
- Phpandmysql.net
*/
class Pagination{
	private $_conn;
	private $_limit;
    public $_page;
    private $_query;
    private $_total;
	private $_baseUrl;
	private $row;
	public function __construct($query, $limit){
		$this->_conn = connectDb();
		$this->_conn->exec("set names utf8");
		$this->_page = 1;
		$this->_limit=$limit;

		$url = baseurl();
		$pos = strpos($url, "?");
		// The !== operator can also be used.  Using != would not work as expected
		// because the position of 'a' is 0. The statement (0 != false) evaluates 
		// to false.
		if ($pos !== false) {
			if(strpos($url, "page")!== false){
				$url= substr($url,0,strpos($url,"page"));
			}
		    else $url.="&";
		} else {
		    $url.="?";;
		}
		$this->_baseUrl=$url;
		$this->_query=$query;
		$result = $this->_conn->prepare($query);
		$result->execute();
		$this->row = $result->rowCount();
		
		$this->_total= ceil( $result->rowCount() / $this->_limit ) ;
	}
	public function getUrl(){
		return $this->_baseUrl;
	}
	/**

	  - Get Data
	*/
	public function getData( $page ) {
		if($page <1) $page =1;
		if($page > $this->_total) $page = $this->_total;
	    $this->_page    = $page; 
	    if ( $this->_limit == 'all' || $this->row <= $this->_limit ) {
	        $query      = $this->_query;
	    } 
	    else {
	        $query      = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", ".$this->_limit."";
	    }
	    $result = $this->_conn->query( $query );
		$result->execute();
	    return $result;
	}
	/**
	  - Gọi ra list phân trang
	*/
	public function listPages(){
		// $start = $this->start();
		// $limit = $this->limit;
		if($this->_total > 1){ // số trang phải từ 2 trang trở lên
			$listPage = '<div class="page-number"> <ul class="pagination">';
			if($this->_page > 1){ // Nút prev
				$listPage .= '<li ><a href="'.$this->_baseUrl.'page='.($this->_page -1).'"><span class="fa fa-chevron-left" aria-hidden="true"></span></a></li>';
			}
			else{
				$listPage .= '<li ><a href="'.$this->_baseUrl.'page='.($this->_page).'"><span class="fa fa-chevron-left" aria-hidden="true"></span></a></li>';

			}
			// Đoạn phân trang, chia ra các trường hợp
			if($this->_total>5){ 
				if($this->_page +2 >= $this->_total){ //Nếu trang ở phía cuối, hiển thị 10 trang cuối cùng
					$start = $this->_total -4;
					$end = $this->_total ;
				}
				else {
					$start = ($this->_page - 2 >0) ? $this->_page - 2 : 1;
					$end = ($start==1) ? $start +4 : $this->_page +2;
				}
				if($start !=1) $listPage .= '<li class=""><a href="javascript:void(0)" aria-hidden="true"><span > .. </span> </a></li>';
				for($i=$start;$i<= $end ;$i++){  // Các trang trong đoạn start - end

					if($i == $this->_page){
						$listPage .= '<li class="active"><a href="" aria-hidden="true"><span > '.$i. '</span> </a></li>';
					}else{
						$listPage .= '<li ><a href="'.$this->_baseUrl.'page='.$i. '">'.$i.' </a></li>';
					}
				}
				if($end !=$this->_total) $listPage .= '<li class=""><a href="#" aria-hidden="true"><span > .. </span> </a></li>';
			}
			else{
				for($i=1;$i<=$this->_total;$i++){  // Tất cả các trang tìm được
					if($i == $this->_page){
						$listPage .= '<li class="active"><a href="#"><span > '.$i. '</span> </a></li>';
					}else{
						$listPage .= '<li ><a href="'.$this->_baseUrl.'page='.$i. '">'.$i.' </a></li>';
					}
				}
			}
				
			
			if($this->_page < $this->_total){ // Nút next
				$listPage .= '<li ><a href="'.$this->_baseUrl.'page='.($this->_page +1).'"><span class="fa fa-chevron-right"  aria-hidden="true"></span></a></li>';
			}
			else {
				$listPage .= '<li ><a href="'.$this->_baseUrl.'page='.($this->_page).'"><span class="fa fa-chevron-right"  aria-hidden="true"></span></a></li>';
			}
			$listPage.=' </ul></div>';
			return $listPage;
		}
		
	}
	public function closeConn() {
	    disconnectDb ($this->_conn ) ;
	}
}