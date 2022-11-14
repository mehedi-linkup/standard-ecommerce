@extends('layouts.website')
@section('website-css')
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> --}}
<style>
    :root {
    --primary-color: rgb(11, 78, 179)
}

*,
*::before,
*::after {
    box-sizing: border-box
}

label {
    display: block;
    margin-bottom: 0.5rem
}

input {
    display: block;
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
    height: 50px
}

.width-50 {
    width: 50%
}

.ml-auto {
    margin-left: auto
}

.text-center {
    text-align: center
}

.progressbar {
    position: relative;
    display: flex;
    justify-content: space-between;
    counter-reset: step;
    margin: 2rem 0 4rem
}

.progressbar::before,
.progress {
    content: "";
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    height: 4px;
    width: 100%;
    background-color: #dcdcdc;
    z-index: 1
}

.progress {
    background-color: rgb(0 128 0);
    width: 0%;
    transition: 0.3s
}

.progress-step {
    width: 2.1875rem;
    height: 2.1875rem;
    background-color: #dcdcdc;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1
}

.progress-step::before {
    counter-increment: step;
    content: counter(step)
}

.progress-step::after {
    content: attr(data-title);
    position: absolute;
    top: calc(100% + 0.5rem);
    font-size: 0.85rem;
    color: #666
}

.progress-step-active {
    background-color: var(--primary-color);
    color: #f3f3f3
}

.form {
    width: clamp(450px, 30%, 460px);
    margin: 0 auto;
    border: none;
    border-radius: 10px !important;
    overflow: hidden;
    padding: 1.5rem;
    background-color: #fff;
    padding: 20px 30px;
}

.step-forms {
    display: none;
    transform-origin: top;
    animation: animate 1s
}

.step-forms-active {
    display: block
}

.group-inputs {
    margin: 1rem 0
}

@keyframes animate {
    from {
        transform: scale(1, 0);
        opacity: 0
    }

    to {
        transform: scale(1, 1);
        opacity: 1
    }
}

.btns-group {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem
}

.my-btn {
    padding: 0.75rem;
    display: block;
    text-decoration: none;
    background-color: var(--primary-color);
    color: #f3f3f3;
    text-align: center;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: 0.3s
}

.my-btn:hover {
    box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color)
}

.progress-step-check {
    position: relative;
    background-color: green !important;
    transition: all 0.8s
}

.progress-step-check::before {
    position: absolute;
    content: '\2713';
    width: 100%;
    height: 100%;
    top: 8px;
    left: 13px;
    font-size: 12px
}

.group-inputs {
    position: relative
}

.group-inputs label {
    font-size: 13px;
    position: absolute;
    height: 19px;
    padding: 4px 7px;
    top: -14px;
    left: 10px;
    color: #a2a2a2;
    background-color: white
}

.welcome {
    height: 450px;
    width: 350px;
    background-color: #fff;
    border-radius: 6px;
    display: flex;
    justify-content: center;
    align-items: center
}

.welcome .content {
    display: flex;
    align-items: center;
    flex-direction: column
}

.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 2;
    stroke-miterlimit: 10;
    stroke: #7ac142;
    fill: none;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards
}

.checkmark {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #fff;
    stroke-miterlimit: 10;
    margin: 10% auto;
    box-shadow: inset 0px 0px 0px #7ac142;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both
}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0
    }
}

@keyframes scale {

    0%,
    100% {
        transform: none
    }

    50% {
        transform: scale3d(1.1, 1.1, 1)
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #7ac142
    }
}
@media screen and ( max-width: 414px ){
  .form {
  width: 300px;
  padding:10px;
  }
}
@media screen and ( max-width: 412px ){
  .form {
  width: 320px;
  padding:10px;
  }
}
@media screen and ( max-width: 320px ){
    .form {
    width: 280px;
     padding:10px;
    }
}
</style>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  
@endsection
@section('website-content')

<section class="py-3 middle-section">
    <h2 class="text-center text-success"> Checkout</h2>
    <div class="container">
        @if(Auth::guard('customer')->user()->status == 'a' && Auth::guard('customer')->user()->isVerified == '1' )
        
        @elseif(Auth::guard('customer')->user()->isVerified != '1' )
        <h4 class="text-center text-danger"> Your Account no verified</h4>
        <div class="text-center"><a href="{{route('customer.resend.otp')}}" class="text-center">Please send otp to {{Auth::guard('customer')->user()->phone}} </a></div>
        @else 
         <h4 class="text-center text-danger">Your Account Inactive. Please contact Admin</h4>
            
        @endif
       
    </div>
</section>
<form action="{{route('orderStore')}}" method="post" class="form">
    @csrf
    <div class="progressbar">
        <div class="progress" id="progress"></div>
        <div class="progress-step progress-step-active" data-title="Account"></div>
        <div class="progress-step" data-title="Delivery Date"></div>
        <div class="progress-step" data-title="Order Summery"></div>
    </div>
    <div class="step-forms step-forms-active">
        <div class="group-inputs"> <label for="username">Name <span class="text-danger">*</span></label>
             <input type="text" id="name" name="customer_name"  value="{{Auth::guard('customer')->user()->name}}" placeholder="Enter Name *" required>
                <p class="p1 text-danger"></p>
            </div>
        <div class="group-inputs"> <label for="position">Phone<span class="text-danger">*</span></label> 
             <input type="text" id="phone" name="customer_mobile" value="{{Auth::guard('customer')->user()->phone}}"  placeholder="Enter Phone Number *"  required>
             <p class="p2 text-danger"></p>
            </div>
        <div class="group-inputs"> <label for="position">Email</label> 
             <input type="text"  name="email" value="{{Auth::guard('customer')->user()->email}}"  placeholder="Enter Email "  ></div>
        <div class="group-inputs"> <label for="position">District</label>  
            <select  id="district_id" class="form-control" id="district_id" required >
                <option value="">Select District </option>
                    @foreach ($district as $item)
                    <option value="{{$item->id}}" {{Auth::guard('customer')->user()->district_id == $item->id?'selected':'' }}>{{$item->name}} </option>
                    @endforeach
            </select>
            <p class="p3 text-danger"></p>
        </div>
        <div class="group-inputs"> <label for="position" >Thana<span class="text-danger">*</span></label>  
            <select  name="thana_id" id="thana_id" class="form-control" id="thana_id" required >
                @if(isset(Auth::guard('customer')->user()->thana_id))
                <option value="{{Auth::guard('customer')->user()->thana_id}}">{{Auth::guard('customer')->user()->thana->name ?? ''}}</option>
                @endif
            </select>
            <p class="p4 text-danger"></p>
        </div>
      
        <div class="group-inputs"> <label for="position">Area<span class="text-danger">*</span></label>  
            <select  name="area_id" id="area_id" class="form-control " required >
                @if(isset(Auth::guard('customer')->user()->area_id))
                <option value="{{Auth::guard('customer')->user()->area_id}}" >{{Auth::guard('customer')->user()->area->name ?? ''}}</option>
                @endif
            </select>
            <p class="p5 text-danger"></p>
        </div>
        <div class="group-inputs"> <label for="position">Billing Address<span class="text-danger">*</span></label>  
            <input type="text" id="billing_address" name="billing_address" value="{{Auth::guard('customer')->user()->address}}" class="form-control " placeholder="Billing address *"  required>
             <p class="p6 text-danger"></p>
        </div>
            <div class="group-inputs"> <label for="position">Shipping Address<span class="text-danger">*</span></label> 
            <input type="text" name="shipping_address" id="shipping_address" value="{{Auth::guard('customer')->user()->address}}"  class="form-control " placeholder="Billing address *" placeholder="Shipping Address">
            <p class="p7 text-danger"></p>   
        </div>
        
      
        <div class=""> <a href="javascript:void();" class="my-btn btn-next width-50 ml-auto" id="first_step">Next</a> </div>
    </div>
    <div class="step-forms">
        <?php 
        $now = new DateTime();
        $date = $now->format('d-m-Y /l');
        ?>
        <div class="group-inputs"> <label for="position">Delivery Date<span class="text-danger">*</span></label>  
            <input type="text" value="{{$date}}" name="delivery_date" id="date" onchange="datechange()"  autocomplete="off" class="form-control " placeholder="Delivery Date *" required>

        </div>

        <div class="group-inputs"> <label for="position">Select Time<span class="text-danger">*</span></label>  
            <select name="time_id" id="group_id" class=" form-control"  required>
                @foreach ($time as $item)
                    <option value="{{$item->group_id}}">{{$item->time}}</option>
                @endforeach
               
            </select>
        </div>
        

        <div class="btns-group"> <a href="#" class="my-btn btn-prev">Previous</a> <a href="#" class="my-btn btn-next" onclick="secondStep()">Next</a> </div>
    </div>
    <div class="step-forms">
       
        <h5 class="text-center">Order Summery </h5>
        @if($sum < $offer->minimum_order_amount)
        <p class="text-danger note-summery py-2"><b>Note:</b> Minimum order amount {{$offer->minimum_order_amount}}</p>
        @endif
        <table class="table table-bordered px-3">
            <thead>
                <tr>
                    <td>Products</td>
                    <td class="text-center">Quantity</td>
                    <td class="text-end">Total</td>
                </tr>
            </thead>
            <tbody>
                {{-- @if($product->count() >$offer->offer_limit_qty) --}}
                @foreach (\Cart::getContent() as $cart)
                @if($cart->quantity - $cart->attributes->quantity>0)
                        <tr>
                            <td>{{$cart->name}}</td>
                            <td class="text-center" >{{$cart->quantity - $cart->attributes->quantity}}</td>
                             <td class="text-end">{{$cart->attributes->sum ? $cart->attributes->sum - $cart->attributes->offer_price : $cart->price}} TK</td>
                        </tr> 
                        @endif
                        @if ($cart->attributes->quantity>0)
                            <tr class="text-success">
                                <td>{{$cart->name}} <span class="fw-bolder">(Offer Product)</span></td>
                                <td class="text-center" >{{ $cart->attributes->quantity}}</td>
                                <td class="text-end">{{$cart->attributes->offer_price ? $cart->attributes->offer_price : $cart->price}} TK</td>
                            </tr>
                        @endif
                @endforeach
                <tr >
                    <td colspan="2">Shipping Charge</td>
                    {{-- <input type="hidden" name="shipping_cost" value="13"> --}}
                    <td class="text-end shipping_charge">
                        @if(Auth::guard('customer')->user()->area_id)
                        {{Auth::guard('customer')->user()->area->amount ?? ''}}</td>
                        @endif
                </tr>
                <tr>
                    <td colspan="2">Total Amount</td>
                    <?php
                    //  $total = array_sum($item->price);
                    ?>
                    <input type="hidden" name="total amount" value="{{$sum}}">
                    <td class="text-end"> {{$sum}} + <span class="shipping_charge">
                         @if(Auth::guard('customer')->user()->area_id)
                        {{Auth::guard('customer')->user()->area->amount ?? ''}}</span> @endif<span>Tk</span> </td>
                </tr>
            </tbody>
        </table>

        <div class="btns-group"> <a href="#" class="my-btn btn-prev">Previous</a> @if( $sum >= $offer->minimum_order_amount )
            
            <input type="submit" value="Place Order" id="submit-form" class="my-btn" /> 
           
            @else 
            <a href="{{route('home')}}" class="my-btn">Continue Shopping </a>
        @endif</div>
    </div>
</form>

@endsection
@push('website-js')
{{-- <script>
     var today = new Date();
     $('#date').datepicker('setDate', today);
</script> --}}
<script type="text/javascript">
    //  Get Subject Javascript
    $(document).on("change","#district_id",function(){
      var district_id = $("#district_id").val();
      console.log(district_id);
        $.ajax({
            url:"{{route('thana.change')}}",
          type: "GET",
          data:{district_id:district_id},
          success:function(data){
            var html = '<option value=""> Select Thana </option>';
            $.each(data,function(key,v){
              html += '<option value="'+v.id+'">'+v.name+' </option>';
            });
            $("#thana_id").html(html);
          }
      });
  
  
    });
  </script>
  <script>
    //   }
    //   $(document).on('click','#first_step',function(e){
    //     e.preventDefault();
    //     var name = $('#name').val();
    //     var phone = $('#phone').val();
    //     var district_id = $('#district_id').val();
    //     var thana_id = $('#thana_id').val();
    //     var area_id = $('#area_id').val();
    //     var billing_address = $('#billing_address').val();
    //     var shipping_address = $('#shipping_address').val();
    //     if (name.length == 0) {
    //         alert('bozzat');
    //         $("#p1").text("Please enter your Name");
           
    //     } 
    //     return false;
    //   });
     
      
  </script>
  <script>
       function secondStep(){
          var time = $('#time_id').val();
          var date = $('#date').val();
          if(time == '' || date == ''){
            alert('Requied fill must be fill-up');
          }
      }
  </script>

<script type="text/javascript">
    //  Get Subject Javascript
    $(document).on("change","#district_id",function(){
      var district_id = $("#district_id").val();
      console.log(district_id);
        $.ajax({
          url:"{{route('thana.change')}}",
          type: "GET",
          data:{district_id:district_id},
          success:function(data){
            var html = '<option value="">Select Thana </option>';
            $.each(data,function(key,v){
              html += '<option value="'+v.id+'">'+v.name+' </option>';
            });
            $("#thana_id").html(html);
          }
      });
    });
  </script>
 <script type="text/javascript">
    //  Get Subject Javascript
    $(document).on("change","#thana_id",function(){
      var thana_id = $("#thana_id").val();
      
        $.ajax({
          url:"{{route('area.change')}}",
          type: "GET",
          data:{thana_id:thana_id},
          success:function(data){
            var html = '<option value="">Select Area </option>';
            $.each(data,function(key,v){
              html += '<option value="'+v.id+'">'+v.name+' </option>';
            });
            $("#area_id").html(html);
          }
      });
  
  
    });
  </script>
 <script>

    $(function() {
     var date = new Date();
     var dayNo = date.getDay();
     var mindate = (7 - dayNo);
     var d = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ];
    //  $('#date').datepicker({
    //             dateFormat: 'dd-mm-yy /DD', });
    // $('#date').datepicker('setDate', new Date());
     $("#date").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        minDate: 0,
        dateFormat: 'dd-mm-yy /DD',
        onSelect: function(dateText, inst) {
         var today = new Date(dateText);
         var day = d[today.getDay()];
         console.log(d[dateText]);
         var input_day = $('#date').val();
         var day_pass = $(this).datepicker('getDate').toString();
         var day_pass = day_pass.substring(0, 3);
        //  console.log(day_pass);
         console.log(day_pass.substring(0, 3));
        $.ajax({
               url:"{{route('time.show')}}",
                   type:"get",
                   data:{"day_pass" : day_pass},
                   dataType: "json",
                   success:function(res){
                       console.log(res);
                       var html = '<option value="">Select Time </option>';
                       $.each(res,function(key,v){
                       html += '<option value="'+v.id+'">'+v.time+' </option>';
                       });
                       $("#group_id").html(html);
                   }
              })
       }
   
     });
    
         
   });
    </script>
   
    <script>
const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".step-forms");
const progressSteps = document.querySelectorAll(".progress-step");


let formStepsNum = 0;

nextBtns.forEach((btn) => {
btn.addEventListener("click", () => {
        var name = $('#name').val();
        var phone = $('#phone').val();
        var district_id = $('#district_id').val();
        var thana_id = $('#thana_id').val();
        var area_id = $('#area_id').val();
        var billing_address = $('#billing_address').val();
        var shipping_address = $('#shipping_address').val();
         if(name =='' ){
         $('.p1').text('Plase Fill up the must this field');
         return false;
       }
       if(phone =='' ){
         $('.p2').text('Plase Fill up the must this field');
         return false;
       }
       if(district_id =='' ){
         $('.p3').text('Plase Fill up the must this field');
         return false;
       }
       if(thana_id =='' ){
         $('.p4').text('Plase Fill up the must this field');
         return false;
       }
       if(area_id =='' ){
         $('.p5').text('Plase Fill up the must this field');
         return false;
       }
       if(billing_address =='' ){
         $('.p6').text('Plase Fill up the must this field');
         return false;
       }
       if(shipping_address =='' ){
         $('.p7').text('Plase Fill up the must this field');
         return false;
       }
       
       
    formStepsNum++;
    updateFormSteps();
    updateProgressbar();
    
    });
   
});

prevBtns.forEach((btn) => {
btn.addEventListener("click", () => {
formStepsNum--;
updateFormSteps();
updateProgressbar();

});
});

function updateFormSteps() {
formSteps.forEach((formStep) => {
formStep.classList.contains("step-forms-active") &&
formStep.classList.remove("step-forms-active");
});

formSteps[formStepsNum].classList.add("step-forms-active");
}

function updateProgressbar() {
progressSteps.forEach((progressStep, idx) => {
if (idx < formStepsNum + 1) { progressStep.classList.add("progress-step-active"); } else { progressStep.classList.remove("progress-step-active"); } }); progressSteps.forEach((progressStep, idx)=> {
    if (idx < formStepsNum) { progressStep.classList.add("progress-step-check"); } else { progressStep.classList.remove("progress-step-check"); } }); const progressActive=document.querySelectorAll(".progress-step-active"); progress.style.width=((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%" ; } 
    </script>
@endpush