<div class="col-md-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-products-->
            @for($i=0;$i<$cat_len;$i++)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cat[$i]->id}}">
                            @if($corSubCatCnt[$i] != 0)
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            @endif
                            <a href="prd_page_with_specific_cat?category={{$cat[$i]->cat_name}}&sub_category=all">{{$cat[$i]->cat_name}}</a>
                        </a>
                    </h4>
                </div>

                @if($corSubCatCnt[$i] != 0)
                <div id="{{$cat[$i]->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @for($j=0;$j<$corSubCatCnt[$i];$j++)
                            <li><a href="prd_page_with_specific_cat?category={{$cat[$i]->cat_name}}&sub_category={{$corSubCat[$i][$j]}}">{{$corSubCat[$i][$j]}}</a></li>
                            @endfor
                        </ul>
                    </div>
                </div>
                @endif
            </div>

            @endfor
        </div><!--/category-products-->

    </div>
</div>