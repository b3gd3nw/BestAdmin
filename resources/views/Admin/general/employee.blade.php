@extends('layouts.admin_layout')

@section('title', 'Employee')

@section('content')
    <div class="columns">
        <div class="column is-6">
            <button class="button is-medium is-fullwidth">Add member</button>
        </div>
        <div class="column is-6">
            <button class="button is-medium is-fullwidth">Send form on email</button>
        </div>
    </div>
    <div class="columns">
        <div class="column is-full">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Position</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
{{--                @foreach($categories as $category)--}}
{{--                    @if($category['amount'] > $category['category']['budget'])--}}
{{--                        <tr style="box-shadow: 0 0 5px red">--}}
{{--                            <th>{{ $category['category']['id'] }}</th>--}}
{{--                            <td>{{ $category['category']['name'] }}</td>--}}
{{--                            <td>$ {{ $category['amount'] }}</td>--}}
{{--                            <td>21.21.21</td>--}}
{{--                        </tr>--}}
{{--                    @else--}}
{{--                        <tr>--}}
{{--                            <th>{{ $category['category']['id'] }}</th>--}}
{{--                            <td>{{ $category['category']['name'] }}</td>--}}
{{--                            <td>$ {{ $category['amount'] }}</td>--}}
{{--                            <td>21.21.21</td>--}}
{{--                        </tr>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
