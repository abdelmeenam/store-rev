

<div class="form-group">
    <x-form.input label="Category Name"  type="input" name="name" :value="$category->name" />
</div>

<!-- category parent -->
<div class="form-group">
    <label for="">Parent category</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary</option>

        @foreach($parents as $parent)
            //old('value', 'default');
            <option value="{{$parent->id}}"  @selected(old ($parent->id , $parent->id) === $category->parent_id)  >
                {{$parent->name}}
            </option>
        @endforeach

    </select>
</div>

<!-- category description -->
<div class="form-group">
    <x-form.text-area label="Description" name="description" :value="$category->description"/>
</div>

<!-- category image -->
<div class="form-group">
    <x-form.input label="image" type="file" name="image"  value="{{$category->image}}" />
    @if($category->image)
        <img src="{{asset('storage/'.$category->image)}}" alt="" width="300px" height="150">
    @endif
</div>

<!-- category status -->
<div class="form-group">
    <x-form.radio name="status" label="status" :checked="$category->status" :options="['active' => 'active', 'archived' => 'archived']" />
</div>

<!-- category submit -->
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button ?? 'save'}}</button>
</div>
