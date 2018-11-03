@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <table class="table table-bordered">
            <tr class="heading">
                <td colspan="2">
                    <div class="row justify-content-center align-items-center">
                        <div class="logo" style="left: 100px; position: absolute;">
                            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNDEgMTc2LjU2Ij48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6IzkzNWJjOTt9PC9zdHlsZT48L2RlZnM+PHRpdGxlPkFzc2V0IDI8L3RpdGxlPjxnIGlkPSJMYXllcl8yIiBkYXRhLW5hbWU9IkxheWVyIDIiPjxnIGlkPSJMYXllcl8xLTIiIGRhdGEtbmFtZT0iTGF5ZXIgMSI+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNzUuMSw0NWE2NS41NCw2NS41NCwwLDAsMC0yNC43Niw0Ljg4bC0uMTEsMzUuNzItMjIuNjgtLjA3YTE3LjM2LDE3LjM2LDAsMCwwLTE3LjIsMTQuNTJBNjUuNzYsNjUuNzYsMCwxLDAsNzUuMSw0NVptLS4zMiw5MC44NWEyNS4wOCwyNS4wOCwwLDAsMS0yNC41LTI0LjY0YzAtLjE3LDAtLjM0LDAtLjUxbC4xOC0yNSwyMi42OC4wN2gwYTI1LjkxLDI1LjkxLDAsMCwxLDcuNDYuNDMsMjQuNzcsMjQuNzcsMCwwLDEsMTkuMzQsMTkuNDZBMjUuMTEsMjUuMTEsMCwwLDEsNzQuNzgsMTM1Ljg5WiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTUwLjE1LDI0LjQ4QTI1LjA5LDI1LjA5LDAsMSwwLC41NCwzMC4zNCwyNC43NywyNC43NywwLDAsMCwyMCw0OS42N2EyNS45MSwyNS45MSwwLDAsMCw3LjQ3LjM4aDBMNTAuMTUsNTBWMjVDNTAuMTYsMjQuODIsNTAuMTYsMjQuNjUsNTAuMTUsMjQuNDhaIi8+PC9nPjwvZz48L3N2Zz4=" alt="Logo" width="70">
                            <h5>BINBYTES</h5>
                        </div>
                        <div class="text-center">
                            <h5 class="title">BINBYTES</h5>
                            <h6>213, Nakshatra 7,</h6>
                            <h6>Raiya Road,</h6>
                            <h6>Rajkot - 360005</h6>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
            @yield('data')
        </table>
    </div>
    <footer class="mt-auto">
        <hr>
        <div class="row justify-content-center">
            <div class="col-3 text-center">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNDEgMTc2LjU2Ij48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6IzkzNWJjOTt9PC9zdHlsZT48L2RlZnM+PHRpdGxlPkFzc2V0IDI8L3RpdGxlPjxnIGlkPSJMYXllcl8yIiBkYXRhLW5hbWU9IkxheWVyIDIiPjxnIGlkPSJMYXllcl8xLTIiIGRhdGEtbmFtZT0iTGF5ZXIgMSI+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNzUuMSw0NWE2NS41NCw2NS41NCwwLDAsMC0yNC43Niw0Ljg4bC0uMTEsMzUuNzItMjIuNjgtLjA3YTE3LjM2LDE3LjM2LDAsMCwwLTE3LjIsMTQuNTJBNjUuNzYsNjUuNzYsMCwxLDAsNzUuMSw0NVptLS4zMiw5MC44NWEyNS4wOCwyNS4wOCwwLDAsMS0yNC41LTI0LjY0YzAtLjE3LDAtLjM0LDAtLjUxbC4xOC0yNSwyMi42OC4wN2gwYTI1LjkxLDI1LjkxLDAsMCwxLDcuNDYuNDMsMjQuNzcsMjQuNzcsMCwwLDEsMTkuMzQsMTkuNDZBMjUuMTEsMjUuMTEsMCwwLDEsNzQuNzgsMTM1Ljg5WiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTUwLjE1LDI0LjQ4QTI1LjA5LDI1LjA5LDAsMSwwLC41NCwzMC4zNCwyNC43NywyNC43NywwLDAsMCwyMCw0OS42N2EyNS45MSwyNS45MSwwLDAsMCw3LjQ3LjM4aDBMNTAuMTUsNTBWMjVDNTAuMTYsMjQuODIsNTAuMTYsMjQuNjUsNTAuMTUsMjQuNDhaIi8+PC9nPjwvZz48L3N2Zz4=" alt="Logo" width="40">
                <h5 class="heading">BinBytes</h5>
            </div>
            <div class="col-9">
                <h5>Office No - 213, Nakshatra 7, Raiya Road, Rajkot-360005, Gujarat, India.</h5>
                <h5>info@binbytes.com - Website : www.BinBytes.com</h5>
                <h5>Phone : (+91) 75670 72070 / (+91) 90330 90059</h5>
            </div>
        </div>
    </footer>
@endsection