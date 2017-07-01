    @extends('common')

    @section('body')
    <!-- Header -->
    <header>
        <div class="container">
            <div style="margin-top:0%">
            <h2 class="title text-center">Make your payment</h2>
            <div style="padding:10px;">
                <div>
                    <div style="width:50%; float:left;">
                        <label class="label" style="color:chocolate; float:right; font-size:22px; font-weight: bold;">Merchant bKash no:</label>
                    </div>
                    <div style="width:50%; float:left; color:black;">
                        <label class="label" style="color:brown;float:left; font-size:22px; font-weight: bold;">017########</label>
                    </div>
                </div>

                <div>
                    <div style="width:50%; float:left;">
                        <label class="label" style="color:chocolate; float:right; font-size:22px; font-weight: bold;">Your reference no:</label>
                    </div>
                    <div style="width:50%; float:left; color:black;">
                        <label class="label" style="color:brown;float:left; font-size:22px; font-weight: bold;">{{$ref}}</label>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-top:100px;">
                <img src="img/bkash.png" class="img-rounded"/></div>
            </div>
        </div>
    </header>
    @endsection