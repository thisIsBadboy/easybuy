<script type="text/javascript">
function dependencyCategory(cat){
	$(document).ready(function(){
		$.ajax({
			type: "POST",
			url : 'get_sub_category',
			data: {'cat': cat},
			async: false,
			success: function(data){
				var res = JSON.parse(data);

				$(".productSubCategory").empty();
				var len = res.length;

				for(var i=0; i<len; i++){
					$(".productSubCategory").append($('<option>', {
						value: res[i].sub_cat_name,
						text : res[i].sub_cat_name
					}));
				}
			}
		});
	});
}

////******************Cart related***********////
function validateCartInput(id, ev){
    var key = ev.keyCode||ev.which||ev.charCode;
    
    if(((key>=8 && key<=57) && key != 32)){
        return true;
    }
    return false;;
}

function addToCartByHand(id){
    $(document).ready(function(){
        var num = $("#"+id).val();

        if(Number(num) != 0){
            var res = id.split("-");
            if(res[0] == "box"){   /* Add To Cart */
                var price = document.getElementById("price"+res[1]);
                var div = document.getElementById("div"+res[1]);
                var box = document.getElementById("box-"+res[1]);

                $.ajax({
                    type: "POST",
                    url: 'add_to_cart_by_hand', 
                    data: {'rowid': res[1], 'item':num},
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
            }
        }
    });
}

function removeFromCartByCross(rowid){
    $(document).ready(function(){

        var div = document.getElementById("div"+rowid);

        $.ajax({
            type: "POST",
            url: 'remove_from_cart_by_cross', 
            data: {'rowid': rowid},
            success: function(data){
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
    });
}
////*****************************************////

////*************Set Delete Reference ****************////
function setDeleteReference(ref){
    $(document).ready(function(){
        $("#deleteConfirmation").attr('href', ref);
    });
}
///////*****************************************//////////

function changeRatingStar(num){
	$(document).ready(function(){
		var i=1;
		$("#rating").val(num);
		$("#reviewRating").children('img').each(function(){
			if(i<=num){
				this.src = 'images/product-details/star-select.png';
			}else{
				this.src = 'images/product-details/star.png';

			}
			i++;
		});
	});
}

////////************Zoom***************/////
function zoom(obj){
    $(document).ready(function(){
        $("#zoom-image").attr('src', obj.src);
        $("#zoom-image").show();
    });
}

$(document).ready(function(){
	/******************Review******************/
    $("#btnReview").click(function(){
        var requiredField = ["reviewName", "reviewEmail", "reviewText"];
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
        	var pid = $("#reviewProductId").val().trim();
            var name =$("#reviewName").val().trim();
            var email = $("#reviewEmail").val().trim();
            var reviewText = $("#reviewText").val().trim();
            var rating = $("#rating").val().trim();

            $.ajax({
                type: "POST",
                url : 'submit_your_review',
                data: {'pid':pid, 'name':name, 'email':email, 'review_text':reviewText, 'rating':rating},

                success: function(data) {
                    if(data == 'success'){
                        $("#myModalForReview").modal('hide');
                    }else{
                        alert(data);
                    }
                }
            });
        }
    });
    /********************************************/
});
</script>