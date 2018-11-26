@extends('letter.layoutletter')

@section('data')
    <tr>
        <td class="heading">
            <h3 class="center py-4"><u>PROMOTE LETTER</u></h3>
        </td>
    </tr>
    <tr>
        <td class="letter">
            <h6>Date : {{ now()->format('jS F, Y') }}</h6>
            <h6>To : {{ $user->name }}</h6>
            <p class="py-2">
                I have the pleasure to inform you that you have been promoted to {{ $user->designation->title }} in the share department of the company.
                You are required to take charge of the new assignment on {{ date('jS F Y', strtotime($user->designation->pivot->created_at))}}.
                Please accept my hearty congratulations on your promotion.
            </p>
            <p>Please acknowledge receipt of this letter.</p>
            <p>We wish all the best in all future endeavors.</p>
            <h6>Warm Regards,</h6>
            <p>BinBytes, Rajkot</p>
        </td>
    </tr>
    @include('letter._footer')
@endsection
