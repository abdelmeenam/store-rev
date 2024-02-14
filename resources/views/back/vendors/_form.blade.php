

    <div class="row">

      <div class="col">
        <div class="form-group">
            <x-form.input label="Vendor Name"  type="input" name="name" :value="$vendor->name" />
        </div>
        <div class="form-group">
            <x-form.input label="Vendor Email"  type="input" name="email" :value="$vendor->email" />
        </div>

        <div class="form-group">
            <x-form.input label="Vendor Password"  type="password" name="password" :value="$vendor->password" />
        </div>
        {{-- <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" :value="$vendor->password">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
        </div> --}}


      </div>

      <div class="col">

        <div class="form-group">
            <x-form.input label="Vendor phone"  type="tel" name="phone" :value="$vendor->phone" />
        </div>

        <div class="form-group">
            <x-form.radio name="status" label="status" :checked="$vendor->status" :options="['active' => 'active', 'inactive' => 'inactive']" />
        </div>

        <div class="form-group">
            <label for="">Store</label>
            <select name="store_id" class="form-control form-select">
                @foreach($stores as $store)
                    //old('value', 'default');
                    <option value="{{$store->id}}">
                        {{$store->name}}
                    </option>
                @endforeach
            </select>
        </div>
      </div>

    </div>
    <div class="row">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{$button ?? 'save'}}</button>
        </div>
    </div>

