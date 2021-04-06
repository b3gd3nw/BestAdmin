@extends('layouts.admin_layout')

@section('title', 'Employee')

@section('content')
    <div class="modal" id="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title" id="modal-title">Create New Employee</p>
                <button class="delete" aria-label="close" id="modalClose"></button>
            </header>
            <section class="modal-card-body">

            </section>
        </div>
    </div>
    <div class="columns">
        <div class="column is-6">
            <button data-path="{{ route('employee.index') }}" class="button is-medium is-fullwidth" id="add_employee">Add employee</button>
        </div>
        <div class="column is-6">
            <button data-path="{{ route('showSendForm') }}" class="button is-medium is-fullwidth" id="send_mail">Send form on email</button>
        </div>
    </div>
    <div class="columns">
        <div class="column is-full">
            <div class="dropdown is-hoverable">
                <div class="dropdown-trigger">
                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu4">
                        <span>Filter by</span>
                        <span class="icon is-small">
                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
                <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                    <div class="dropdown-content">
                        <div class="dropdown-item">
                            <a data-path="{{ route('filterBy', 'active') }}" id="filter_active">Active</a>
                        </div>
                        <div class="dropdown-item">
                            <a data-path="{{ route('filterBy', 'pending') }}" id="filter_pending">Pending</a>
                        </div>
                        <div class="dropdown-item">
                            <a data-path="{{ route('filterBy', 'inactive') }}" id="filter_inactive">Inactive</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column is-full">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="tbody">
                @foreach($employes as $employee)
                        <tr>
                            <th>{{ $employee['id'] }}</th>
                            <td>{{ $employee['firstname'] . ' ' . $employee['lastname'] }}</td>
                            <td>{{ $employee['position'] }}</td>
                            <td><a href="mailto:">{{ $employee['email'] }}</a></td>
                            @switch($employee['status'])

                                @case('active')
                                <td class="green">{{ $employee['status'] }}</td>
                                @break

                                @case('pending')
                                <td class="orange">{{ $employee['status'] }}</td>
                                @break

                                @case('inactive')
                                <td class="red">{{ $employee['status'] }}</td>
                                @break

                            @endswitch
                            <td>
                                @if($employee['status'] != 'inactive')
                                <form action="{{ route('employee.destroy', $employee['id'])  }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger is-rounded is-small">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
