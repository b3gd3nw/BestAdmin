<form id="form" method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <p class="control">
            <input name="firstname" class="input" type="text" placeholder="First Name" require notnum max20>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="lastname" class="input" type="text" placeholder="Last Name" require notnum max20>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="birthdate" class="input" type="date" placeholder="Birthday" max="{{ $today }}" onkeydown="return false" require>
            <span class="error red fs-12"></span>
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
            <span class="error red fs-12"></span>
        </div>
    </div>
    <div class="field">
        <p class="control">
            <input name="position" class="input" type="text" placeholder="Position" require>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="email" class="input" type="email" placeholder="Email" require email>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="phone" class="input" type="text" placeholder="Phone" id="phone" require min16>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="salary" class="input" type="text" placeholder="Salary" id="salary" money max6>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="skills" id="tags" class="input" type="tags" placeholder="Your skills" reqtag>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <button type="submit" class="button is-success" id="submit">Save changes</button>
    </div>
</form>
