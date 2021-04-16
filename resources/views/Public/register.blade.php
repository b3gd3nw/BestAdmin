@extends('layouts.main_layout')

@section('title', 'Step One')

@section('content')
  <div class="body-bg">
    <div class="container">
      @if (Session::has('error'))
        <div class="notification is-warning">
          <button class="delete"></button>
          {{ session('error') }}
        </div>
      @endif
      <div class="card my-1">
        <div class="card-content text-center fantom-card text-glow">
          <form id="form" class="" action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            @method('POST')
            <p class="title color-black">
              Fill the form
            </p>
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
                <input name="birthdate" class="calendar" placeholder="Birthday">
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
            <button class="button is-primary" id="submit">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
