<form id="form" method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <p class="control">
            <input name="email" class="input" type="email" placeholder="Email">
        </p>
    </div>
    <div class="field">
        <a class="submit">123</a>
        <button type="submit" class="button is-success">Save changes</button>
    </div>
</form>
