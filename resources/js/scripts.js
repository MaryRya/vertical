
$('#file-upload').change(function (event){
    var tmp_url = window.URL.createObjectURL(event.target.files[0]);
    $("#img").attr("src", tmp_url);
});

function check(){
    if(document.getElementById("all_reviews").style.display === "none"){
        document.getElementById("all_reviews").style.display = "block";
        document.getElementById("reviews_all").textContent = "Скрыть отзывы";
    }
    else{
        document.getElementById("all_reviews").style.display = "none";
        document.getElementById("reviews_all").textContent = "Показать все отзывы";
    }
}

var count_r = document.getElementById("count");
if(count_r != null)
{
    count_r.oninput = function() {
        var count = document.getElementById("count").value;
        if(count > 5){
            document.getElementById("count").value = 5;
        }
    };
}
var price_lesson = document.getElementById("price");
if(price_lesson != null)
{
    price_lesson.oninput = function() {
        var price = document.getElementById("price").value;
        if(price > 2000){
            document.getElementById("price").value = 2000;
        }
    };
}

function ajaxAction(response){//записаться на занятие

    if(response.data[0].hall_name !== undefined){
        document.getElementById("hall").value  = response.data[0].hall_name;
    }
    var dall = document.getElementById("description_all");
    if(dall)
    {
        dall.innerHTML  = response.data[0].lesson_description_all;
    }
    document.getElementById("description").innerHTML  = response.data[0].lesson_description;
    document.getElementById("price").value  = response.data[0].lesson_price;
    document.getElementById("id_schedule").value  = response.data[0].id_schedule;
    var things = document.getElementById("things");
    if(things){
        things.value = response.data[0].things;
    }
    document.getElementById("coach").value  = response.data[0].name;
    document.getElementById("count").value  = response.data[0].count_place;
    document.getElementById("time").value  = response.data[0].start_time.slice(0, 5) + " - "
        +response.data[0].end_time.slice(0, 5);
    document.getElementById("id_time").value  = response.data[0].id_time_lesson;
    document.getElementById("date_r").value  = response.data[0].date_lesson;
    document.getElementById("id_users").value  = response.data[0].id_users;
    if(response.data[0].date_lesson < getNowDate()){
        document.getElementById("sub_z").style.display = "none";
    }
    if(response.data[0].count_place <= 0){
        document.getElementById("sub_z").setAttribute('disabled','');
    }
}

function terms_check(id, token){
    let ckeckd = document.getElementById("check_"+id);
    var ckeck_value = 0;
    if (ckeckd.checked){
        ckeck_value = 1;
    }
    else{
        ckeck_value = 0;
    }
    $.ajax({
        url: "/ajax-check",
        type:"POST",
        data:{
            "_token": token,
            id:id,
            ckeck_value:ckeck_value
        },
        success:function(response){
            if(response !== 500){
                if (response.data === 1){
                    window.location = "/attendance";
                }
            }
        },
    });
}

function checkDesc(){
    if(document.getElementById("desc_all_show").style.display === "none"){
        document.getElementById("desc_all_show").style.display = "block";
        document.getElementById("desc_all_hide").innerText = "Скрыть описание";
    }
    else{
        document.getElementById("desc_all_show").style.display = "none";
        document.getElementById("desc_all_hide").innerText = "Показать описание";
    }
}
if(document.getElementById("date_shd") != null)
    document.getElementById("date_shd").min = new Date().toISOString().split("T")[0];


function ChatGetAjax1(response){
    return '<div class="mt-2 mb-10 flex justify-end mr-1"><input id="answer" readonly name="answer" class="block w-[600px]  rounded-md bg-indigo-100 text-gray-900 shadow-sm  sm:p-1.5 sm:text-sm sm:leading-6" value="'+response.question+'"></div>';
}
function ChatGetAjax2(response){
    return '<div class="mt-2 flex mb-10 justify-start ml-1"><input id="answer" readonly name="answer" class="block w-[600px] rounded-md bg-[#7179b9] text-white shadow-sm ring-1 sm:p-1.5 sm:text-sm sm:leading-6" value="'+response.answer+'"></div>';
}

function DeleteSchedule(token){
    var id_schedule = document.getElementById("id_schedule").value;
    $.ajax({
        url: "/ajaxDeleteSchedule",
        type:"POST",
        data:{
            "_token": token,
            id_schedule:id_schedule,
        },
        success:function(response){
            if(response !== 500){
                window.location = "/schedule";
            }
        },
    });
}

function getNowDate(){
    var now_date = new Date();
    var m = "";
    var d = "";
    if((now_date.getMonth() + 1) < 10){
        m = "0"+ (now_date.getMonth() + 1);
    }
    else{
        m = now_date.getMonth() + 1;
    }
    if(now_date.getDate() < 10){
        d = "0"+ now_date.getDate();
    }
    else{
        d = now_date.getDate();
    }
    var full_date = now_date.getFullYear() + "-" + m + "-" + d;
    return full_date;
}
