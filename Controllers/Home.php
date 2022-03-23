<?php

namespace Controllers;

use Bang\MVC\ControllerBase;
use Bang\Lib\ResponseBag;
use Models\Pagination;
use Models\UserDatabase;
use Models\VegDatabase;
/**
 * 主頁面Controller
 * @author Bang
 */
class Home extends ControllerBase {

    public function index(){
        return $this -> View();
    }

    public function MemberList(){
        $_SESSION['sort_name']='pro_no';
        $_SESSION['sort_by']='ASC';
        $user_data = new UserDatabase();
        $pre_page = 5; //每頁幾筆
        if (!isset($_GET["Page"])){
            $page=1; //起始頁數
        }else{
            $page = intval($_GET["Page"]); //當前頁數
        }

        $data = $user_data->CountAllUser();

        if($data != false){
            $data_count_num = $data[0][0];  //總共幾筆資料
        }else{
            echo false;
        }

        $each_page_data = $user_data -> EachPageUserData($page,$pre_page); //當前頁數所有資料
        $pages_count = ceil($data_count_num/$pre_page); //總頁數

        $pagination_data = array(
            "pages_count" => $pages_count,
            "page" => $page,
            "each_page_data" => $each_page_data
        );
        
        ResponseBag::Add('pagination_data', $pagination_data);
        
        return $this -> View();
    }

    public function OrderList(){
        $_SESSION['sort_name']='pro_no';
        $_SESSION['sort_by']='ASC';
        $order_data = new UserDatabase();
        $pre_page = 5; //每頁幾筆
        if (!isset($_GET["Page"])){
            $page=1; //起始頁數
        }else{
            $page = intval($_GET["Page"]); //當前頁數
        }

        $data = $order_data->CountAllOrder();
        $sum_data =  $order_data->SumAllOrder();
        $sum = $sum_data[0][0];
        
        if($data != false){
            $data_count_num = $data[0][0];  //總共幾筆資料
        }else{
            echo false;
        }

        $each_page_data = $order_data -> EachPageOrderData($page,$pre_page); //當前頁數所有資料

        $order_item_data = array();
        foreach($each_page_data as $a){
            array_push($order_item_data,$order_data ->EachOrderData($a["ord_no"]));
        }
        // print_r( $order_item_data);

        $pages_count = ceil($data_count_num/$pre_page); //總頁數

        $pagination_data = array(
            "sum" => $sum,
            "data_count_num" => $data_count_num,
            "pages_count" => $pages_count,
            "page" => $page,
            "each_page_data" => $each_page_data,
            "order_item_data" =>$order_item_data,
        );

        ResponseBag::Add('pagination_data', $pagination_data);


        return $this -> View();
    }

    public function ProductList(){
        $user_data = new VegDatabase();
        $pre_page = 5; //每頁幾筆
        if(!isset($_SESSION['sort_name'])){
            $_SESSION['sort_name']='pro_no';
            $_SESSION['sort_by']='ASC';
        }else{
            if(isset($_GET["sort_name"])){//透過API呼叫
                $_SESSION['sort_name']=$_GET["sort_name"];
                $_SESSION['sort_by']=$_GET["sort_by"];
            }
        }
        if (!isset($_GET["Page"])){
            $page=1; //起始頁數
        }else{
            $page = intval($_GET["Page"]); //當前頁數
        }

        $data = $user_data->CountAllProduct();

        if($data != false){
            $data_count_num = $data[0][0];  //總共幾筆資料
        }else{
            echo false;
        }

        $each_page_data = $user_data -> EachPageProductData($page,$pre_page); //當前頁數所有資料
        $pages_count = ceil($data_count_num/$pre_page); //總頁數

        $pagination_data = array(
            "pages_count" => $pages_count,
            "page" => $page,
            "each_page_data" => $each_page_data,
            "data_count_num" => $data_count_num
        );
        
        ResponseBag::Add('pagination_data', $pagination_data);
        return $this -> View();
    }
    public function ReplyMessage(){
        $_SESSION['sort_name']='pro_no';
        $_SESSION['sort_by']='ASC';
        $user_data = new UserDatabase();
        $pre_page = 5; //每頁幾筆
        if (!isset($_GET["Page"])){
            $page=1; //起始頁數
        }else{
            $page = intval($_GET["Page"]); //當前頁數
        }

        $data = $user_data->CountAllemberMessage();

        if($data != false){
            $data_count_num = $data[0][0];  //總共幾筆資料
        }else{
            echo false;
        }

        $each_page_data = $user_data -> SelectAllMemberMessage($page,$pre_page); //當前頁數所有資料
        $pages_count = ceil($data_count_num/$pre_page); //總頁數

        $pagination_data = array(
            "pages_count" => $pages_count,
            "page" => $page,
            "each_page_data" => $each_page_data
        );
        
        ResponseBag::Add('pagination_data', $pagination_data);

        return $this -> View();
    }
}
