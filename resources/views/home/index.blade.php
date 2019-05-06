@extends('layout')

@section('title')
Home

@endsection

@section('content')
<myjob-home publishers="{{$publishers}}" students={{$students}}></myjob-home>
@endsection
