@extends('layouts.app')

@section('content')
               <h1>Users pastebin</h1>
               @foreach ($pastebins as $pastebin)
                   Name =  {{ $pastebin->name }}
                   Text = {{$pastebin->text}} <br>
               @endforeach
    {{$pastebins->links()}}
@endsection
