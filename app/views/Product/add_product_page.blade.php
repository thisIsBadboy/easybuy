@extends('common')

@section('body')
<div class="container">    

    <div style="margin-top:0%; margin-bottom:5%" class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info">   

            <div style="padding-top:3%;" class="panel-body" >

                <form class="form-horizontal" role="form" method="post" action="new_product" enctype="multipart/form-data">

                    <div class="form-group" style="text-align:center;">
                        <div class="col-md-12">
                            <label><img id="profileImage" class="img-thumbnail" style="width:150px; height:150px;" src="img/blank.jpg" />
                            <input style="display:none" id="inputImage" type="file" access="image/*" class="file" name="file" data-filename-placement="image upload" ></label>
                        </div>        
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <select style="height:50px;" class="form-control productCategory" name="category">
                                @foreach($cat as $item)
                                <option onclick="dependencyCategory('{{$item->cat_name}}')">{{$item->cat_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <select style="height:50px;" class="form-control productSubCategory" name="sub_cat">
                            
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" style="height:50px;" class="form-control" name="product_name" placeholder="Product Name" >
                            @if($errors->has('product_name'))
                            @foreach($errors->get('product_name') as $e)
                            <label class="label label-danger">{{$e}}</label>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control" name="description" placeholder="Description" ></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control" name="features" placeholder="Features" ></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" style="height:50px;" class="form-control" name="no_of_item" placeholder="Number of Item" >
                            @if($errors->has('no_of_item'))
                            @foreach($errors->get('no_of_item') as $e)
                            <label class="label label-danger">{{$e}}</label>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" style="height:50px;" class="form-control" name="price" placeholder="Price" >
                            @if($errors->has('price'))
                            @foreach($errors->get('price') as $e)
                            <label class="label label-danger">{{$e}}</label>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <div style="color:grey; float:left;"><input name="latest" type="checkbox"/><span style="margin-left:5px; font-weight:bold;">Latest</span></div>
                        </div>
                        <div class="col-md-6">
                            <div style="color:grey; float: right;">
                                <select style="height:30px; width:50px;" name="off">
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

                    <div class="form-group" style="text-align:center;">                                      
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">ADD PRODUCT</button>
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

    if($("#percentCheck").attr('checked'))
        alert('checked');
</script>

@endsection