NO ACTION Had Been Taken on New

    @if ($contact->contact_type_id == 1)
        <u>Lead</u>
    @elseif ($contact->contact_type_id == 2)
        <u>Opportunity</u>
    @elseif ($contact->contact_type_id == 3)
        <u>Customer</u>
    @endif

Company: {{ $company->name }}

Contact Details:

Name: {{ $contact->first_name }} {{ $contact->last_name }}
Email: {{ $contact->email }}
Phone: {{ $contact->phone }}

Billing Details:

Street: {{ $billing->street }} @if ($billing->suite) {{ $billing->suite }} @endif
City: {{ $billing->city }}
State:{{ $billing->state }}
Zip: {{ $billing->zip }}

Delivery Details:

Street: {{ $delivery->street }} @if ($delivery->suite) {{ $delivery->suite }} @endif
City: {{ $delivery->city }}
State: {{ $delivery->state }}
Zip: {{ $delivery->zip }}
