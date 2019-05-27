@extends('layouts.app')

@section('page_title', 'Company Profile')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Company Profile</div>

                    <div class="card-body"><br>
                        ID: {{ $company->id  }}
                        Name: {{ $company->name }}<br>
                        Database: {{ $company->database }} <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
