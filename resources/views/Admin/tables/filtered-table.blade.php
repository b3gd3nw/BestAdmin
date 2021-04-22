@foreach($employes as $employee)
    <tr>
        <th>{{ $employee->id }}</th>
        <td>{{ $employee->firstname . ' ' . $employee->lastname }}</td>
        <td>{{ $employee->position }}</td>
        <td><a href="mailto:">{{ $employee->email }}</a></td>
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
        @switch($employee->status)

            @case('active')
            <td class="green">{{ $employee->status }}</td>
            @break

            @case('pending')
            <td class="orange">{{ $employee->status }}</td>
            @break

            @case('inactive')
            <td class="red">{{ $employee->status }}</td>
            @break

        @endswitch
        <td>
            @if($employee->status != 'inactive')
                <form action="{{ route('employee.destroy', $employee->id)  }}" method="POST">
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