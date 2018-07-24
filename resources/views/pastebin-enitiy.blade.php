@extends('layouts.app')

@section('content')
                   Name =  {{ $pastebin->name }}
                   Text = {{ $pastebin->text }} <br>
@endsection
