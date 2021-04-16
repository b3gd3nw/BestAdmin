<form id="form" method="POST" action="{{ route('sendmail') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <p class="control">
            <input name="email" class="input" type="email" placeholder="Email" require email>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <button type="submit" class="button is-success" id="submit">Save changes</button>
    </div>
</form>
