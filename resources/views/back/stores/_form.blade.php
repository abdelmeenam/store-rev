<div class="form-group">
    <x-form.input label="store Name"  type="input" name="name" :value="$store->name" />
</div>

<!-- store description -->
<div class="form-group">
    <x-form.text-area label="Description" name="description" :value="$store->description"/>
</div>

<!-- store Image -->
<div class="form-group">
    <x-form.label id="image">Logo image</x-form.label>
    <x-form.input type="file" name="logo_image" accept="image/*" />

    @if ($store->logo_image)
        <img src="{{ asset('storage/' . $store->logo_image) }}" alt="" height="60">
    @endif
</div>


<!-- store status -->
<div class="form-group">
    <x-form.radio name="status" label="status" :checked="$store->status" :options="['active' => 'active', 'inactive' => 'inactive']" />
</div>


<!-- store submit -->
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button ?? 'save'}}</button>
</div>
