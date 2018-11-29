@isset($credit_amount)
    <span class="text-success">{{ $credit_amount }}</span>
@endisset

@isset($debit_amount)
    <span class="text-danger">{{ $debit_amount }}</span>
@endisset

@isset($closing_balance)
    <span class="text-info">{{ $closing_balance }}</span>
@endisset

