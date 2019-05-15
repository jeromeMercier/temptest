@extends('layout')


@section('content')

<myjob-options options='{!!json_encode($options)!!}'></myjob-options>
@endsection
