<form id="form" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <label class="label">Name</label>
        <div class="control">
            <input required name="name" class="input" type="text" placeholder="Sport" require notnum max20>
            <span class="error red fs-12"></span>
        </div>
    </div>
    <div class="field">
        <label class="label">Budget</label>
        <div class="control">
            <input name="budget" class="input" type="text" placeholder="$ 100" id="budget" max6>
            <span class="error red fs-12"></span>
        </div>
    </div>
    <div class="field">
        <p class="control">
            <label class="label" for="type">Type</label>
            <select name="type" class="input" id="" require>
                <option disabled selected value> -- select a type -- </option>
                <option value="income">Income</option>
                <option value="consumption">Consumption</option>
            </select>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <button type="submit" class="button is-success" id="submit">Save changes</button>
    </div>
</form>
