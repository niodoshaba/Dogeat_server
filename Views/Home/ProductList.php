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
        <?php
        Bundle::Css('test_css', array(
            './Content/css/croppie.css'
        ));
        ?>
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
 
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="th-length" style="text-align:center;width:50px;">編號</th>
                                                <th class="th-length" style="cursor: pointer;text-align:center;width:100px" id="cata_no">類別</th>
                                                <th class="th-length" style="text-align:center;width:150px">品名</th>
                                                <th class="th-length" style="cursor: pointer;text-align:center;width:50px" id="pro_price">金額</th>
                                                <th class="th-length" style="text-align:center;width:100px">容量</th>
                                                <th class="th-length" style="text-align:center;width:150px">成分</th>
                                                <th class="th-length" style="text-align:center;width:100px">保存期限</th>
                                                <th class="th-length" style="text-align:center;width:120px">照片</th>
                                                <th class="th-length" style="text-align:center;width:250px">產品簡介</th>
                                                <th class="th-length" style="cursor: pointer;text-align:center;width:50px" id="pro_status">狀態</th>
                                                <th class="th-length" style="text-align:center;width:100px">編輯</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-table">
                                            <?php
                                                foreach($pagination_data["each_page_data"] as $value){
                                                    if($value["pro_status"] == "1"){
                                                        $status = "未上架";
                                                    }else{
                                                        $status = "上架";
                                                    }
                                                    echo '<tr>';
                                                    echo '<td style="vertical-align:initial;text-align:center">'.$value["pro_no"].'</td>';
                                                    echo '<td style="vertical-align:initial;text-align:center"">'.$value["cata_name"].'</td>';
                                                    echo '<td style="vertical-align:initial;text-align:center"">'.$value["pro_name"].'</td>';
                                                    echo '<td style="vertical-align:initial;text-align:center"">'.$value["pro_price"].'</td>';
                                                    echo '<td style="vertical-align:initial;text-align:center"">'.json_decode($value["pro_all_info"]) -> product_content.'g/包</td>';
                                                    echo '<td style="vertical-align:initial;text-align:center"">'.json_decode($value["pro_all_info"]) -> product_element.'</td>';
                                                    echo '<td style="vertical-align:initial;text-align:center"">'.json_decode($value["pro_all_info"]) -> pro_deadtime.'</td>';
                                                    echo '<td style="vertical-align:initial;text-align:center;">';
                                                    echo '<img style="width:80px;margin: 0 5px;" src="'.json_decode($value["pro_img"]) -> img_01.'" alt="">';
                                                    echo '<img style="width:80px;margin: 0 5px;" src="'.json_decode($value["pro_img"]) -> img_02.'" alt="">';
                                                    echo '<img style="width:80px;margin: 0 5px;" src="'.json_decode($value["pro_img"]) -> img_03.'" alt="">';
                                                    echo '<img style="width:80px;margin: 0 5px;" src="'.json_decode($value["pro_img"]) -> img_04.'" alt="">';
                                                    echo '</td">';
                                                    echo '<td style="vertical-align:initial;text-align:center;max-width:250px;overflow:hidden;text-overflow: ellipsis;"">'.json_decode($value["pro_all_info"]) -> pro_info.'</td>';
                                                    echo '<td style="vertical-align:initial;text-align:center"">'.$status.'</td>';
                                                    echo '<td style="vertical-align:initial;text-align:center">';
                                                    echo '<button type="button" class="btn waves-effect waves-light btn-info edit_btn" id="'.$value["pro_no"].'">編輯</button>';
                                                    echo '</td>';
                                                    echo '</tr>';
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
            <form action="" method="POST" enctype="multipart/form-data" id="form">
                <div id="update_box" style="width:100%;height:100vh;background-color:rgba(0,0,0,.3);display:none;justify-content:center;align-items:center;position:absolute;top:0;">
                    <div id="update_product" style="width: 390px;height: 785px;background: #fff;display: flex;flex-direction: column;justify-content: center;">
                        <input style="display:none" name="product_num" id="product_num"></input>
                        <div style="margin:0 10px">
                            <span>商品名稱：</span><input style="width: 270px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" placeholder="品名" name="product_name"  id="product_name"></input>                      
                        </div>
                        <div style="margin:0 10px">
                            <span>商品成分：</span><input style="width: 270px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" placeholder="成分" name="product_element"  id="product_element"></input>                      
                        </div>
                        <div style="margin:0 auto">
                            <span>保存期限：</span>
                            <select style="width: 120px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:11px;" name="product_refrigeration" id="product_refrigeration">
                                <option value="冷藏1周">冷藏1周</option>
                                <option value="冷藏2周">冷藏2周</option>
                                <option value="冷藏3周">冷藏3周</option>
                                <option value="冷藏4周">冷藏4周</option>
                                <option value="冷藏5周">冷藏5周</option>
                            </select>
                            <select style="width: 120px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:11px" name="product_freezing" id="product_freezing">
                                <option value="冷凍1周">冷凍1周</option>
                                <option value="冷凍2周">冷凍2周</option>
                                <option value="冷凍3周">冷凍3周</option>
                                <option value="冷凍4周">冷凍4周</option>
                                <option value="冷凍5周">冷凍5周</option>
                            </select>
                        </div>
                        <div style="margin: 0 9px;">
                            <span>商品種類：</span>
                            <select style="width: 120px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px;" name="product_catalog" id="product_catalog">
                                <option value="1">蔬菜零食</option>
                                <option value="2">蔬菜粉粉</option>
                            </select>
                            <br>
                            <span>商品狀態：</span>
                            <select style="width: 120px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" name="product_status" id="product_status">
                                <option value="0">上架</option>
                                <option value="1">未上架</option>
                            </select>
                        </div>
                        <div style="margin:0 10px;position: relative;">
                            <span>商品容量：</span><input style="width: 270px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" name="product_content" placeholder="容量" id="product_content"></input>
                            <span style="position: absolute;right: 15px;transform: translateY(-50%);top: 50%;border-left: 2px solid #e8eef3;height: 30px;line-height: 30px;text-align: center;">g/包</span>                          
                        </div>
                        <div style="margin:0 10px;position: relative;">
                            <span>商品金額：</span><input style="width: 270px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" name="product_price" placeholder="金額" id="product_price"></input>                            
                            <span style="width:35px;position: absolute;left: 90px;transform: translateY(-50%);top: 50%;border-right: 2px solid #e8eef3;height: 30px;line-height: 30px;text-align: center;">NT</span> 
                        </div>

                        <div>
                            <input accept=".jpg,.png" type="file" style="overflow: hidden;width: 250px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" name="product_file[]" class="product_url"></input>
                            <div style="display: inline-block;">
                                <img src="" style="width:50px;height:50px;cursor: pointer;" class="product_picture" alt="尚未上傳" title="裁剪圖片" id="tmp_base64_01">
                                <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" name="tmp_base64_01">
                            </div>
                        </div>
                        <div>
                            <input accept=".jpg,.png" type="file" style="overflow: hidden;width: 250px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" name="product_file[]" class="product_url"></input>
                            <div style="display: inline-block;">
                                <img src="" style="width:50px;height:50px;cursor: pointer;" class="product_picture" alt="尚未上傳" title="裁剪圖片" id="tmp_base64_02">
                                <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" name="tmp_base64_02">
                            </div>
                        </div>
                        <div>
                            <input accept=".jpg,.png" type="file" style="overflow: hidden;width: 250px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" name="product_file[]" class="product_url"></input>
                            <div style="display: inline-block;">
                                <img src="" style="width:50px;height:50px;cursor: pointer;" class="product_picture" alt="尚未上傳" title="裁剪圖片" id="tmp_base64_03">
                                <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" name="tmp_base64_03">
                            </div>
                        </div>
                        <div>
                            <input accept=".jpg,.png" type="file" style="overflow: hidden;width: 250px;border:2px solid #e8eef3;vertical-align:initial;text-align:center;margin:10px" name="product_file[]" class="product_url"></input>
                            <div style="display: inline-block;">
                                <img src="" style="width:50px;height:50px;cursor: pointer;" class="product_picture" alt="尚未上傳" title="裁剪圖片" id="tmp_base64_04">
                                <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" name="tmp_base64_04">
                            </div>
                        </div>
                        
                        <div style="margin:0 10px">
                            <p style="margin: 5px;">商品簡介：</p><textarea style="resize:none;width: 370px;height: 100px;border:2px solid #e8eef3;" name="product_info" placeholder="商品簡介" id="product_info"></textarea>                            
                        </div>                         
                        <div style="margin:0 auto">
                            <button type="button" class="btn waves-effect waves-light btn-info" id="upload" onclick="determine('upload')">上傳</button>
                            <button type="button" class="btn waves-effect waves-light btn-info" id="edit_sql_but" onclick="determine('edit_sql')">上傳</button>
                            <button type="button" class="btn waves-effect waves-light btn-danger" id="close_update_box">取消</button>
                        </div>
                    </div>
                    <div id="edit_picture" style="padding: 20px 0;margin: 5px;width: 330px;height: 460px;background: #fff;display: none;flex-direction: column;align-items: center;">
                        <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" id="temp_img">
                        <p style="margin: 0;">裁剪圖片</p>
                        <div style="margin: 5px;">
                            <button type="button" class="btn waves-effect waves-light btn-info vanilla-result cutpicture" style="background:#9e5fe8">裁剪</button>                       
                            <input type="number" placeholder="裁剪尺寸" id="cutSize" min="0" max="300" step="10" style="width: 240px;">
                        </div>
                        <div style="width: 300px;height: 300px;">
                            <div id="demo" style="position: relative;"></div>
                        </div>
                        <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" name="data_num" value=<?php echo $pagination_data["data_count_num"]?>>
                        <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" name="old_img_01" id="old_img_01">
                        <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" name="old_img_02" id="old_img_02">
                        <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" name="old_img_03" id="old_img_03">
                        <input type="text" style="visibility: hidden;width: 0;height: 0;margin: 0;padding: 0;" name="old_img_04" id="old_img_04">
                    </div>
                </div>                      
            </form>
<?php 
        Bundle::Js('test_js', array(
            './Content/js/croppie.js',
            './Content/js/ProductList.js'
        ));
?>
<script>
    //排序
    let previous_id="<?php echo $_SESSION['sort_name'];?>";
    let sort_by="<?php echo $_SESSION['sort_by']?>";
    //重整頁面後當前用誰排序給予底色及上下的img
    $("#"+previous_id).css("background","#dbe8f3");
    if(sort_by == "ASC"){
    $("#"+previous_id).append('<img src="/back//Content/img/images/up-arrow.png" style = "margin: 0 5px 2px;" alt="">');
    }else{
        $("#"+previous_id).append('<img src="/back//Content/img/images/down-arrow.png" style = "margin: 0 5px 2px;" alt="">');
    }
    //切換排序
    $("#cata_no,#pro_price,#pro_status").click(function () { 
        if($(this).attr("id") == $('#'+previous_id).attr("id")){
            //點擊同一個id改變排序方法
            if(sort_by == "ASC"){
                $(this).children().attr("src","/back//Content/img/images/up-arrow.png");
                sort_by = "DESC";
            }else{
                $(this).children().attr("src","/back//Content/img/images/down-arrow.png");
                sort_by = "ASC";
            }
        }else{
            //點擊不同的id改變排序對象
            $('#'+previous_id).css("background","#fff");
            $('#'+previous_id).children().remove();
            previous_id = $(this).attr("id");
            $(this).css("background","#dbe8f3");
            $(this).append('<img src="/back//Content/img/images/down-arrow.png" style = "margin: 0 5px 2px;" alt="">');
            sort_by = "ASC";
        }
        $.ajax({
            type: "GET",
            url: "/back/index.php?action=ProductList&controller=Home",
            data: {"sort_name":previous_id,"sort_by":sort_by},
            dataType: "text",
            success: function (response) {
                location.reload();
            }
        });
    });
</script>
