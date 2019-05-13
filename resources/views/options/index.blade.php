@extends('layout')

@section('title')
Option

@endsection

@section('content')

<myjob-options options='{!!json_encode($options)!!}'></myjob-options>
@endsection
