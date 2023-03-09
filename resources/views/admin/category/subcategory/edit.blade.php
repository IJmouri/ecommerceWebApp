<form action="{{ route('subcategory.update') }}" method="post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <select class="form-control" name="category_id" required>
                @foreach($category as $row)
                <option value="{{ $row->id}}" @if( $row->id === $data->category_id) selected="" @endif>{{ $row->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subcategory_name">Sub-category Name</label>
            <input type="text" class="form-control" id="subcategory_name" value="{{ $data->subcategory_name }}" name="subcategory_name" required>
            <input type="hidden" class="form-control" value="{{ $data->id }}" name="subcategory_id" >
            <small class="form-text text-muted">This is sub category</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>