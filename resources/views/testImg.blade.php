@include('layouts.header')
@include('layouts.nav')

<form action="{{url('testImg')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photo" id="">
    <input type="submit" value="submit">
</form>

@include('layouts.footer')