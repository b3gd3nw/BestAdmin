@extends('layouts.admin_layout')

@section('title', 'Accounting-General')

@section('content')
    @if (Session::has('success'))
        <div class="notification is-success">
            <button class="delete"></button>
            {{ session('success') }}
        </div>
    @endif
    <div class="modal" id="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title" id="modal-title">Create New Income</p>
                <button class="delete" aria-label="close" id="modalClose"></button>
            </header>
            <section class="modal-card-body">

            </section>
        </div>
    </div>
  <div class="columns">
      <div class="column is-full mt-1">
        <div class="card margin-auto">
          <div class="card-content text-center">
            <p class="title color-black">
              $ {{ number_format($bank_amount, 2,  ',', '.') }}
            </p>
            <p class="subtitle color-black">
              Balance
            </p>
          </div>
          <footer class="card-footer color-black">
            <a data-path="{{ route('income') }}" class="card-footer-item text-glow color-black" id="income">Income</a>
            <a data-path="{{ route('consumption') }}" class="card-footer-item text-glow color-black" id="consumption">Consumption</a>
          </footer>
        </div>
      </div>
  </div>
  <div class="columns">
      <div class="column is-4">
          <h1 class="title">Costs by category</h1>
          <form action="" id="frm" class="v-flex-end" method="POST">
              @csrf
              <input name="birthdate" class="range-calendar" placeholder="Birthday">
              <span class="error red fs-12"></span>
              <p class="buttons">
                  <button type="button" class="button" id="srch">
                    <span class="icon is-small">
                      <i class="fas fa-search"></i>
                    </span>
                  </button>
              </p>
          </form>
      </div>
  </div>
  <div class="columns">
    <div class="column is-full">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Category</th>
            <th>Consumption</th>
          </tr>
        </thead>
        <tbody id="agtable">
          @foreach($consumptions as $consumption)
              @if($consumption['amount'] > $consumption['category']['budget'] && $consumption['category']['budget'] != 0)
                  <tr style="box-shadow: 0 0 5px red">
                      <th>{{ $consumption['category']['id'] }}</th>
                      <td>{{ $consumption['category']['name'] }}</td>
                      <td>$ {{ number_format($consumption['amount'], 2,  ',', '.') }}</td>
                  </tr>
              @else
                  <tr>
                      <th>{{ $consumption['category']['id'] }}</th>
                      <td>{{ $consumption['category']['name'] }}</td>
                      <td>$ {{ number_format($consumption['amount'], 2, ',', '.') }}</td>
                  </tr>
              @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
    <div class="columns">
        <div class="column is-full">
            <h1 class="title">All transactions</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Category</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                        <tr>
                            @switch($transaction['type'])

                                @case('income')
                                <td class="green">{{ $transaction['type'] }}</td>
                                <td>$ +{{ number_format($transaction['amount'], 2, ',', '.') }}</td>
                                @break

                                @case('consumption')
                                <td class="red">{{ $transaction['type'] }}</td>
                                <td>$ -{{ number_format($transaction['amount'], 2, ',', '.') }}</td>
                                @break

                            @endswitch
                            @if($categories && $categories->count())
                              @foreach($categories as $category)
                                  @if($category['id'] === $transaction['categoryId'])
                                      <td>{{ $category['name'] }}</td>
                                      @break
                                  @else
                                      <td>Without category</td>
                                      @break
                                  @endif
                              @endforeach
                            @else
                              <td>Without category</td>
                            @endif
                            <td>{{ $transaction['created_at'] }}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
