@extends('layouts.admin_layout')

@section('title', 'Accounting-General')

@section('content')
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
              $ {{ $bank_amount }}
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
              <div class="controll">
                  <label for="date">Filter by date</label>
                  <input name="date" class="input" type="date" id="date" data-label-from="Click to change" data-is-range="true" data-start-date="{{ date('m.d.y') }}" data-end-date="{{ date('m.d.y', strtotime(date('m.d.y'). ' +1 month')) }}">
              </div>
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
              @if($consumption['amount'] > $consumption['category']['budget'])
                  <tr style="box-shadow: 0 0 5px red">
                      <th>{{ $consumption['category']['id'] }}</th>
                      <td>{{ $consumption['category']['name'] }}</td>
                      <td>$ {{ $consumption['amount'] }}</td>
                  </tr>
              @else
                  <tr>
                      <th>{{ $consumption['category']['id'] }}</th>
                      <td>{{ $consumption['category']['name'] }}</td>
                      <td>$ {{ $consumption['amount'] }}</td>
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
                                <td>$ +{{ $transaction['amount'] }}</td>
                                @break

                                @case('consumption')
                                <td class="red">{{ $transaction['type'] }}</td>
                                <td>$ -{{ $transaction['amount'] }}</td>
                                @break

                            @endswitch
                            @foreach($categories as $category)
                                @if($category['id'] === $transaction['categoryId'])
                                    <td>{{ $category['name'] }}</td>
                                    @break
                                @else
                                    <td>Without category</td>
                                    @break
                                @endif
                            @endforeach
                            <td>{{ $transaction['created_at'] }}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
