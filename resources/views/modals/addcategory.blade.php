<form id="form" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <label class="label">Name</label>
        <div class="control">
            <input required name="name" class="input" type="text" placeholder="Sport">
        </div>
    </div>

    <div class="field">
        <label class="label">Budget</label>
        <div class="control">
            <input name="budget" class="input" type="text" placeholder="$ 100" id="budget">
        </div>
    </div>

    <div class="field">
        <a class="submit">123</a>
        <button type="submit" class="button is-success">Save changes</button>
    </div>
</form>
