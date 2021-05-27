<form id="form" method="POST" action="{{ route('storeConsumption') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <label class="label">Category</label>
        <div class="control">
            <select name="categoryId" class="input" id="">
                <option disabled selected value> -- select an option -- </option>
                @foreach($categories as $category)
                    @if ($category->type === 'consumption')
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>    
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="field">
        <label class="label">Amount</label>
        <div class="control">
            <input name="amount" class="input" type="text" placeholder="$ 100" id="consumption" money max6>
            <span class="error red fs-12"></span>
        </div>
    </div>

    <div class="field">
        <button type="submit" class="button is-success" id="submit">Save changes</button>
    </div>
</form>
