@extends('letter.layoutletter')

@section('data')
  <tr>
    <td class="px-3 py-3">
      <table class="table table-borderless">
        <tr>
          <td class="logo pt-4">
            <img src="{{ url('images/logo.png') }}" alt="Logo" width="50">
          </td>
          <td>
            <b>BINBYTES</b>
            <p class="address mt-3">409-A, The Spire, 150ft Ring Road, Rajkot-360006, Gujarat, India.</p>
            <p class="address">Phone : (+91) 75670 72070 / (+91) 90330 90059</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="p-3">
      <h3 align="center" class="pb-4"><b>PROMOTION LETTER</b></h3>
    </td>
  </tr>
  <tr>
    <td class="p-3">
      <h6><b>Date : </b>{{ now()->format('jS F, Y') }}</h6>
      <h6><b>To : </b>{{ $user->name }}</h6>
      <p class="py-2">
        I have the pleasure to inform you that you have been promoted to {{ $user->designation->title }} in the share department of the company.
        You are required to take charge of the new assignment on {{ date('jS F Y', strtotime($user->designation->pivot->created_at))}}.
        Please accept my hearty congratulations on your promotion.
      </p>
      <p>Please acknowledge receipt of this letter.</p>
      <p>We wish all the best in all future endeavors.</p>
    </td>
  </tr>
@endsection
@section('footer')
  @include('letter._footer')
@endsection
