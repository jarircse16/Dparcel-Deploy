<h1>This is Cutomer Page</h1> - {{ Auth::user()->username }}



<form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
    @csrf
   
    <button type="submit">Logout</button>
</form>