@extends('vendor.app')
@section('content')
    <div>
        <table class="table table-hover" id="table_id">
            <thead style="background-color: #393A42">
                <tr>
                    <th>Scan QR Code</th>
                </tr>
            </thead>

           {{-- deliveries = DB::table('deliveries')->get(); --}}

            <tbody class="table-border-bottom-0">
                 {{-- @if(count($deliveries) > 0)  --}}
                @foreach ($deliveries as $key => $delivery)
                    <tr>
                        <td>
                            <a href="{{ route('vendor.scan-qr-code', $delivery->id) }}">Scan QR Code</a>
                        </td>   
                    </tr>
                @endforeach
                {{-- @else --}}
                <tr>
                    <td colspan="1">No deliveries available</td>
                </tr>
            {{-- @endif --}}
                
            </tbody>
        </table>
    </div>
@endsection