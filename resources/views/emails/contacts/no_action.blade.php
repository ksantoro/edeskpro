@extends('emails.main')
@section('email_content')

    <h3 style='color:#0cc;font-weight:100;'>

        NO ACTION Had Been Taken on New

        @if ($contact->contact_type_id == 1)
            <u>Lead</u>
        @elseif ($contact->contact_type_id == 2)
            <u>Opportunity</u>
        @elseif ($contact->contact_type_id == 3)
            <u>Customer</u>
        @endif

    </h3>
    <div style='float:left'>
        <b>Company:</b> {{ $company->name }}
    </div>
    <div style="float:right">
        <a href='{{ URL::to('/contacts') }}/{{ $contact->id }}' target='_blank' style='float:right;font-size:0.9em;color:#00CCCC;'>View Contact in eDeskPro</a>
    </div>
    <div style='clear:both;'></div>

    <br>

    <div style='width:100%;background:#ecf0f2;line-height:1.5em;'>
        <div style='width:100%;background:#36454f;color:#fff;padding:10px 0px 10px 0px;text-align:center;'>Contact Details</div>
        <div style='padding:10px;'>
            <b>Name:</b> {{ $contact->first_name }} {{ $contact->last_name }}
            <br>
            <b>Email:</b> <a href='mailto:{{ $contact->email }}'>{{ $contact->email }}</a>
            <br>
            <b>Phone:</b> <a href='tel:{{ $contact->phone }}'>{{ $contact->phone }}</a>
        </div>
    </div>

    <br>

    <div style='width:100%;background:#ecf0f2;line-height:1.5em;'>
        <div style='width:100%;background:#36454f;color:#fff;padding:10px 0px 10px 0px;text-align:center;'>Billing Details</div>
        <div style='padding:10px;'>
            <b>Street:</b> {{ $billing->street }} @if ($billing->suite) {{ $billing->suite }} @endif
            <br>
            <b>City:</b> {{ $billing->city }}
            <br>
            <b>State:</b> {{ $billing->state }}
            <br>
            <b>Zip:</b> {{ $billing->zip }}
        </div>
    </div>

    <br>

    <div style='width:100%;background:#ecf0f2;line-height:1.5em;'>
        <div style='width:100%;background:#36454f;color:#fff;padding:10px 0px 10px 0px;text-align:center;'>Delivery Details</div>
        <div style='padding:10px;'>
            <b>Street:</b> {{ $delivery->street }} @if ($delivery->suite) {{ $delivery->suite }} @endif
            <br>
            <b>City:</b> {{ $delivery->city }}
            <br>
            <b>State:</b> {{ $delivery->state }}
            <br>
            <b>Zip:</b> {{ $delivery->zip }}
        </div>
    </div>

    <br>

@endsection
