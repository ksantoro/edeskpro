@if ($contact->contact_type_id == 1)
    <u>Lead</u>
@elseif ($contact->contact_type_id == 2)
    <u>Opportunity</u>
@elseif ($contact->contact_type_id == 3)
    <u>Customer</u>
@endif

Has Been Deleted/Archived

Company: {{ $company->name }}

Contact Details:

Name: {{ $contact->first_name }} {{ $contact->last_name }}
Email: {{ $contact->email }}
Phone: {{ $contact->phone }}
