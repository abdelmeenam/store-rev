<div class="form-group">
    <x-form.input label="product Name"  type="input" name="name" :value="$product->name" />
</div>

<!-- product category -->
<div class="form-group">
    <select name="category_id" class="form-control form-select">
        <label for="">product category</label>
        @foreach($categories as $category)
            //old('value', 'default');
            <option value="{{$category->id}}"  @selected(old($category->id , $product->category_id) == $category->id)>
                {{$category->name}}
            </option>
        @endforeach

    </select>
</div>

<!-- product description -->
<div class="form-group">
    <x-form.text-area label="Description" name="description" :value="$product->description"/>
</div>

<!-- product price -->
<div class="form-group">
    <x-form.input label="price" name="price" :value="$product->price"/>
</div>


<!-- product compare price -->
<div class="form-group">
    <x-form.input label="compare price" name="compare_price" :value="$product->compare_price"/>
</div>


<!-- product image -->
<div class="form-group">
    <x-form.input label="image" type="file" name="image"  value="{{$product->image}}" />
    @if($product->image)
        <img src="{{asset('storage/'.$product->image)}}" alt="" width="300px" height="150">
    @endif
</div>

<!-- product status -->
<div class="form-group">
    <x-form.radio name="status" label="status" :checked="$product->status" :options="['active' => 'active', 'archived' => 'archived' , 'draft'=>'draft']" />
</div>

<!-- product submit -->
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button ?? 'save'}}</button>
</div>
