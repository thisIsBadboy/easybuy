<script type="text/javascript">
$(document).ready(function(){

    /************** Sign In *************/
    $("#btnLogin").click(function(){
        var flag = false;
        if($("#login-remember").is(":checked")){
            flag = true;
        }

        $.ajax({
            type: "POST",
            url: 'login', 
            data: {'user_name': $("#login-username").val(), 'password': $("#login-password").val(), 'flag': flag},
            success: function(data){
                if(data == 'true'){
                    $("#lblError").html("");
                    window.location = "/";
                }

                if(data == 'false'){
                    $("#lblError").html("Invalid username or password<br/>");
                }
            }
        });
    });
    /************************************/

    /************** Forgot Password *************/
    $("#btnForgotPass").click(function(){
        
        if($("#forgotPass").val() == ""){
            $("#divForgotPass").addClass('has-error');
        }else{
            $("#divForgotPass").removeClass('has-error');

            $.ajax({
                type: "POST",
                url:  'forgot_password', 
                data: {'email':$("#forgotPass").val()},
                success: function(data){
                    alert(data);
                    if(data == 'true'){

                    }

                    if(data == 'false'){
                        
                    }
                }
            });
        }
    });
    /************************************/

    /********** Count Message **********/
    @if(Auth::user())   
    var user = "<?php echo Auth::user()->check_user; ?>";

    if(user == "yes"){
        setInterval(function(){
            $.ajax({
                type:"POST",
                url: 'count_admin_message',
                data:{ },
                dataType:'json',
                success:function(data){
                    var count = data.length, str = "";
                    $("#msgCount").html(count);
                    for(var i=0;i<count;i++)    
                        str += '<li style= "padding-left:20px; padding-right:20px;"><a href="reply'+data[i]['user_id']+'" style="color:#FEC50D;">'+data[i]['user_name']+'<span id="msgCount" class="badge">'+data[i]['total']+'</span></a></li>';
                    $("#sentMsgList").html(str);
                }
            });
        }, 1000);
    }
    @endif
    /********************************/

    /************** Button Action ***************/
    /***********   
    *   res[0] = Button Action Name
    *   res[1] = ID of the Button
    ************/

    $("button").click(function(){
        var res = this.id.split("-");
        if(res[0] == "AddToCart"){   /* Add To Cart */
            $.ajax({
                type: "POST",
                url: 'add_to_cart', 
                data: {'id': res[1]},
                success: function(data){
                    $("#cart").html(data);
                }
            });
        }else if(res[0] == "RemoveFromCart"){    /* Remove From Cart */
            var label = document.getElementById("label"+res[1]);
            var price = document.getElementById("price"+res[1]);
            var div = document.getElementById("div"+res[1]);

            $.ajax({
                type: "POST",
                url: 'remove_from_cart', 
                data: {'rowid': res[1]},
                success: function(data){
                    label.innerHTML = data['qty'];
                    price.innerHTML = "TK"+data['subtotal'];
                    $("#cart").html('<img src="img/icon/cart.png" style="width: 50px;"> '+data['count']);
                    $("#totalPrice").html("TK"+data['totalPrice']);
                    var total = parseInt(data['totalPrice'])+50;
                    if(total == 50){
                        $("#shippingCost").html("TK0");
                        $("#priceWithShipping").html("TK0");
                    }else{
                        $("#priceWithShipping").html("TK"+total);
                    }
                    if(data['qty'] == 0){
                        div.style.display = 'none';
                    }

                    if(data['totalPrice']==0){
                        $("#btnClearCart").addClass('disabled');
                        $("#btnOrder").addClass('disabled');
                        $("#pnl-body").html('<h1>Your cart is empty!!!</h1>');
                    }
                }
            });
        }else if(res[0] == "ChangePaymentStatus"){   /* Change Payment Status */
            if(confirm("Are you sure???")){
                $.ajax({
                    type: "POST",
                    url : 'change_payment_status',
                    data: {'id': res[1]},
                    success: function(data) {
                        if(data == 0){
                            $("#ChangePaymentStatus-"+res[1]).removeClass('btn-danger');
                            $("#ChangePaymentStatus-"+res[1]).addClass('btn-success');
                            $("#ChangePaymentStatus-"+res[1]).val('Paid');
                        }else{
                            $("#ChangePaymentStatus-"+res[1]).removeClass('btn-success');
                            $("#ChangePaymentStatus-"+res[1]).addClass('btn-danger');
                            $("#ChangePaymentStatus-"+res[1]).val('Not paid');
                        }
                    }
                });
            }
        }   
    });
    /*****************************************/

    $("a").click(function(){
        var res = this.id.split("-");
        if(res[0] == "AddToCart"){   /* Add To Cart */
            var price = document.getElementById("price"+res[1]);
            var div = document.getElementById("div"+res[1]);
            var box = document.getElementById("box-"+res[1]);

            $.ajax({
                type: "POST",
                url: 'add_to_cart_by_plus', 
                data: {'rowid': res[1]},
                success: function(data){
                    box.value = data['qty'];
                    price.innerHTML = "Sub Total = TK"+data['subtotal'];
                    $("#cart").html(data['count']);
                    $("#totalPrice").html("TK"+data['totalPrice']);
                    var total = parseInt(data['totalPrice'])+50;
                    if(total == 50){
                        $("#shippingCost").html("TK0");
                        $("#priceWithShipping").html("TK0");
                    }else{
                        $("#priceWithShipping").html("TK"+total);
                    }
                    if(data['qty'] == 0){
                        div.style.display = 'none';
                    }

                    if(data['totalPrice']==0){
                        $("#btnClearCart").addClass('disabled');
                        $("#btnOrder").addClass('disabled');
                        $("#pnl-body").html('<h1>Your cart is empty!!!</h1>');
                    }
                }
            });
        }else if(res[0] == "RemoveFromCart"){    /* Remove From Cart */
            //var label = document.getElementById("label"+res[1]);
            var price = document.getElementById("price"+res[1]);
            var div = document.getElementById("div"+res[1]);
            var box = document.getElementById("box-"+res[1]);

            if(parseInt(box.value)>1){

                $.ajax({
                    type: "POST",
                    url: 'remove_from_cart', 
                    data: {'rowid': res[1]},
                    success: function(data){
                        //label.innerHTML = data['qty'];
                        box.value = data['qty'];
                        price.innerHTML = "Sub Total = TK"+data['subtotal'];
                        $("#cart").html(data['count']);
                        $("#totalPrice").html("TK"+data['totalPrice']);
                        var total = parseInt(data['totalPrice'])+50;
                        if(total == 50){
                            $("#shippingCost").html("TK0");
                            $("#priceWithShipping").html("TK0");
                        }else{
                            $("#priceWithShipping").html("TK"+total);
                        }
                        if(data['qty'] == 0){
                            div.style.display = 'none';
                        }

                        if(data['totalPrice']==0){
                            $("#btnClearCart").addClass('disabled');
                            $("#btnOrder").addClass('disabled');
                            $("#pnl-body").html('<h1>Your cart is empty!!!</h1>');
                        }
                    }
                });
            }
        }  
    });

    /*********** Add New Category *************/
    $("#btnAddCategory").click(function(){
        if($("#category").val().trim() == ""){

        }else{
            $.ajax({
                type: "POST",
                url: 'addCategory', 
                data: {'category': $("#category").val()},
                success: function(data){
                    if(data == 1)
                        location.reload();

                    else
                        alert(data);
                }
            });
        }
    });
    /****************************************/

    /*********** Add New SubCategory *************/
    $("#btnAddSubCategory").click(function(){
        if($("#sub-cat").val().trim() == ""){

        }else{

            $.ajax({
                type: "POST",
                url: 'add_sub_category', 
                data: {'cat': $("#cat").val(), 'sub-cat': $("#sub-cat").val()},
                success: function(data){
                    //alert(data);

                    if(data != 0)
                        location.reload();

                    else
                        alert("Something went wrong!!");
                }
            });
        }
    });
    /****************************************/

    /********** Show Product Detail ************/
    $("a").click(function(){
        var res = this.id.split("-");
        if(res[0] == "ProductDetail"){
            $.ajax({
                type: "GET",
                url: 'show_datail', 
                data: {'id': res[1]},
                success: function(data){
                    $("#reviewProductId").val(res[1]);
                    $("#prdName").html(data['name']);
                    $("#productImage").attr('src', "img/"+data['image']);
                    if(data['description'].trim() != ""){
                        $("#productDescription").html(data['description']);
                        $("#div-productDescription").show();
                    }else{
                        $("#div-productDescription").hide();
                    }

                    if(data['features'].trim() != ""){
                        $("#productFeatures").html("<pre style='background:white; border:0px; padding:0px;'>"+data['features']+"</pre>");
                        $("#div-productFeatures").show();
                    }else{
                        $("#div-productFeatures").hide();
                    }

                    $("#prd-reviews").html(data['review']);
                }
            });
        }
    });
    /*******************************************/

    
    /********** Profile Change ***************/
    @if(Auth::user())
    
    $("#btnSaveName").click(function(){
        var id = <?php echo Auth::user()->id; ?>;

        if($("#firstName").val().trim() == ""){

        }else if($("#lastName").val().trim() == ""){

        }else{
            $.ajax({
                type: "POST",
                url: 'changeName', 
                data: {'id': id,'first_name': $("#firstName").val(), 'last_name': $("#lastName").val()},
                success: function(data){
                    if(data == 1)
                        location.reload();
                    else
                        alert(data);
                        //$("#lblError").html("Invalid username or password<br/>");
                }
            });
        }
    });

    $("#btnSaveUsername").click(function(){
        var id = <?php echo Auth::user()->id; ?>;

        if($("#userName").val().trim() == ""){

        }else{
            $.ajax({
                type: "POST",
                url: 'changeUsername', 
                data: {'id': id,'user_name': $("#userName").val()},
                success: function(data){
                    if(data == 1)
                        location.reload();
                    else
                        alert(data);
                        //$("#lblError").html("Invalid username or password<br/>");
                }
            });
        }
    });

    $("#btnSaveEmail").click(function(){
        var id = <?php echo Auth::user()->id; ?>;

        if($("#email").val().trim() == ""){

        }else{
            $.ajax({
                type: "POST",
                url: 'changeEmail', 
                data: {'id': id,'email': $("#email").val()},
                success: function(data){
                    if(data == 1)
                        location.reload();
                    else
                        alert(data);
                        //$("#lblError").html("Invalid username or password<br/>");
                }
            });
        }
    });

    $("#btnSavePassword").click(function(){
        var id = <?php echo Auth::user()->id; ?>;

        if($("#oldPassword").val().trim() == ""){

        }else if($("#newPassword").val().trim() == ""){

        }else{
            $.ajax({
                type: "POST",
                url: 'changePassword', 
                data: {'id': id,'old_password': $("#oldPassword").val(), 'new_password': $("#newPassword").val()},
                success: function(data){
                    if(data == 1)
                        location.reload();
                    else
                        alert(data);
                        //$("#lblError").html("Invalid username or password<br/>");
                }
            });
        }
    });

    $("#btnSavePhone").click(function(){
        var id = <?php echo Auth::user()->id; ?>;

        if($("#phone").val().trim() == ""){

        }else{
            $.ajax({
                type: "POST",
                url: 'changePhone', 
                data: {'id': id,'contact': $("#phone").val()},
                success: function(data){
                    if(data == 1)
                        location.reload();
                    else
                        alert(data);
                        //$("#lblError").html("Invalid username or password<br/>");
                }
            });
        }
    });

    @endif
    /*****************************************/

    /************* Clear Cart ****************/
    $("#btnClearCart").click(function(){
        $.ajax({
            type: "POST",
            url : 'clear_cart',
            data: {},
            success: function(data){
                if(data = 1){
                    location.reload();
                }

                else{
                    alert("Something went wrong!!!");
                }
            }
        });
    });
    /*****************************************/

    /**************** Payment ****************/

    $("#bkashRadio").click(function(){
        $("#lblMob").html("Payment Mobile Number");
    });

    $("#cashOnDeliveryRadio").click(function(){
        $("#lblMob").html("For Contact");
    });

    $("#btnProceed").click(function(){
        var requiredField = ["orderMobile", "orderAddressLine1", "orderUpazilla", "orderDistrict"];
        var flag = true, len = requiredField.length;
        var error = new Array(), success = new Array();

        for(var i=0, j=0, k=0; k<len; k++){
            if($("#"+requiredField[k]).val().trim() == ""){
                flag = false;
                error[i++] = requiredField[k];
            }else{
                success[j++] = requiredField[k];
            }
        }

        len = error.length;

        for(var k=0; k<len;k++){
            $("#div-"+error[k]).removeClass("has-success");
            $("#div-"+error[k]).addClass("has-error");
        }

        len = success.length;

        for(var k=0; k<len;k++){
            $("#div-"+success[k]).removeClass("has-error");
            $("#div-"+success[k]).addClass("has-success");
        }        

        if(flag){
            var method = "Cash On Delivery";

            if($("#bkashRadio").is(':checked')){
                method = "bKash";
            }

            var mobile = $("#orderMobile").val().trim();
            var addressLine1 = $("#orderAddressLine1").val();
            var upazilla = $("#orderUpazilla").val();
            var district = $("#orderDistrict").val();

            $.ajax({
                type: "POST",
                url : 'order_item',
                data: {'payment_method':method, 'mobile':mobile, 'address_line_1':addressLine1, 'upazilla':upazilla, 'district':district},
                success: function(data) {
                    if(data == 'not logged in'){
                        $("#myModalForPaymentMethod").modal('hide');
                        $("#myModalForLoggedMsg").modal('toggle');
                    }else{
                        //alert(data);
                        window.location.href = '/my_order/';
                    }
                }
            });
        }
    });
    /*****************************************/

    /******************Feedback******************/
    $("#btnFeedback").click(function(){
        var requiredField = ["feedbackName", "feedbackEmail", "feedbackMobile", "feedbackText"];
        var flag = true, len = requiredField.length;
        var error = new Array(), success = new Array();

        for(var i=0, j=0, k=0; k<len; k++){
            if($("#"+requiredField[k]).val().trim() == ""){
                flag = false;
                error[i++] = requiredField[k];
            }else{
                success[j++] = requiredField[k];
            }
        }

        len = error.length;

        for(var k=0; k<len;k++){
            $("#div-"+error[k]).removeClass("has-success");
            $("#div-"+error[k]).addClass("has-error");
        }

        len = success.length;

        for(var k=0; k<len;k++){
            $("#div-"+success[k]).removeClass("has-error");
            $("#div-"+success[k]).addClass("has-success");
        }

        if(flag){
            var name =$("#feedbackName").val().trim();
            var email = $("#feedbackEmail").val().trim();
            var mobile = $("#feedbackMobile").val().trim();
            var feedbackText = $("#feedbackText").val().trim();

            var feedbackStatus = "";
            if($("#feedbackStatus1").is(":checked")){
                feedbackStatus = "Satisfied";
            }else if($("#feedbackStatus2").is(":checked")){
                feedbackStatus = "Not satisfied";
            }

            $.ajax({
                type: "POST",
                url : 'submit_feedback',
                data: {'name':name, 'email':email, 'mobile':mobile, 'feedback_status':feedbackStatus, 'feedback_text':feedbackText},

                success: function(data) {
                    if(data == 'success'){
                        window.location.href = '/feedback/';
                    }else{
                        alert(data);
                    }
                }
            });
        }
    });
    /********************************************/

    $("#message").click(function(){
        var element = document.getElementById("messageBox");
        element.scrollTop = element.scrollHeight;
    });
});
</script>