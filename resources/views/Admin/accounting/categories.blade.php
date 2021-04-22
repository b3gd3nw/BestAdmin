@extends('layouts.admin_layout')

@section('title', 'Accounting-Categories')

@section('content')
    @if (Session::has('success'))
        <div class="notification is-success">
            <button class="delete"></button>
            {{ session('success') }}
        </div>
    @elseif (Session::has('error'))
        <div class="notification is-warning">
            <button class="delete"></button>
            {{ session('error') }}
        </div>
    @endif
    <div class="modal" id="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Create New Category</p>
                <button class="delete" aria-label="close" id="modalClose"></button>
            </header>
            <section class="modal-card-body">

            </section>
        </div>
    </div>
    <div class="columns flex-wrap" id="categories">
      @foreach($categories as $category)
      <div class="column is-one-third mt-1">
        <div class="card">
          <div class="card-content text-center">
            <p class="title color-black">
              $ {{ number_format($category['budget'], 2,  ',', '.') }}
            </p>
            <p class="subtitle color-black">
              {{ $category['name'] }}
            </p>
          </div>
          <footer class="card-footer">
            <a data-path="{{ route('category.edit', $category['id']) }}" class="card-footer-item text-glow color-black changeCard">Change budget</a>
              <form action="{{ route('category.destroy', $category['id'])  }}" method="POST" id="del">
                  @csrf
                  @method('DELETE')
                  <a class="card-footer-item text-glow color-black delete-ctg">Delete</a>
              </form>

          </footer>
        </div>
      </div>
      @endforeach
      <div class="column is-one-third mt-1">
        <div data-path="{{ route('category.index') }}" class="card has-background-none has-hoverable" id="addCard">
          <div class="card-content text-center fantom-card text-glow">
            <p class="title color-black opacity-3">
              Add
            </p>
            <p class="subtitle color-black opacity-3">
              Category
            </p>
          </div>
        </div>
      </div>
  </div>
@endsection
