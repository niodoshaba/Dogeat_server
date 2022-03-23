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
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:100px">編號</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:100px">姓名</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:250px">地址</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:100px">手機號碼</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:150px">帳號</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:100px">狀態</th>
                                    <th class="th-length" style="vertical-align:initial;text-align:center;width:250px">編輯</th>
                                </tr>
                            </thead>
                            <tbody id="user-table">
                                <?php 
                                    foreach($pagination_data["each_page_data"] as $value){
                                        echo '<tr><td style="vertical-align:initial;text-align:center;">'.$value["cus_no"].'</td>';
                                        echo '<td style="vertical-align:initial;text-align:center;">'.$value["cus_name"].'</td>';
                                        echo '<td style="vertical-align:initial;text-align:center;">'.$value["cus_address"].'</td>';
                                        echo '<td style="vertical-align:initial;text-align:center;">'.$value["cus_phone"].'</td>';
                                        echo '<td style="vertical-align:initial;text-align:center;">'.$value["cus_id"].'</td>';
                                        echo '<td style="vertical-align:initial;text-align:center;">'.$value["cus_status"].'</td>';
                                        echo '<td style="vertical-align:initial;text-align:center;"><button type="button" class="btn waves-effect waves-light btn-info edit_btn" data-edit="'.$value["cus_no"].'">編輯</button>
                                                <button type="button" class="btn waves-effect waves-light btn-danger delete_btn" data-delete="'.$value["cus_no"].'">刪除</button>
                                            </td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                        <button style="display:block;border-radius:50px;margin:0 auto;font-size:26px;color:white;font-weight:1000;line-height:30px"  class="btn waves-effect waves-light btn-warning" id="add_btn">+</button>
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

<div style="width:100%;height:100vh;background-color:rgba(0,0,0,.3);display:none;justify-content:center;align-items:center;position:absolute;top:0;" id="add_lightbox_out">
    <div style="box-shadow:0px 3px 5px #959595;width:40%;margin:0 auto;border-radius:10px;background-color:#f9fbfd" id="add_lightbox">
        <div style="display:flex;flex-direction:column;width:250px;margin:0 auto">
            <h3 style="margin:20px auto 10px auto">會員資料</h3>
            <input style="border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" placeholder="姓名" id="add_member_name"></input>
            <input style="border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" placeholder="地址" id="add_member_address"></input>
            <input style="border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" placeholder="手機" id="add_member_phone"></input>
            <input style="border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" placeholder="帳號" id="add_member_account"></input>
            <input style="border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" placeholder="密碼" id="add_member_password"></input>
            <select name="" style="border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" id="add_member_status">
                <option value="正常">正常</option>
                <option value="黑名單">黑名單</option>
            </select>
            <button class="btn waves-effect waves-light btn-warning" style="font-weight:bolder;width:30%;vertical-align:initial;text-align:center;;margin:10px 10px 20px 35%" id="add_btn_finish">新增</button>
            <button class="btn waves-effect waves-light btn-warning" style="font-weight:bolder;width:30%;vertical-align:initial;text-align:center;;margin:10px 10px 20px 35%" id="edit_btn_finish">修改</button>
        </div>
    </div>
</div>

<?php 
    Bundle::Js('test_js', array(
        '/Content/js/MemberList.js'
    ));
?>
