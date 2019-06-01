@extends('letter.layoutletter')

@section('data')
    <tr>
        <td class="heading">
            <h3 class="center py-4">JOINING LETTER</h3>
        </td>
    </tr>
    <tr>
        <td class="letter">
            <h6>Date : {{ now()->format('jS F, Y') }}</h6>
            <h6>To : {{ $user->name }}</h6>
            <p class="py-2">
            This is to certify that {{ $user->name }} was working in our company from {{ date('jS F Y', strtotime($user->joining_date))}}
            to {{ date('jS F Y', strtotime($user->leaving_date))}} and last position achieved in our organization was {{ $user->designation->title }}.
            </p>
            <p>{{ $user->name }} rendered his services with great responsibility and professional attitude.</p>
            <p>We wish all the best in all future endeavors.</p>
            <h6>Warm Regards,</h6>
            <p>BinBytes, Rajkot</p>
        </td>
    </tr>
    @include('letter._footer')
@endsection
