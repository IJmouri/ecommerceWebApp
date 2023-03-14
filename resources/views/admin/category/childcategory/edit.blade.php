<form action="{{ route('childcategory.update') }}" method="post" id="childcategoryAddForm">
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
                <option value="{{ $sub->id }}" @if( $sub->id === $data->subcategory_id) selected="" @endif>---- {{ $sub->subcategory_name }}</option>
                @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subcategory_name">Child Category Name</label>
            <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" value="{{ $data->childcategory_name }}" required>
            <input type="hidden" class="form-control" id="childcategory_id" name="childcategory_id" value="{{ $data->id }}" required>
            <small class="form-text text-muted">This is child category</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><span class="d-none">loading...</span>Update</button>

    </div>
</form>