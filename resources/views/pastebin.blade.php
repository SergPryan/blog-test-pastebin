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
                           <option value="10M">10M</option>
                           <option value="1H">1H</option>
                           <option value="3H">3H</option>
                           <option value="1D">1D</option>
                           <option value="1W">1W</option>
                           <option value="1M">1M</option>
                           <option value="N">N</option>
                       </select>
                   </label>
                   <label>Select access
                       <select name="access">
                           <option value="public">public</option>
                           <option value="unlisted">unlisted</option>
                           <option value="private">private</option>
                       </select>
                   </label>
                   <button type="submit">Save pastebin</button>
               </form>

@endsection
