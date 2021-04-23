<form id="form" method="POST" action="{{ route('employee.update', $employee['id']) }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('PUT')
    <div class="field">
        <p class="control">
            <input name="firstname" class="input" type="text" placeholder="First Name" value="{{ $employee['firstname'] }}" require notnum max20>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="lastname" class="input" type="text" placeholder="Last Name" value="{{ $employee['lastname'] }}" require notnum max20>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="birthdate" class="input" type="date" placeholder="Birthdate" max="{{ $today }}" value="{{ $employee['birthdate'] }}" onkeydown="return false" require>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <div class="control">
            <select name="countryId" class="input" id="" require>
                @foreach($countries as $country)
                    <option value="{{ $country['id'] }}"
                            @if($country['id'] == $employee['countyId'])
                            selected
                            @endif>
                        {{ $country['name'] }}
                    </option>
                @endforeach
            </select>
            <span class="error red fs-12"></span>
        </div>
    </div>
    <div class="field">
        <p class="control">
            <input name="position" class="input" type="text" placeholder="Position" value="{{ $employee['position'] }}" require>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="email" class="input" type="email" placeholder="Email" value="{{ $employee['email'] }}" require email>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="phone" class="input" type="text" placeholder="Phone" id="phone" value="{{ $employee['phone'] }}" require min16>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="salary" class="input" type="text" placeholder="Salary" id="salary" value="{{ $employee['salary'] }}" money max6>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <input name="skills" id="tags" class="input" type="tags" placeholder="Your skills" value="@foreach($skills as $skill){{ $skill . ',' }} @endforeach" reqtag taglength>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <button type="submit" class="button is-success" id="submit">Save changes</button>
    </div>
</form>
