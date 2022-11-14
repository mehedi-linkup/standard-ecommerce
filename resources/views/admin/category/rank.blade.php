@extends('layouts.admin')
@section('title', 'Category Rank')
@section('admin-content')
<main>
    <div class="container">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('admin.index')}}">Home</a> >Category Rank</span>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="table-head text-left"><i class="fas fa-table me-1"></i>Category Rank <a href="" class="float-right text-decoration-none"><i class="fas fa-print"></i></a></div>
               
            </div>
            <div class="card-body table-card-body p-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pending">
                        <form action="{{route('rank.update')}}" method="post">
                            @csrf
                            <table id="first_table">
                                <thead class="text-center bg-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th width="10%">Rank ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($category as $key=>$item)
                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <input type="hidden" name="id[]" value="{{$item->id}}">
                                            <input type="text" name="rank_id[]"  value="{{$item->rank_id}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                                <thead>
                                    <td colspan="3">
                                        <input type="submit" value="Update" class="btn btn-success btn-sm float-right">
                                    </td>
                                </thead>
                            </table>
                        </form>
                    </div> 
            </div>
        </div>
    </div>
@endsection
@push('admin-js')
 
<script src="{{ asset('admin/js/sweetalert2.all.js') }}"></script>
<script> 
    function deleteUser(id) {
            swal({
                title: 'Are you sure?',
                text: "You want to Delete this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
</script>
@endpush
