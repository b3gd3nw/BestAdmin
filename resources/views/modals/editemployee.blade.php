<form id="form" method="POST" action="{{ route('employee.update', $employee['id']) }}" enctype="multipart/form-data" novalidate>
    @csrf
    @method('PUT')
    <div class="field">
        <p class="control">
            <label for="firstname">First Name</label>
            <input name="firstname" class="input" type="text" value="{{ $employee['firstname'] }}" require notnum max20>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="lastname">Last Name</label>
            <input name="lastname" class="input" type="text" value="{{ $employee['lastname'] }}" require notnum max20>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
          <input name="birthdate" class="calendar" value="{{ $employee['birthdate'] }}">
          <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <div class="control">
            <label for="countryId">Country</label>
            <select name="countryId" class="input" id="" require>
                @foreach($countries as $country)
                    <option value="{{ $country['id'] }}" @if($country['id'] == $employee['countryId']) selected @endif>
                        {{ $country['name'] }}
                    </option>
                @endforeach
            </select>
            <span class="error red fs-12"></span>
        </div>
    </div>
    <div class="field">
        <p class="control">
            <label for="position">Position</label>
            <input name="position" class="input" type="text" value="{{ $employee['position'] }}" require>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="email">Email</label>
            <input name="email" class="input" type="email" value="{{ $employee['email'] }}" require email>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="phone">Phone</label>
            <input name="phone" class="input" type="text" id="phone" value="{{ $employee['phone'] }}" require min16>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="salary">Salary</label>
            <input name="salary" class="input" type="text" id="salary" value="{{ $employee['salary'] }}" money max6>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="skills">Skills</label>
            <input name="skills" id="tags" class="input" type="tags" value="@foreach($skills as $skill){{ $skill . ',' }} @endforeach" reqtag taglength nodup>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <p class="control">
            <label for="status">Status</label>
            <select name="status" class="input" id="" require>
                @switch($employee['status'])
                    @case('active')
                    <option value="Active" selected>Active</option>
                    <option value="Pending">Pending</option>
                    <option value="Inactive">Inactive</option>
                    @break
                    @case('pending')
                    <option value="Active">Active</option>
                    <option value="Pending" selected>Pending</option>
                    <option value="Inactive">Inactive</option>
                    @break
                    @case('inactive')
                    <option value="Active">Active</option>
                    <option value="Pending">Pending</option>
                    <option value="Inactive" selected>Inactive</option>
                    @break
                @endswitch
            </select>
            <span class="error red fs-12"></span>
        </p>
    </div>
    <div class="field">
        <button type="submit" class="button is-success" id="submit">Save changes</button>
    </div>
</form>
