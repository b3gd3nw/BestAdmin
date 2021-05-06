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