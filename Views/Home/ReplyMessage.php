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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:100px">使用者手機</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:250px">使用者留言</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:100px">留言時間</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:150px">管理員回覆</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:250px">編輯</th>
                                </tr>
                            </thead>
                            <tbody id="user-table">
                                <?php 
                                    foreach($pagination_data["each_page_data"] as $value){
                                        echo '<tr><td style="vertical-align:initial;text-align:center;">'.$value["cus_phone"].'</td>';
                                        echo '<td style="vertical-align:initial;text-align:center;">'.$value["mes_content"].'</td>';
                                        echo '<td style="vertical-align:initial;text-align:center;">'.$value["leave_time"].'</td>';
                                        echo '<td style="vertical-align:initial;text-align:center;">'.$value["administrator_Reply"].'</td>';
                                        if($value["reply_time"] != null){
                                            echo '<td style="vertical-align:initial;text-align:center;"><button type="button" class="btn waves-effect waves-light btn-info edit_btn" data-edit="'.$value["id"].'">已回復</button>';
                                        }else{
                                            echo '<td style="vertical-align:initial;text-align:center;"><button type="button" class="btn waves-effect waves-light btn-info edit_btn" data-edit="'.$value["id"].'">回復</button>';
                                        }
                                        echo '<button type="button" class="btn waves-effect waves-light btn-danger delete_btn" style="margin: 0 5px;" data-delete="'.$value["id"].'">刪除</button>
                                            </td></tr>';
                                    }
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
<div id="reply_box" style="position: fixed;display: none;justify-content: center;align-items: center;height: 100vh;width: 88%;top: 0;background: #00000073;z-index: 50">
    <div style="width: 400px;height: 700px;background: white;text-align: center;padding: 20px;border-radius: 10px">
        <p style="text-align: start;font-size: 30px;margin: 0">使用者訊息：</p>
        <textarea id="mes_content" cols="30" rows="10" style="width: 100%;resize: none;outline: none;background:#d0d0d0;padding: 10px;" readonly></textarea>
        <p style="text-align: start;font-size: 30px;margin: 0">管理員回覆：</p>
        <textarea id="administrator_Reply" cols="30" rows="10" style="width: 100%;resize: none;outline: none;padding: 10px;"></textarea>
        <div style="margin: 15px auto;">
            <button type="button" class="btn waves-effect waves-light btn-info" id="reply">回復</button>
            <button type="button" class="btn waves-effect waves-light btn-danger" id="close_reply_box">取消</button>
        </div>
    </div>
</div>
<?php 
    Bundle::Js('test_js', array(
        '/Content/js/ReplyMessage.js'
    ));
?>