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
	protected $_baseUrl;
	public function __construct($query, $limit ){
		$this->_conn = connectDb();
		$this->_page = 1;
		$this->_limit=$limit;
		$this->_query=$query;
		$this->_baseUrl = baseurl();
		$result = $this->_conn->prepare($query);
		$result->execute();
		$this->_total= ceil( $result->rowCount() / $this->_limit ) ;
	}
	/**
	  - Tìm ra vị trí start
	*/
	public function start(){
		if(isset($_GET['start'])){
			$start = $_GET['start'];
		}else{
			$start = 0;
		}
		return $start;
	}
	
	/**
	  - Tìm ra tổng số trang
	*/
	public function totalPages($totalRecord){
		if(isset($_GET['pages'])){
			$totalPages = $_GET['pages'];
		}else{
			$totalPages = ceil($totalRecord/$this->_limit);
		}
		return $totalPages;
	}
	/**
	  - Get Data
	*/

	public function getData( $page ) {
	    $this->_page    = $page;
	 
	    if ( $this->_limit == 'all' ) {
	        $query      = $this->_query;
	    } else {
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

		$listPage = '<div class="page-number"> <ul class="pagination">';
		
		if($this->_total > 1){ // số trang phải từ 2 trang trở lên
			if($this->_page > 1){ // Nút prev
				$listPage .= '<li ><a href="?page='.($this->_page -1).'"><span class="fa fa-chevron-left" aria-hidden="true"></span></a></li>';
			}
			else{
				$listPage .= '<li ><a href="?page='.($this->_page).'"><span class="fa fa-chevron-left" aria-hidden="true"></span></a></li>';
			}
			if($this->_total>10){
				if($this->_page +5 >= $this->_total){
					$start = $this->_total -9;
					$end = $this->_total ;
				}
				else {
					$start = ($this->_page - 4 >0) ? $this->_page - 4 : 1;
					$end = $start +9;
				}
				for($i=$start;$i<= $end ;$i++){  // Tất cả các trang tìm được
					if($i == $this->_page){
						$listPage .= '<li class="active"><a href="#"><span > '.$i. '</span> </a></li>';
					}else{
						$listPage .= '<li ><a href="?page='.$i. '">'.$i.' </a></li>';
					}
				}
			}
			else{
				for($i=1;$i<=$this->_total;$i++){  // Tất cả các trang tìm được
					if($i == $this->_page){
						$listPage .= '<li class="active"><a href="#"><span > '.$i. '</span> </a></li>';
					}else{
						$listPage .= '<li ><a href="?page='.$i. '">'.$i.' </a></li>';
					}
				}
			}
				
			
			if($this->_page < $this->_total){ // Nút next
				$listPage .= '<li ><a href="?page='.($this->_page +1).'"><span class="fa fa-chevron-right"  aria-hidden="true"></span></a></li>';
			}
			else {
				$listPage .= '<li ><a href="?page='.($this->_page).'"><span class="fa fa-chevron-right"  aria-hidden="true"></span></a></li>';
			}
		}
		$listPage.=' </ul></div>';
		return $listPage;
	}
}