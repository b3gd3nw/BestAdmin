<form id="form" method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <p class="control">
            <input name="firstname" class="input" type="text" placeholder="First Name" require notnum max20>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="lastname" class="input" type="text" placeholder="Last Name" require notnum max20>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="birthdate" class="input" type="date" placeholder="Birthday" max="{{ $tomorrow }}" onkeydown="return false" require>
        </p>
    </div>
    <div class="field">
        <div class="control">
            <select name="countryId" class="input" id="" require>
                <option disabled selected value> -- select a country -- </option>
                @foreach($countries as $country)
                    <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <p class="control">
            <input name="position" class="input" type="text" placeholder="Position" require>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="email" class="input" type="email" placeholder="Email" require email>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="phone" class="input" type="text" placeholder="Phone" id="phone" require min16>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="salary" class="input" type="text" placeholder="Salary" id="salary" money max6>
        </p>
    </div>
    <div class="tagsfield field input is-grouped is-grouped-multiline">
        <div>
            <input id="user_skills" name="user[skills]" type="hidden">
            <span autocomplete="off" spellcheck="false" placeholder="Your skills" contenteditable></span>
        </div>
    </div>
    <p class="help">
        Space-separated, minimum one
    </p>
    <div class="field">
        <button type="submit" class="button is-success" id="submit">Save changes</button>
    </div>
</form>
