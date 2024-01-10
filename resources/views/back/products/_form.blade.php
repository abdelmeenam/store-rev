<div class="form-group">
    <x-form.input label="Product Name"  type="input" name="name" :value="$product->name" />
</div>

<!-- product category -->
<div class="form-group">
    <label for="">product category</label>
    <select name="category_id" class="form-control form-select">
        <option value="">Primary Category</option>
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

<!-- product Image -->
<div class="form-group">
    <x-form.label id="image">Image</x-form.label>

    <x-form.input type="file" name="image" accept="image/*" />
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="" height="60">
        @endif
</div>

<!-- product Tags -->
<div class="form-group">
    <x-form.input label="Tags" name="tags" :value="$tags" />
</div>


<!-- product status -->
<div class="form-group">
    <x-form.radio name="status" label="status" :checked="$product->status" :options="['active' => 'active', 'archived' => 'archived' , 'draft'=>'draft']" />
</div>

<!-- product price -->
<div class="form-group">
    <x-form.input label="price" name="price" :value="$product->price"/>
</div>

<!-- product compare price -->
<div class="form-group">
    <x-form.input label="compare price" name="compare_price" :value="$product->compare_price"/>
</div>

<!-- product submit -->
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button ?? 'save'}}</button>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    {{-- <link href="{{asset('AdminAssets/css/tagify.css')}}"  type="text/css" /> --}}
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    {{-- <script src="{{asset('AdminAssets/js/tagify.js')}}"></script>
    <script src="{{asset('AdminAssets/js/tagify.polyfills.min.js')}}"></script> --}}
    <script>
        var inputElement = document.querySelector('[name=tags]'),
        tagify = new Tagify(inputElement);
    </script>
@endpush
