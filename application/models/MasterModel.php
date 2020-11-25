<?php

/**
 * MasterModel Class
 * @author  Rodilah Noer Rokhman <rodilahnoerrokhman @yahoo.co.id/@gmail.com>
 */
class MasterModel extends CI_Model {

    var $paginationLimit = 10;

    /** Constructor */
    function MasterModel() {
        parent::__construct();
    }

    /**
     * Check all data document or certificate when process upload file
     * @param for Query_ : String
     * @param for Array_ : String
     */
    function getQuery($Query_, $Array_) {
        return $this->db->query($Query_, $Array_);
    }

    /**
     * Check all data document or certificate when process upload file
     * @param for Query_ : String
     * @param for Array_ : String
     */
    function getQueryWithoutParameters($Query_) {
        return $this->db->query($Query_);
    }

    /**
     * For custom pagination
     * @param for num_rows : int
     * @param for limit : int
     * @param for rowActive : int
     * @param for url : String
     */
    function getPagination($num_rows, $limit, $rowActive, $url) {
        $batasAwal = 0;
        $batasAkhir = 0;
        $totalPagination = floor($num_rows % $limit) > 0 ? (floor($num_rows / $limit) + 1) : floor($num_rows / $limit);
        $tmp = array();
        $customPagination = array();

        $batasAwal = floor($rowActive / $this->paginationLimit) * $this->paginationLimit;
        if ($rowActive >= $this->paginationLimit) {
            $tmp = array();
            $tmp[0] = '<<';
            $tmp[1] = $url . '/' . ($batasAwal - $this->paginationLimit);
            array_push($customPagination, $tmp);
        }

        if ($rowActive > 0) {
            $tmp = array();
            $tmp[0] = '<';
            $tmp[1] = $url . '/' . ($rowActive - 1);
            array_push($customPagination, $tmp);
        }

        for ($i = $batasAwal; $i < ($batasAwal + 10); $i++) {
            if ($i < $totalPagination) {
                $tmp = array();
                $tmp[0] = ($i + 1) + '';
                $tmp[1] = $url . '/' . $i;
                array_push($customPagination, $tmp);
            }
        }

        if ($rowActive < $totalPagination - 1) {
            $tmp = array();
            $tmp[0] = '>';
            $tmp[1] = $url . '/' . ($rowActive + 1);
            array_push($customPagination, $tmp);
        }

        if (($batasAwal + 10) < $totalPagination) {
            $tmp = array();
            $tmp[0] = '>>';
            $tmp[1] = $url . '/' . ($batasAwal + $this->paginationLimit);
            array_push($customPagination, $tmp);
        }

        return $customPagination;
    }

    /**
     * For custom pagination
     * @param for num_rows : int
     * @param for limit : int
     * @param for rowActive : int
     * @param for url : String
     *
      function getPagination($num_rows, $limit, $rowActive, $url) {
      $totalPagination = ($num_rows%$limit)>0?Floor(($num_rows/$limit)+1):($num_rows/$limit);

      $customPagination = array();
      if($totalPagination==1) {
      for($i=1; $i<=$totalPagination; $i++)
      { array_push($customPagination, array($i, $this->config->base_url().'index.php/'.$url.'/'.($i-1)*$limit.'/0')); }
      }
      else if($totalPagination<5) {
      if($rowActive==$totalPagination) { array_push($customPagination, array('First', $this->config->base_url().'index.php/'.$url.'/0')); }
      if($rowActive>1) { array_push($customPagination, array('Prev', $this->config->base_url().'index.php/'.$url.'/'.($rowActive-2)*$limit.'/0')); }

      for($i=1; $i<=$totalPagination; $i++)
      { array_push($customPagination, array($i, $this->config->base_url().'index.php/'.$url.'/'.($i-1)*$limit.'/0')); }

      if($rowActive<$totalPagination) { array_push($customPagination, array('Next', $this->config->base_url().'index.php/'.$url.'/'.$rowActive*$limit.'/0')); }
      if($rowActive==1) { array_push($customPagination, array('Last', $this->config->base_url().'index.php/'.$url.'/'.($totalPagination-1)*$limit.'/0')); }
      }
      else {
      if($rowActive>3) { array_push($customPagination, array('First', $this->config->base_url().'index.php/'.$url.'/0')); }
      if($rowActive>1) { array_push($customPagination, array('Prev', $this->config->base_url().'index.php/'.$url.'/'.($rowActive-2)*$limit.'/0')); }

      for($i=$rowActive-2; $i<=$rowActive+2; $i++) {
      if($i>=1 and $i<=$totalPagination)
      { array_push($customPagination, array($i, $this->config->base_url().'index.php/'.$url.'/'.($i-1)*$limit.'/0')); }
      }

      if($rowActive<$totalPagination) { array_push($customPagination, array('Next', $this->config->base_url().'index.php/'.$url.'/'.$rowActive*$limit.'/0')); }
      if($rowActive<$totalPagination-2) { array_push($customPagination, array('Last', $this->config->base_url().'index.php/'.$url.'/'.($totalPagination-1)*$limit.'/0')); }
      }

      return $customPagination;
      } */
}
