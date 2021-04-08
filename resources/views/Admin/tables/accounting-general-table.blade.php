@foreach($categories as $category)
    @if($category['amount'] > $category['category']['budget'])
        <tr style="box-shadow: 0 0 5px red">
            <th>{{ $category['category']['id'] }}</th>
            <td>{{ $category['category']['name'] }}</td>
            <td>$ {{ $category['amount'] }}</td>
            <td>21.21.21</td>
        </tr>
    @else
        <tr>
            <th>{{ $category['category']['id'] }}</th>
            <td>{{ $category['category']['name'] }}</td>
            <td>$ {{ $category['amount'] }}</td>
        </tr>
    @endif
@endforeach