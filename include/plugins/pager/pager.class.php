<?php
class midas_pager {
	var $total_records = 0;
	var $records_per_page = 25;
	var $theme = '';
	var $tpl_pager = 'pager.inc.php';
	var $tpl_displaying = 'displaying.inc.php';
	var $css_file = 'pager.css';
	var $qry_str = '';
	var $needs_paging = true;

	function static_pager($total_records, $records_per_page, $start='0', $theme = '') {
		$this->static_pager($total_records, $records_per_page, $start, $theme);
		$this->static_pager->show_pager();
		return $this->static_pager;
	}

	function static_displaying($total_records, $records_per_page, $start='0', $theme = '') {
		$this->static_displaying($total_records, $records_per_page, $start, $theme);
		$this->static_displaying->show_displaying();
		return $this->static_displaying;
	}

	function midas_pager_obj($total_records, $records_per_page, $start='0', $theme = '') {

		if($theme == '') {
			$theme = 'default';
		}

		$this->total_records = intval($total_records);
		$this->records_per_page = intval($records_per_page);
		$this->theme = $theme;
		
		if($records_per_page >= $total_records) {
			$this->needs_paging = false;
			return '';
		} else {
			$this->needs_paging = true;
		}

		$this->css = fs_to_absolute(dirname(__FILE__)).'/themes/'.$this->theme.'/'.$this->css_file;
		$this->start = $start;
		$this->page_name = $_SERVER['PHP_SELF'];

		$qry_str = $_SERVER['argv'][0];
		$tmp = $_GET;
		unset($tmp['start']);
		$this->qry_str = qry_str($tmp);

		$this->total_pages = ceil($this->total_records/$this->records_per_page);

		$this->current_page = floor($this->start/$this->records_per_page)+1;
		$this->first_page = $this->page_name.$this->qry_str."&start=0";
		$this->previous_page = $this->page_name.$this->qry_str."&start=".($this->start - $this->records_per_page);
		$this->next_page = $this->page_name.$this->qry_str."&start=".($this->start + $this->records_per_page);

		$mod = $this->total_records%$this->records_per_page==0?$this->records_per_page:$this->total_records% $this->records_per_page;
		$this->last_page = $this->page_name.$this->qry_str."&start=".($this->total_records-$mod);
	}

	function show_pager() {
		include(dirname(__FILE__).'/themes/'.$this->theme.'/'.$this->tpl_pager);
	}

	function show_displaying() {
		include(dirname(__FILE__).'/themes/'.$this->theme.'/'.$this->tpl_displaying);
	}

	function has_previous() {
		return $this->start != 0 ? true : false;
	}
	
	function has_next() {
		return $this->start + $this->records_per_page < $this->total_records?true:false;
	}
/*
	function is_current_page($page_num) {
		 return ($this->records_per_page*($page_num))==$this->start):true:false;
	}
	function first_page() {
		return $this->page_name.$this->qry_str."&start=0";
	}
	function previous_page() {
		return $this->page_name.$this->qry_str."&start=".($this->start - $this->records_per_page);
	}
	function next_page() {
		return $this->page_name.$this->qry_str."&start=".($this->start + $this->records_per_page);
	}
	function last_page() {
		$mod = $reccnt % $pagesize;
		if ($mod == 0) {
			$mod = $pagesize;
		}
		return $this->page_name.$this->qry_str."&start=".($this->total_records-$mod);
	}
*/

	function get_page_link($page_num) {
		return $this->page_name.$this->qry_str."&start=".$this->records_per_page*($page_num-1);
	}

	function get_numbered_links() {
		$j=$this->start/$this->records_per_page-5;
		if($j<0) {
			$j=0;
		}
		$k = $j+10;

		$num_pages=$this->total_pages;

		if($k>$num_pages)	{
			$k=$num_pages;
		}

		$j = floor($j);
		$arr_numbered_links = array();
		for($i=$j+1;$i<=$k;$i++) {
			$arr_numbered_links[$i] = $this->get_page_link($i);
		}
		return $arr_numbered_links;
	}
}
?>