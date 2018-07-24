@extends('layouts.app')

@section('content')
               <form action="{{url('pastebin')}}" method="post">
                   {{ csrf_field() }}
                   <label for="name">Name pastebin</label><input type="text" id="name" name="name">
                   <label for="text">Text pastebin</label><textarea id="text" name="text"></textarea>
                   <label>Select language
                       <select name="language">
                           <option value="java">Java</option>
                           <option value="php">Php</option>
                       </select>
                   </label>
                   <label>Select term
                       <select name="term">
                           <option value="10M">10 minut</option>
                           <option value="1H">1 hour</option>
                           <option value="3H">3 hour</option>
                           <option value="1D">1 day</option>
                           <option value="1W">1 week</option>
                           <option value="1M">1 month</option>
                           <option value="N">Not limit</option>
                       </select>
                   </label>
                   <label>Select access
                       <select name="access">
                           <option value="public">public</option>
                           <option value="unlisted">unlisted</option>

                              @if( Auth::check() )
                           <option value="private">private</option>
                               @endif
                       </select>
                   </label>
                   <button type="submit">Save pastebin</button>
               </form>


               <h1>Public pastebin</h1>
               @foreach ($pastebins as $pastebin)
                   Name =  {{ $pastebin->name }}
                   Text = {{$pastebin->text}} <br>
               @endforeach

               @if( Auth::check() )
                   Current user: {{ Auth::user()->name }}
                   <h1>Last pastebin</h1>
                   @foreach ($pastebinsRegisterUser as $pastebin)
                       Name =  {{ $pastebin->name }}
                       Text = {{$pastebin->text}} <br>
                   @endforeach
               @endif





@endsection
