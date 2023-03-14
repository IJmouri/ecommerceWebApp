@extends('layouts.admin')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Child Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Add New</button>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All child-categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="ytable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Child Category Name</th>
                                        <th> Category Name</th>
                                        <th>Sub Category Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<!--Sub-Category Insert Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('childcategory.store') }}" method="post" id="childcategoryAddForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_name">Category/Subcategory Name</label>
                        <select class="form-control" name="subcategory_id" required>
                           @foreach($category as $row)
                                @php
                                    $subcat = DB::table('subcategories')->where('category_id',$row->id)->get();
                                @endphp
                                <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                @foreach($subcat as $sub)
                                    <option value="{{ $sub->id }}">---- {{ $sub->subcategory_name }}</option>
                                @endforeach
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_name">Child Category Name</label>
                        <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" required>
                        <small class="form-text text-muted">This is child category</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="d-none">loading...</span>Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>


<!--Sub-Category Edit Modal -->
<div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal_body"></div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(function childcategory(){
       var table = $('#ytable').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('childcategory.index') }}",
            columns:[
                {data: 'DT_RowIndex', name:'DT_RowIndex'},
                {data: 'childcategory_name', name:'childcategory_name'},
                {data: 'category_name', name:'category_name'},
                {data: 'subcategory_name', name:'subcategory_name'},
                {data: 'action', name:'action', orderable : true, searchable : true},
            ]
       });
    });

    $('body').on('click','.edit',function(){
        let childcategoryId = $(this).data('id');
        $.get("childcategory/edit/"+childcategoryId, function(data){
            $('#modal_body').html(data);
        });
    });
</script>
@endsection