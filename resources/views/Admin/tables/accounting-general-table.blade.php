@foreach($categories as $category)
    @if($category['amount'] > $category['category']['budget'] && $category['category']['budget'] != 0)
        <tr style="box-shadow: 0 0 5px red">
            <th>{{ $category['category']['id'] }}</th>
            <td>{{ $category['category']['name'] }}</td>
            <td>$ {{ number_format($category['amount'], 2,  ',', '.') }}</td>
        </tr>
    @else
        <tr>
            <th>{{ $category['category']['id'] }}</th>
            <td>{{ $category['category']['name'] }}</td>
            <td>$ {{ number_format($category['amount'], 2,  ',', '.') }}</td>
        </tr>
    @endif
@endforeach