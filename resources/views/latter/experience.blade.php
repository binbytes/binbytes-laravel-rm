@extends('latter.layoutlatter')

@section('data')
    <tr>
        <td colspan="2">
            <div class="p-5">
                <div class="row justify-content-center">
                    <h3 class="heading py-5"><u>TO WHOM IT MAY CONCERN</u></h3>
                </div>
                <div class="latter py-5">
                    <div class="pb-5">
                        <h6>Date : {{ now()->format('jS F, Y') }}</h6>
                        <h6>To : {{ $user->name }}</h6>
                        <p class="py-3">
                            This is to certify that {{ $user->name }} was working in our company from {{ date('jS F Y', strtotime($user->joining_date))}}
                            to {{ date('jS F Y', strtotime($user->leaving_date))}} and last position achieved in our organization was {{ $user->designation }}.
                        </p>
                        <p>
                            {{ $user->name }} rendered his services with great responsibility and professional attitude.
                        </p>
                        <p>
                            We wish all the best in all future endeavors.
                        </p>
                    </div>
                    <div class="py-5">
                        <h6>WarmRegards,</h6>
                        <p>BinBytes, Rajkot</p>
                    </div>
                    <div class="py-5">
                        <div style="width: 150px;">
                            <hr>
                        </div>
                        <p>Management Team</p>
                    </div>
                </div>
            </div>
        </td>
    </tr>
@endsection
