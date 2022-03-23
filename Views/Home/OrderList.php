<?php 

    use Bang\Lib\Bundle;
    use Models\Pagination;
    use Bang\Lib\ResponseBag;

    $pagination_data = ResponseBag::Get('pagination_data');
?>
<script>
    //取得PHP變數, 讓JS操作上下一頁功能
    var pages_count = parseInt(<?php echo $pagination_data["pages_count"];?>);
</script>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-6 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-orange text-center">
                                    <h1 class="font-light text-white"><?php echo $pagination_data["data_count_num"]?></h1>
                                    <h6 class="text-white">訂單數</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-6 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-cyan text-center">
                                    <h1 class="font-light text-white"><?php echo $pagination_data["sum"]?></h1>
                                    <h6 class="text-white">訂單金額</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="th-length" style="text-align:center;width:50px">編號</th>
                                    <th class="th-length" style="text-align:center;width:100px">日期</th>
                                    <th class="th-length" style="text-align:center;width:100px;">品項</th>
                                    <th class="th-length" style="text-align:center;width:150px">會員</th>
                                    <th class="th-length" style="text-align:center;width:150px">金額</th>
                                    <th class="th-length" style="text-align:center;width:50px">付款狀態</th>
                                    <th class="th-length" style="text-align:center;width:50px">出貨狀態</th>
                                    <th class="th-length" style="text-align:center;width:250px">編輯</th>
                                </tr>
                            </thead>
                            <tbody id="order-table">
                            <?php
                                // foreach($pagination_data["each_page_data"] as $value){
                                for($i=0;$i<count($pagination_data["each_page_data"]);$i++){
                                    echo '<tr>';
                                    echo '<td style="vertical-align:initial;text-align:center">'.$pagination_data["each_page_data"][$i]["ord_no"].'</td>';
                                    echo '<td style="vertical-align:initial;text-align:center">'.$pagination_data["each_page_data"][$i]["ord_date"].'</td>';
                                    echo '<td style="vertical-align:initial;text-align:center;overflow-x:auto;max-width:400px">';
                                    foreach($pagination_data["order_item_data"][$i] as $value){echo $value["pro_name"].",";};
                                    echo '</td><td style="vertical-align:initial;text-align:center">'.$pagination_data["each_page_data"][$i]["cus_phone"].'</td>';
                                    echo '<td style="vertical-align:initial;text-align:center"">'.$pagination_data["each_page_data"][$i]["ord_price"].'</td>';
                                    echo '<td style="vertical-align:initial;text-align:center"">'.$pagination_data["each_page_data"][$i]["ord_payment_status"].'</td>';
                                    echo '<td style="vertical-align:initial;text-align:center"">'.$pagination_data["each_page_data"][$i]["ord_status"].'</td>';
                                    echo '<td style="vertical-align:initial;text-align:center">';
                                    echo '<button type="button" class="btn waves-effect waves-light btn-info edit_btn" id="'.$pagination_data["each_page_data"][$i]["ord_no"].'">編輯</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                // }
                            ?>
                            </tbody>
                        </table>
                        <?php  
                            $pagination = new Pagination($pagination_data["pages_count"],$pagination_data["page"]);
                            $pagination -> ShowPagination();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
        Bundle::Js('test_js', array(
            '/Content/js/OrderList.js'
        ));
?>
