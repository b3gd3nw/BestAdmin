<form id="form" method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <p class="control">
            <label for="firstname">First Name</label>
            <input name="firstname" class="input" type="text" require notnum max20>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="lastname">Last Name</label>
            <input name="lastname" class="input" type="text" require notnum max20>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="birthdate">Birth Date</label>
            <input name="birthdate" class="input" type="date" max="{{ $today }}" onkeydown="return false" require>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <div class="control">
            <label for="countryId">Country</label>
            <select name="countryId" class="input" id="" require>
                <option disabled selected value> -- select a country -- </option>
                @foreach($countries as $country)
                    <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                @endforeach
            </select>
            <span class="error red fs-12"></span>
        </div>
    </div>
    <div class="field">
        <p class="control">
            <label for="position">Position</label>
            <input name="position" class="input" type="text" require>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="email">Email</label>
            <input name="email" class="input" type="email" require email>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="phone">Phone</label>
            <input name="phone" class="input" type="text" id="phone" require min16>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="salary">Salary</label>
            <input name="salary" class="input" type="text" id="salary" money max6>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="skills">Skills</label>
            <input name="skills" id="tags" class="input" type="tags" reqtag taglength nodub>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <button type="submit" class="button is-success" id="submit">Save changes</button>
    </div>
</form>
