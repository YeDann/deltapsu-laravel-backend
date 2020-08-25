{{-- @extends('layouts.front-end')

@section('css')
<style>
#savethis{
    flex-wrap: unset;
}
.summary-subbody{
    width: 100%;
}
 .text-summary{
    width: 50%;
 }
 .img-summary{
    width: 50%;
 }
</style>
@endsection
@section('container')

@endsection--}}
{{-- <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('/frontend-asset/css/header-front.css')}}">
        <link rel="stylesheet" href="{{asset('/frontend-asset/css/container.css')}}">
        <link rel="stylesheet" href="{{asset('/frontend-asset/css/home.css')}}">
        <link rel="stylesheet" href="{{asset('/frontend-asset/css/product.css')}}">
    </head>
    <body>
        
    </body>
</html> --}}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"  rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('/frontend-asset/css/header-front.css')}}"  rel="stylesheet" type="text/css" media="all"/>
        <link rel="stylesheet" href="{{asset('/frontend-asset/css/container.css')}}"  rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('/frontend-asset/css/home.css')}}"  rel="stylesheet" type="text/css" media="all"/>
        <link rel="stylesheet" href="{{asset('/frontend-asset/css/product.css')}}"  rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
<?php echo $datahtml  ?>
 
</body>
</html>