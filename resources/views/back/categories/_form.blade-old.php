<!-- category name -->
<div class="form-group">
    <label for="">name</label>
    {{-- <input  type="text" name="name"  value="{{old('name')}}" class="form-control @error('name') is-invalid
    @enderror" > --}}
    <input type="text" name="name" value="{{old('name' , $category->name)}}" @class(['form-control','is-invalid'=>
    $errors->has('name')]) >
    @error('name')
    {{-- <div class="text-danger">{{ $message }}
</div> --}}
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<!-- category parent -->
<div class="form-group">
    <label for="">Parent category</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary</option>
        @foreach($parents as $parent)
        <option value="{{$parent->id}}" @selected(old($parent->id , $category->parent_id) === $category->parent_id ) >
            {{$parent->name}}
        </option>
        @endforeach
    </select>
</div>

<!-- category description -->
<div class="form-group">
    <label for="description">description</label>
    <textarea name="description" class="form-control"> {{old('description' , $category->description)}}</textarea>
</div>

<!-- category image -->
<div class="form-group">
    <label for="">Image</label>
    <input type="file" name="image" value="{{$category->image}}" class="form-control">
    @if($category->image)
    <img src="{{asset('storage/'.$category->image)}}" alt="" width="300px" height="150">
    @endif
</div>

<!-- category status -->
<div class="form-group">
    <label for="">Status</label>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" @checked(old('status' ,
                $category->status) === 'active')>
            <label class="form-check-label">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived"
                {{( old('status', $category->status) === 'archived') ? 'checked' : '' }}>
            <label class="form-check-label">
                archived
            </label>
        </div>
    </div>
</div>

<!-- category submit -->
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button ?? 'save'}}</button>
</div>