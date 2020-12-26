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
      <h3 align="center" class="pb-4"><b>JOINING LETTER</b></h3>
    </td>
  </tr>
  <tr>
    <td class="p-3">
      <h6><b>Dear {{ $user->name }}</b></h6>
      <p class="pt-3">
        We are pleased to offer you the full-time position of {{ $user->designation->title }} 
        at BinBytes with a starting from {{ date('jS F Y', strtotime($user->joining_date))}}.
      </p>
      <p>
      It is in our opinion that your abilities and experience will be the perfect fit for 
      our company.In this role, you will build and maintain low latency, high performance 
      scalable systems, design, implement, and scale new APIs, aggregation services, and 
      data centric microservices, and solve interesting scaling problems.
      </p>
      <p>The starting annual salary for this position is {{ $user->base_salary * 12 }} INR to be paid on a monthly basis.</p>
      <p>
      By signing and returning this letter you will confirm your acceptance of the offer. 
      Please respond no later than {{ date('jS F Y', strtotime($user->joining_date))}}.
      </p>
      <p>
      We look forward to having you on our team! If you have any questions, please feel free to reach out at your earliest convenience.
      </p>
      <p class="mb-5">We wish all the best in all future endeavors.</p>
    </td>
  </tr>
@endsection
@section('footer')
  @include('letter._footer')
@endsection
