<form id="form" method="POST" action="{{ route('category.update', $id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="field">
        <label class="label">Budget</label>
        <div class="control">
            <input name="budget" class="input" type="text" placeholder="$ {{ $budget }}" id="budget" require max6>
            <span class="error red fs-12"></span>
        </div>
    </div>

    <div class="field">
        <button type="submit" class="button is-success" id="submit">Save changes</button>
    </div>
</form>
