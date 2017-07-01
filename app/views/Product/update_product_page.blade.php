@extends('common')

@section('body')
<div class="container">    

    <div style="margin-top:0%; margin-bottom:5%" class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info">
            <!-- <div class="panel-heading">
                <div class="panel-title">Update Product</div>
            </div>   -->   

            <div style="padding-top:3%;" class="panel-body" >
                <form class="form-horizontal" role="form" method="post" action="updated_product{{$prd->id}}" enctype="multipart/form-data">
                    <div style="text-align:center;" class="form-group">
                        <div class="col-md-12">
                            <label><img id="profileImage" class="img-thumbnail" style="width:150px; height:150px;" src="img/{{$prd->product_image}}" />
                            <input style="display:none" id="inputImage" type="file" access="image/*" class="file" name="file" data-filename-placement="image upload" ></label>
                        </div>        
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <select id="category" style="height:50px;" class="form-control productCategory" name="category">
                                @foreach($cat as $item)
                                <option onclick="dependencyCategory('{{$item->cat_name}}')">{{$item->cat_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <select id="sub-category" style="height:50px;" class="form-control productSubCategory" name="sub_cat">
                                @foreach($sub_cat as $item)
                                @if($item->cat_name == $prd->category)
                                <option>{{$item->sub_cat_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input style="height:50px;" value="{{$prd->product_name}}" type="text" class="form-control" name="product_name" placeholder="Product Name" >
                            @if($errors->has('product_name'))
                            @foreach($errors->get('product_name') as $e)
                            <label class="label label-danger">{{$e}}</label>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control" name="description" placeholder="Description">{{$prd->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control" name="features" placeholder="Features">{{$prd->features}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input style="height:50px;" value="{{$prd->no_of_item}}" type="text" class="form-control" name="no_of_item" placeholder="Number of Item" >
                            @if($errors->has('no_of_item'))
                            @foreach($errors->get('no_of_item') as $e)
                            <label class="label label-danger">{{$e}}</label>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input style="height:50px;" value="{{$prd->real_price}}" type="text" class="form-control" name="price" placeholder="Price" >
                            @if($errors->has('price'))
                            @foreach($errors->get('price') as $e)
                            <label class="label label-danger">{{$e}}</label>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <div style="color:grey; float:left;"><input name="latest" type="checkbox" @if($prd->latest == 1) checked @endif/><span style="margin-left:5px; font-weight:bold;">Latest</span></div>
                        </div>
                        <div class="col-md-6">
                            <div style="color:grey; float:right;">
                                <select style="height:30px; width:50px;" id="offPercent" name="off">
                                    <script type="text/javascript">
                                        for(var i=0;i<100;i++){
                                            document.write("<option value='"+i+"'>"+i+"</option>");
                                        }
                                    </script>
                                </select>
                                <label>% off</label>
                            </div>
                        </div>
                    </div>

                    <div style="text-align:center;" class="form-group">                                      
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success" style="width:150px;">Update</button>
                        </div>
                    </div>
                </form>
            </div> 

        </div>  
    </div>
</div>

<script type="text/javascript">
    document.getElementById('inputImage').addEventListener('change', setImage, false);

    function setImage(event){
        var files = event.target.files;
        var fileName = files[0].name;
        var tmpPath = URL.createObjectURL(event.target.files[0]);
        $('#profileImage').attr('src', tmpPath);
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#category").val("<?php echo $prd->category; ?>");
        $("#sub-category").val("<?php echo $prd->sub_category; ?>");
        $("#offPercent").val("<?php echo $prd->off; ?>");
    });
</script>

@endsection