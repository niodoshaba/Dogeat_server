$(document).ready(function () {
    ProductListFunctionReady();
});


//上傳檔案一變動就更新預覽圖片
$(".product_url").change(async function () {
    await verificationPicFile(this);
});
//預覽圖片
async function readURL(input){ 
    return new Promise(resolve => {
        if(input.files && input.files[0]){
            let reader = new FileReader();
            reader.onload = function (e) {
                $(input).next().children("img").attr('src', e.target.result);
                $(input).next().children("input").attr('value', e.target.result);
                resolve();
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
}
//圖片尺寸驗證
function verificationPicFile(file) {
    return new Promise(resolve => {
        var filePath = file.value;
        if(filePath){
            //讀取圖片數據
            var filePic = file.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                var data = e.target.result;
                //加載圖片獲取圖片真實寬度和高度
                var image = new Image();
                image.onload=async function(){
                    var width = image.width;
                    var height = image.height;
                    if (width ==  height){
                        alert("文件尺寸符合！");
                        await readURL(file);
                        resolve();
                    }else{
                        alert("文件尺寸長寬需相等！");
                        await readURL(file);
                        resolve();
                    }
                };
                image.src= data;
            };
            reader.readAsDataURL(filePic); 
        }else{
            return false;
        }
    });
}
//設成全域變數
let vanilla;
//點擊渲染圖片
function renderingpicture(picture){
    let el = document.getElementById('demo');
    vanilla = new Croppie(el, {
        viewport: { width: "", height: ""},
        boundary: { width: 300, height: 300 },
        showZoomer: true,
    });
    vanilla.bind({
        url: $(picture).attr("src"),
        orientation: 4
    });
    $(".cr-overlay").attr("style",'width: 266.342px; height: 199.93px; top: 38.0659px; left: 6.83209px;');
    $("#temp_img").attr("value",$(picture).attr("id"));
}
//點擊後裁切圖片
$('.cutpicture').click(function () {
    vanilla.result({
        type: 'base64'
    }).then(function (base64) {
        if(vanilla.options.viewport.width == undefined){
            alert("請輸入裁剪尺寸");
        }else{
            if(parseInt($("#cutSize").val()) > parseInt($(".cr-overlay").css("width").split("px")[0]) ){
                alert("裁剪框不得小於圖片尺寸");
            }else{
                $('#'+$("#temp_img").attr("value")).next().attr("value",base64);
                $('#'+$("#temp_img").attr("value")).attr("src",base64);
                alert("裁剪成功");
            }
        }
    });
});
function ProductListFunctionReady(){
//放大預覽
$(".product_picture").click(function () {
    if(vanilla){
        vanilla.destroy();
    }
    if($(this).attr("src") != ""){
        $("#edit_picture").css("display","flex");
        renderingpicture(this);
    }else{
        alert("請先上傳");
    }
});
$("#cutSize").bind("input propertychange",function () {
    let cutSize = $("#cutSize").val();
    $(".cr-vp-square").css("width",cutSize);
    $(".cr-vp-square").css("height",cutSize);
});
//編輯按鈕
$(".edit_btn").click(function(){
    $("#update_box").css("display","flex");
    $("#upload").css("display", "none");
    $(".edit_btn").attr("disabled", true); //disabled其他編輯鈕
    $(".delete_btn").attr("disabled", true); //disabled其他刪除鈕
    let pro_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url: "/dogeat_server/index.php?action=showProductInformation&controller=BackStageProductControllers",
        data: {pro_id:pro_id},
        dataType: "json",
        success: function (response) {
            $("#product_num").attr("value",response["pro_no"]);
            $("#product_name").attr("value",response["pro_name"]);
            $("#product_price").attr("value",response["pro_price"]);
            let pro_all_info = JSON.parse(response["pro_all_info"]);
            $("#product_info").val(pro_all_info["pro_info"]);
            $("#product_element").attr("value",pro_all_info["product_element"]);
            $("#product_content").attr("value",pro_all_info["product_content"]);
            let pro_deadtime = pro_all_info["pro_deadtime"].split("、");
            $("#product_refrigeration").find("option[value = '"+pro_deadtime[0]+"']").attr("selected","selected");
            $("#product_freezing").find("option[value = '"+pro_deadtime[1]+"']").attr("selected","selected");
            $("#product_status").find("option[value = '"+response["pro_status"]+"']").attr("selected","selected");
            $("#product_catalog").find("option[value = '"+response["cata_no"]+"']").attr("selected","selected");
            $("#product_catalog,#product_status,#product_refrigeration,#product_freezing").trigger("change");
            let pro_all_img = JSON.parse(response["pro_img"]);
            $("#old_img_01").val(pro_all_img["img_01"]);
            $("#old_img_02").val(pro_all_img["img_02"]);
            $("#old_img_03").val(pro_all_img["img_03"]);
            $("#old_img_04").val(pro_all_img["img_04"]);
        }
    });

}) 
//新增資料的燈箱按下送出
$("#add_btn").click(function () {
    $("#update_box").css("display","flex");
    $("#pro_num").css("display","none");
    $("#edit_sql_but").css("display", "none");
});
}
function determine(statue){
    let picture_size_conform;
    let err_picture;
    let img = [document.getElementById('tmp_base64_01'),document.getElementById('tmp_base64_02'),document.getElementById('tmp_base64_03'),document.getElementById('tmp_base64_04')];
    for(let i=0;i<4;i++){
        if(img[i].naturalWidth == img[i].naturalHeight){
            picture_size_conform = true;
        }else{
            picture_size_conform = false;
            err_picture = i+1;
            break;
        }
    }
    if(picture_size_conform){
        if(statue == "edit_sql"){
            $("#form").attr("action","/dogeat_server/index.php?action=updateProduct&controller=BackStageProductControllers");
        }else{
            $("#form").attr("action","/dogeat_server/index.php?action=addProduct&controller=BackStageProductControllers");
        }
        $("#form").submit();
    }else{
        alert("第"+err_picture+"張圖片尺寸不合");
    }
}

//取消編輯
$("#close_update_box").click(function () {
    location.reload()
});

      