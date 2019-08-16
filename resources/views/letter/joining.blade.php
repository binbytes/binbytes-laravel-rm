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
    <td class="px-3"><hr></td>
  </tr>
  <tr>
    <td class="p-3">
      <h3 align="center" class="pb-4"><b>JOINING LETTER</b></h3>
    </td>
  </tr>
  <tr>
    <td class="p-3">
      <h6><b>Date : </b>{{ now()->format('jS F, Y') }}</h6>
      <h6><b>To : </b>{{ $user->name }}</h6>
      <p class="pt-3">
        This is to certify that {{ $user->name }} was working in our company from {{ date('jS F Y', strtotime($user->joining_date))}}
        to {{ date('jS F Y', strtotime($user->leaving_date))}} and last position achieved in our organization was {{ $user->designation->title }}.
      </p>
      <p>{{ $user->name }} rendered his services with great responsibility and professional attitude.</p>
      <p class="mb-5">We wish all the best in all future endeavors.</p>
      <h6>Warm Regards,</h6>
      <p>BinBytes, Rajkot</p>
    </td>
  </tr>
  @include('letter._footer')
@endsection
