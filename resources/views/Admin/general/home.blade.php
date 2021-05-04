@extends('layouts.admin_layout')

@section('title', 'Main')

@section('content')
        <div class="columns">
            <div class="column is-4">
                <div class="card has-background-primary hoverable">
                    <div class="card-content">
                        <p class="title" id="balance">
                            $ {{ number_format($bank_amount, 2,  ',', '.') }}
                        </p>
                        <p class="subtitle">
                            Current balance
                        </p>
                    </div>
                </div>
            </div>
            <div class="column is-4">
                <div class="card has-background-link">
                    <div class="card-content">
                        <p class="title">
                            $ {{ number_format($budget, 2,  ',', '.') }}
                        </p>
                        <p class="subtitle">
                            Monthly budget
                        </p>
                    </div>
                </div>
            </div>
            <div class="column is-4">
                <div class="card has-background-danger">
                    <div class="card-content">
                        <p class="title">
                            $ {{ number_format($consumptions, 2,  ',', '.') }}
                        </p>
                        <p class="subtitle">
                            Current expenses per month
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column is-full">
                <h1 class="title">Employes</h1>
                <table class="table text-left">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Skills</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($employes as $employee)
                        <tr>
                            <th>{{ $employee['id'] }}</th>
                            <td>{{ $employee['firstname'] . ' ' . $employee['lastname'] }}</td>
                            <td>{{ $employee['position'] }}</td>
                            <td><a href="mailto:">{{ $employee['email'] }}</a></td>
                            <td>
                                @foreach($employee_skills as $employee_skill)
                                    @if($employee->id === $employee_skill->employeeId)
                                        @foreach($skills as $skill)
                                            @if($employee_skill->skillId === $skill->id)
                                                <span class="tag">{{ $skill->name }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection
