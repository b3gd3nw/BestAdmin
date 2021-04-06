<form id="form" method="POST" action="{{ route('storeConsumption') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <label class="label">Category</label>
        <div class="control">
            <select name="categoryId" class="input" id="">
                <option disabled selected value> -- select an option -- </option>
                @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="field">
        <label class="label">Amount</label>
        <div class="control">
            <input name="amount" class="input" type="text" placeholder="$ 100">
        </div>
    </div>

    <div class="field">
        <a class="submit">123</a>
        <button type="submit" class="button is-success">Save changes</button>
    </div>
</form>
