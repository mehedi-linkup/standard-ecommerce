@extends('layouts.admin')
@section('title', 'Product Edit')
@section('admin-content')
<main class="mb-5">
    <div class="container">
     <div class="heading-title p-2 my-2">
         <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Update Product</span>
     </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-1"><span style="font-size: 14px;
                        font-weight: 600;
                        color: #0e2c96;">Update Product</span> </div>
                        <div class="card-body table-card-body my-table">
                          <form  action="{{ route('product.update', $product) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                               <div class="col-md-6">
                                  <div class="row">
                                    <!--<div class="col-md-4">-->
                                    <!--  <strong><label>Product ID</label><span class="color-red">*</span> <span class="my-label">:</span> </strong>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-8">-->
                                    <!--  <input type="text" name="code" placeholder="Product ID" value="{{ $product->code }}" class="form-control my-form-control @error('code') is-invalid @enderror" >-->
                                    <!--      @error('code')-->
                                    <!--      <span class="invalid-feedback" role="alert">-->
                                    <!--          <strong>{{ $message }}</strong>-->
                                    <!--      </span> -->
                                    <!--    @enderror-->
                                    <!--</div>-->
                                    <div class="col-md-4">
                                       <strong><label>Name</label><span class="color-red">*</span> <span class="my-label">:</span> </strong>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="name" value="{{ $product->name }}" class="form-control my-form-control @error('name') is-invalid @enderror">
                                          @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span> 
                                        @enderror 
                                    </div>

                                    <div class="col-md-4">
                                        <strong><label>Price</label><span class="color-red">*</span> <span class="my-label">:</span> </strong>
                                    </div>

                                    <div class="col-md-8">
                                        <input type="text" name="price" value="{{ $product->price }}" class="form-control my-form-control @error('price') is-invalid @enderror">
                                            @error('price')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span> 
                                            @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <strong><label>Discount</label> <span class="my-label">:</span> </strong>
                                    </div>

                                    <div class="col-md-8">
                                        @if ( $product->is_offer != 0)
                                        <input type="number" name="discount" id="offer" value="{{ $product->discount }}"  placeholder="Discount" class="form-control my-form-control @error('discount') is-invalid @enderror">      
                                        @else
                                        <input type="number" name="discount" id="offer" value="{{ $product->discount }}" disabled placeholder="Discount" class="form-control my-form-control @error('discount') is-invalid @enderror">
                                        @endif
                                            @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> 
                                          @enderror
                                    </div>
                                    <div class="col-md-4">
                                      <strong><label>Stock</label> <span class="my-label">:</span> </strong>
                                  </div>

                                  <div class="col-md-8">
                                    
                                      <input type="number" name="purchage" id="purchage" value="{{$product->inventory['purchage'] }}"  placeholder="Enter Stock" class="form-control my-form-control @error('purchage') is-invalid @enderror">      
                                     
                                          @error('purchage')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span> 
                                        @enderror
                                  </div>

                                    <div class="col-md-4">
                                        <strong><label>Short Description</label> <span class="my-label">:</span> </strong>
                                    </div>
                                    <div class="col-md-8">
                                    <textarea name="short_details" class="form-control short_description @error('short_details') is-invalid @enderror" id="editor" cols="30" rows="3">{{ $product->short_details }}</textarea> 
                                          @error('short_details')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> 
                                          @enderror
                                    </div>
                                    <div class="col-md-4">
                                      <strong><label>Image</label> <span class="my-label">:</span> </strong>
                                    </div>
                                    <div class="col-md-5 mt-1">
                                      <input name="image" type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" id="image" type="file"  onchange="readURL(this);">
                                          @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> 
                                          @enderror
                                    </div>
                                    <div class="col-md-3 mt-1">
                                      <img class="form-controlo img-thumbnail" src="#" id="previewImage" style="width: 100px;height: 80px; background: #3f4a49;">
                                    </div>
                                  </div>
                               </div> 
                               <div class="col-md-6">
                                <div class="row">
                                  <div class="col-md-4">
                                     <strong><label>Category</label><span class="color-red">*</span> <span class="my-label">:</span> </strong>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="input-group input-group-sm">
                                      <select name="category_id" id="category_id" class="custom-select js-example-basic-multiple form-control my-select my-form-control @error('category_id') is-invalid @enderror" data-live-search="true" >
                                        <option  data-tokens="ketchup mustard">Select Category</option>
                                            @foreach ($category as $item)
                                              <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                      </select>
                                      <div class="input-group-append">
                                        <a class="border rounded my-select my-form-control py-0 px-2" href="{{ route('category.index') }}" target="_blank"><i class="fas fa-plus"></i></a>
                                      </div>
                                    </div>
                                        @error('category_id')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span> 
                                        @enderror
                                  </div>
                                  
                                  <div class="col-md-4">
                                    <strong><label>Sub Category</label><span class="my-label">:</span> </strong>
                                  </div>
                                    <div class="col-md-8 mt-1">
                                      <div class="input-group input-group-sm">
                                      <select name="sub_category_id" id="sub_category_id" class="js-example-basic-multiple form-control my-form-control @error('sub_category_id') is-invalid @enderror " data-live-search="true" >
                                        <option  data-tokens="ketchup mustard">Select Sub Category</option>
                                    </select>
                                    <div class="input-group-append">
                                      <a class="border rounded my-select my-form-control py-0 px-2" href="{{ route('subcategory.index') }}" target="_blank"><i class="fas fa-plus"></i></a>
                                    </div>
                                  </div>
                                        @error('sub_category_id')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span> 
                                        @enderror
                                  </div>
                                  <div class="col-md-4">
                                    <strong><label>Product Size</label> <span class="my-label">:</span> </strong>
                                  </div>
                                  <div class="col-md-3 mt-1">
                                    <select class="js-example-basic-multiple form-control my-select my-form-control @error('size_id') is-invalid @enderror " data-live-search="true" name="size_id">
                                      <option  data-tokens="ketchup mustard" value="">Select Size</option>
                                        @foreach ($size as $item)
                                        <option value="{{$item->id}}" {{ $item->id == $product->size_id ? 'selected' : '' }}>{{$item->name}}</option>   
                                        @endforeach
                                    </select>
                                        @error('size_id')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span> 
                                        @enderror
                                  </div>
                                  <div class="col-md-1">
                                    <strong><label>Color</label></strong>
                                  </div>
                                  <div class="col-md-4 mt-1">
                                    <select class="js-example-basic-multiple form-control my-select my-form-control @error('color_id') is-invalid @enderror" data-live-search="true" name="color_id">
                                      <option  data-tokens="ketchup mustard" value="">Select Color</option>
                                      @foreach ($color as $item)
                                      <option value="{{$item->id}}"  {{ $item->id == $product->color_id ? 'selected' : '' }} >{{$item->name}}</option>
                                      @endforeach   
                                    </select>
                                        @error('color_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> 
                                        @enderror
                                  </div>
                                  <div class="col-md-4">
                                    <strong><label> Product Is</label> <span class="my-label">:</span> </strong>
                                  </div>
                                  <div class="col-md-3 mt-1">
                                   <input type="checkbox" @if(old('is_offer', $product->is_offer)) checked @endif value="1" onclick="toggleEnable('offer')"  name="is_offer" class="@error('is_offer') is-invalid @enderror" id="">
                                        @error('is_offer')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span> 
                                        @enderror
                                   <label for="">Offer</label>
                                    </div>
                                  <div class="col-md-3 mt-1">
                                   <input type="checkbox" name="is_arrival" @if(old('is_arrival', $product->is_arrival)) checked @endif value="1"  class="@error('is_arrival') is-invalid @enderror" id="">
                                        @error('is_popular')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span> 
                                        @enderror
                                   <label for="">New Arrival</label>
                                  </div>
                                  <div class="col-md-2 mt-1">
                                    <input type="checkbox" name="is_popular" @if(old('is_popular', $product->is_popular)) checked @endif value="1"  class="@error('is_popular') is-invalid @enderror" id="">
                                         @error('is_popular')
                                           <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span> 
                                         @enderror
                                    <label for="">Popular</label>
                                   </div>
                                  <div class="col-md-4">
                                    <strong><label> Description</label> <span class="my-label">:</span> </strong>
                                  </div>
                                  <div class="col-md-8 mt-1">
                                  <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ $product->description }}</textarea> 
                                      @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> 
                                      @enderror
                                  </div>
                                  <div class="col-md-4">
                                    <strong><label>Other Image</label> <span class="my-label">:</span> </strong>
                                  </div>
                                  <div class="col-md-8 mt-1">
                                    <input type="file" class=" form-control form-control-sm" maxlength="5" id="otherImage" name="otherImage[]" multiple />
                                    @foreach($product->productImage as $item)
                                    <span class="pip"> 
                                        <img src="{{ asset($item->otherImage) }}" class="imageThumb" data-image_id="{{ $item->id }}" alt="">
                                        <span class="close-btn remove" data-image_id="{{ $item->id }}">
                                            remove
                                        </span>
                                      </span>
                                    @endforeach
                                  </div>
                                </div>
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-12">
                              <button type="submit" class="btn btn-primary btn-sm float-right mt-2">Update</button>
                              <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm float-right mt-2 mr-2">Back</a>
                             </div>
                           </div>
                        </form>
                     </div>
                </div>
        </div>
    </div>
</main>
@endsection
@push('admin-js')
<script>
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
</script>
<script>
    $(document).ready(function(){
           $("select[name='category_id']").on('change', function(){
               var category_id =$(this).val();
               product(category_id)
           });
       });
       var categoryId = "<?php echo $product->category_id ?>";
       product(categoryId);
       function product(id) {
           var subcategoryId = id;
           if(subcategoryId != 0 && subcategoryId != undefined) {
               $.ajax({
                   url:"{{ url('product/subcategory/list')}}/"+ subcategoryId,
                   type :"GET",
                   dataType:"json",
                   success:function(data){
                   $('#sub_category_id').empty();
                       $.each(data, function(key,value){
                       $("#sub_category_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                       });
                   }
               });
           }
       }
   </script>
   <script>
     $(document).on('click', '.close-btn', function () {
           
            var imageId = $(this).data('image_id');
            if (imageId) {
                $.ajax({
                    url: '{{url("/")}}/product/remove-other-image/' + imageId,
                    method: 'DELETE',
                    success: function (res) {
                        if (res) {
                            $(this).parent().remove();
                        } else {
                            alert('Something went wrong :(');
                        }
                    }.bind(this)
                })
            }
        });
   </script>
<script src="{{ asset('admin/js/ckeditor.js') }}"></script>
<script>
  function toggleEnable(id) {
    var textbox = document.getElementById(id);
    if (textbox.disabled) {
        document.getElementById(id).disabled = false;
      } else {
          document.getElementById(id).disabled = true;
      }
  }
</script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
  ClassicEditor
      .create( document.querySelector( '#description' ) )
      .catch( error => {
          console.error( error );
      } );
</script>
<script> 
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload=function(e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage").src="{{ asset('uploads/product/'.$product->image ) }}";
</script>
<script>
  // multiple image
 $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#otherImage").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove</span>" +
            "</span>").insertAfter("#otherImage");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>


@endpush