<div class="form-group">
    <label for="">name</label>
    <input  type="text" name="name"  value="{{$category->name}}" class="form-control">
</div>

<div class="form-group">
    <label for="">Parent category</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary</option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}"  @selected($parent->id === $category->parent_id ) >
                {{$parent->name}}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="description">description</label>
    <textarea  name="description" class="form-control"> {{$category->description}}</textarea>
</div>

<div class="form-group">
    <label for="">Image</label>
    <input  type="file" name="image"  value="{{$category->image}}" class="form-control">
    @if($category->image)
        <img src="{{asset('storage/'.$category->image)}}" alt="" width="300px" height="150">
    @endif

</div>

<div class="form-group">
    <label for="">Status</label>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" @checked($category->status === 'active')>
            <label class="form-check-label">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived"  {{ ( $category->status === 'archived') ? 'checked' : '' }}>
            <label class="form-check-label">
                Archived
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button ?? 'save'}}</button>
</div>
