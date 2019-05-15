@extends('layout')

@section('content')
<myjob-new-ad contact='{!!json_encode($contact)!!}'></myjob-new-ad>
@endsection
