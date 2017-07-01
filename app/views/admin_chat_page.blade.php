@extends('common')

@section('body')

    <div class="container">    
        <div style="margin-top:0%;" class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">

                <div class="panel-heading">
                    <div class="panel-title">To {{$userName}}</div>
                </div>

                <div class="panel-body" >
                    <div id="messageBox" style="height:250px; overflow:auto;"></div>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-9">
                            <textarea id="message" class="form-control" placeholder="Enter your message..."></textarea>&nbsp;
                        </div>
                        <div class="col-md-3"><input id="send" type="button" class="form-control btn btn-default" value="Send"></div>
                    </div>
                </div>

            </div>      
        </div> 
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        var userId = <?php echo $userId; ?>;
        var userName = "<?php echo Auth::user()->first_name; ?>";

        setInterval(function(){
            $.ajax({
                type:"POST",
                url:'get_message',
                data:{'userId':userId, 'sender':'user'},
                dataType:'json',
                success: function(data){
                    var count = data.length;
                    var msg = "";
                    for(var i=0;i<count;i++){
                        if(data[i]['sender']=='user')
                            msg += "<label style='font-size:15px; color:orange;'>"+data[i]['user_name']+": "+data[i]['message']+"</label><br />";

                        if(data[i]['sender']=='admin')
                            msg += "<label style='font-size:15px; color:green;'>"+data[i]['user_name']+": "+data[i]['message']+"</label><br />";
                    }

                    $("#messageBox").html(msg);
                }
            });
        }, 1000);

        $("#send").click(function(){
            var message = $("#message").val().trim();
            
            if(message!=""){
                    
                $.ajax({
                      type: "POST",
                      url: 'send_to_admin', 
                      data: {'userId': userId, 'userName':userName, 'message':message, 'status':'not seen', 'sender':'admin'},
                      success: function(data){
                        //alert(data);
                        document.getElementById("message").value = "";
                      }
                });
            }
            
        });
    });
    </script>

@endsection
