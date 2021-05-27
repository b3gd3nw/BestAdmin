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
                        $ {{ number_format($bank_amount, 2, ',', '.') }}
                    </p>
                    <p class="subtitle color-black">
                        Balance
                    </p>
                </div>
                <footer class="card-footer color-black">
                    <a data-path="{{ route('income') }}" class="card-footer-item text-glow color-black"
                        id="income">Income</a>
                    <a data-path="{{ route('consumption') }}" class="card-footer-item text-glow color-black"
                        id="consumption">Consumption</a>
                </footer>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column is-full">
            <h1 class="title">Costs by category</h1>
            <form action="" id="frm" class="v-flex-end" method="GET">
                @csrf
                <input name="date" class="range-calendar" placeholder="Birthday">
                <span class="error red fs-12"></span>
                <p class="buttons">
                    <button type="button" class="button" id="srch">
                        <span class="icon is-small">
                            <i class="fas fa-search"></i>
                        </span>
                    </button>
                    <button type="button" class="button" id="clr">
                        <span class="icon is-small">
                            <i class="far fa-trash-alt"></i>
                        </span>
                    </button>
                </p>
            </form>
        </div>
    </div>
    <div class="columns">
        <div class="column is-full">
            <table class="table text-left" id="consumption-table">
                <thead>
                    <tr>
                        <th>
                            <a
                                href="?{{ Request::get('filterby') ? 'filterby=' . Request::get('filterby') . '&' : null }}sort=id&by={{ Request::get('by') && Request::get('by') == 'asc' ? 'desc' : 'asc' }}{{ Request::get('consumptions') ? '&consumptions=' . Request::get('consumptions') : null }}">
                                #</a>
                            @if (Request::get('by') && Request::get('sort') == 'id')
                                <i
                                    class="fas {{ Request::get('by') == 'asc' ? 'fa-sort-numeric-up' : 'fa-sort-numeric-down-alt' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th>
                            <a
                                href="?{{ Request::get('filterby') ? 'filterby=' . Request::get('filterby') . '&' : null }}sort=category_name&by={{ Request::get('by') && Request::get('by') == 'asc' ? 'desc' : 'asc' }}{{ Request::get('consumptions') ? '&consumptions=' . Request::get('consumptions') : null }}">
                                Category</a>
                            @if (Request::get('by') && Request::get('sort') == 'category_name')
                                <i
                                    class="fas {{ Request::get('by') == 'asc' ? 'fa-sort-alpha-up' : 'fa-sort-alpha-down-alt' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th>
                            <a
                                href="?{{ Request::get('filterby') ? 'filterby=' . Request::get('filterby') . '&' : null }}sort=amount&by={{ Request::get('by') && Request::get('by') == 'asc' ? 'desc' : 'asc' }}{{ Request::get('consumptions') ? '&consumptions=' . Request::get('consumptions') : null }}">
                                Consumption</a>
                            @if (Request::get('by') && Request::get('sort') == 'amount')
                                <i
                                    class="fas {{ Request::get('by') == 'asc' ? 'fa-sort-numeric-up' : 'fa-sort-numeric-down-alt' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody id="agtable">
                    @foreach ($consumptions as $consumption)
                        @if ($consumption['amount'] > $consumption['category']['budget'] && $consumption['category']['budget'] != 0)
                            <tr style="box-shadow: 0 0 5px red">
                                <th>{{ $consumption['id'] }}</th>
                                <td>{{ $consumption['category_name'] }}</td>
                                <td>$ {{ number_format($consumption['amount'], 2, ',', '.') }}</td>
                            </tr>
                        @else
                            <tr>
                                <th>{{ $consumption['id'] }}</th>
                                <td>{{ $consumption['category_name'] }}</td>
                                <td>$ {{ number_format($consumption['amount'], 2, ',', '.') }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex-start">{{ $consumptions->withQueryString()->links('vendor.pagination.bulma') }}</div>
        </div>
    </div>
    <div class="columns">
        <div class="column is-full">
            <h1 class="title">All transactions</h1>
            <table class="table text-left">
                <thead>
                    <tr>
                        <th>
                            <a
                            href="?{{ Request::get('filterby') ? 'filterby=' . Request::get('filterby') . '&' : null }}sort=type&by={{ Request::get('by') && Request::get('by') == 'asc' ? 'desc' : 'asc' }}{{ Request::get('transactions') ? '&transactions=' . Request::get('transactions') : null }}">
                            Type</a>
                        @if (Request::get('by') && Request::get('sort') == 'type')
                            <i
                                class="fas {{ Request::get('by') == 'asc' ? 'fa-sort-numeric-up' : 'fa-sort-numeric-down-alt' }}"></i>
                        @else
                            <i class="fas fa-sort"></i>
                        @endif
                        </th>
                        <th>
                            <a
                            href="?{{ Request::get('filterby') ? 'filterby=' . Request::get('filterby') . '&' : null }}sort=t_amount&by={{ Request::get('by') && Request::get('by') == 'asc' ? 'desc' : 'asc' }}{{ Request::get('transactions') ? '&transactions=' . Request::get('transactions') : null }}">
                            Amount</a>
                        @if (Request::get('by') && Request::get('sort') == 't_amount')
                            <i
                                class="fas {{ Request::get('by') == 'asc' ? 'fa-sort-numeric-up' : 'fa-sort-numeric-down-alt' }}"></i>
                        @else
                            <i class="fas fa-sort"></i>
                        @endif
                        </th>
                        <th>
                            <a
                            href="?{{ Request::get('filterby') ? 'filterby=' . Request::get('filterby') . '&' : null }}sort=t_category&by={{ Request::get('by') && Request::get('by') == 'asc' ? 'desc' : 'asc' }}{{ Request::get('transactions') ? '&transactions=' . Request::get('transactions') : null }}">
                            Category</a>
                        @if (Request::get('by') && Request::get('sort') == 't_category')
                            <i
                                class="fas {{ Request::get('by') == 'asc' ? 'fa-sort-alpha-up' : 'fa-sort-alpha-down-alt' }}"></i>
                        @else
                            <i class="fas fa-sort"></i>
                        @endif
                        </th>
                        <th>
                            <a
                            href="?{{ Request::get('filterby') ? 'filterby=' . Request::get('filterby') . '&' : null }}sort=date&by={{ Request::get('by') && Request::get('by') == 'asc' ? 'desc' : 'asc' }}{{ Request::get('transactions') ? '&transactions=' . Request::get('transactions') : null }}">
                            Date</a>
                        @if (Request::get('by') && Request::get('sort') == 'created_at')
                            <i
                                class="fas {{ Request::get('by') == 'asc' ? 'fa-sort-numeric-up' : 'fa-sort-numeric-down-alt' }}"></i>
                        @else
                            <i class="fas fa-sort"></i>
                        @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            @switch($transaction['type'])

                                @case('income')
                                    <td class="green">{{ $transaction['type'] }}</td>
                                    <td>$ +{{ number_format($transaction['t_amount'], 2, ',', '.') }}</td>
                                @break

                                @case('consumption')
                                    <td class="red">{{ $transaction['type'] }}</td>
                                    <td>$ -{{ number_format($transaction['t_amount'], 2, ',', '.') }}</td>
                                @break

                            @endswitch
                            @if ($transaction['t_category'])
                               <td> {{ $transaction['t_category'] }} </td>
                               @else
                               <td> - </td>
                            @endif
                            <td>{{ $transaction['date'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex-start">{{ $transactions->withQueryString()->links('vendor.pagination.bulma') }}</div>
        </div>
    </div>
@endsection
