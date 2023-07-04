@extends('layout')
@section('containt')
  @section('extra-files')
    <script src="{{asset('js/custom.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Amount</th>
                    <th>Order Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recharges as $item)
                <tr>
                    <td>{{$item->uuid}}</td>
                    <td>{{$item->coin_id}}</td>
                    <td>{{$item->amount_paid}}</td>
                    <td>
                        @if($item->dummy_status == 0)
                        <form action="{{url('cancel/order')}}" method="post">
                            @csrf
                            <input type="hidden" name="recharge_id" value="{{$item->uuid}}">
                            <button class="btn btn-sm btn-warning">Pending</button>
                        </form>
                        @elseif($item->dummy_status == 1)
                        <button class="btn btn-sm btn-success">Delivered</button>
                        @elseif($item->dummy_status == 2)
                        <button class="btn btn-sm btn-danger">Cancel</button>
                        @endif
                    </td>
                    <td>{{$item->updated_at}}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection