<form id="form" method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('POST')
    <div class="field">
        <p class="control">
            <input name="firstname" class="input" type="text" placeholder="First Name">
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="lastname" class="input" type="text" placeholder="Last Name">
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="birthdate" class="input" type="date" placeholder="Birthday">
        </p>
    </div>
    <div class="field">
        <div class="control">
            <select name="countryId" class="input" id="">
                <option disabled selected value> -- select a country -- </option>
                @foreach($countries as $country)
                    <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <p class="control">
            <input name="position" class="input" type="text" placeholder="Position">
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="email" class="input" type="email" placeholder="Email">
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="phone" class="input" type="number" placeholder="Phone">
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="salary" class="input" type="text" placeholder="Salary" id="salary">
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="skills" class="input" type="text" placeholder="Skills">
        </p>
    </div>
    <div class="field">
        <a class="submit">123</a>
        <button type="submit" class="button is-success">Save changes</button>
    </div>
</form>
