<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Product Comparison</title>
 
 <style type="text/css" media="all">
       *{
           font-size: 14px;
           color: #444444;
       }
       .w-img{
        width:100px;
        padding-top: 20px;
        text-align: center;
       }
       .table-coparision-detail td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}
.table-coparision-detail .com-body tr {
    background-color: #f2f2f2;
   
    }
tbody > tr > td{
    width: 30%;
}
tbody >tr > td:first-child{
    width: 10%;
    color: #444444;
}
.head {background-color: #ddd;   border: none;}

.table-coparision-detail th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
.textcenter{
    text-align: center;
    padding: 10px;
    font-size: 24px;
}

.table-coparision-detail{
    width: 100%;
}
.comparison-list{
    background-color: #d9d9d9;
    padding-top: 1rem;
    padding-bottom: 1rem;
    border: 2px solid transparent;
    margin-left: 2px;
    margin-right: 2px;
    padding-left: 8px;
}
.text-title-twentyfour-delta{
    color: #0087DC;
    font-size: 16px;
    margin-top: 0;
    word-break: break-all;
}
.text-center.text-dark{
    font-size: 14px;
    margin: 0;
    word-break: break-all;
}
.texttype{
    text-align: center;
    font-size: 16px;
    padding: 5px;
}
.d-none{
    visibility: hidden;
    display:none;
}
 </style>
   <style type="text/css">
   
    
    * {
        font-family: 'DeltaSans';
    }
    </style>
</head>
<body >
    <div class="textcenter"> 
        PRODUCT COMPARISON
    </div>
    <div class="texttype">
       Type : {{$tyepname}} 
    </div>

    <table  class="table table-coparision-detail " style="border:0px;">
        <tbody>
            <tr>
                <td class="col-1 col-xs-3" >&nbsp;</td>
                @if(count($product1) > 0)
                <td class="col-xs-3" style="padding-bottom:0px; position:relative">
                    {{-- <img class="w-img" style=""   src="{{config('app.url')}}/upload/thumbs/{{$item->picture}}" alt="" > --}}
                <p class="text-center text-dark">{{$product1[0]->seName}}</p>
                    <p class="text-title-twentyfour-delta text-center">{{$product1[0]->pro_code}}</p>
                   
                </td>
                @else 
                <td class="col-xs-3" style="padding-bottom:0px; position:relative">
                    {{-- <img class="w-img" style=""   src="{{config('app.url')}}/upload/thumbs/{{$item->picture}}" alt="" > --}}
                <p class="text-center text-dark">-</p>
                    <p class="text-title-twentyfour-delta text-center">-</p>
                   
                </td>
                @endif
                @if(count($product2) > 0)
                <td class="col-xs-3" style="padding-bottom:0px; position:relative">
                    {{-- <img class="w-img" style=""   src="{{config('app.url')}}/upload/thumbs/{{$item->picture}}" alt="" > --}}
                <p class="text-center text-dark">{{$product2[0]->seName}}</p>
                    <p class="text-title-twentyfour-delta text-center">{{$product2[0]->pro_code}}</p>
                   
                </td>
                @else 
                <td class="col-xs-3" style="padding-bottom:0px; position:relative">
                    {{-- <img class="w-img" style=""   src="{{config('app.url')}}/upload/thumbs/{{$item->picture}}" alt="" > --}}
                <p class="text-center text-dark">-</p>
                    <p class="text-title-twentyfour-delta text-center">-</p>
                   
                </td>
                @endif

                @if(count($product3) > 0)
                <td class="col-xs-3" style="padding-bottom:0px; position:relative">
                    {{-- <img class="w-img" style=""   src="{{config('app.url')}}/upload/thumbs/{{$item->picture}}" alt="" > --}}
                <p class="text-center text-dark">{{$product3[0]->seName}}</p>
                    <p class="text-title-twentyfour-delta text-center">{{$product3[0]->pro_code}}</p>
                   
                </td>
                @else 
                <td class="col-xs-3" style="padding-bottom:0px; position:relative">
                    {{-- <img class="w-img" style=""   src="{{config('app.url')}}/upload/thumbs/{{$item->picture}}" alt="" > --}}
                <p class="text-center text-dark">-</p>
                    <p class="text-title-twentyfour-delta text-center">-</p>
                   
                </td>
                @endif

                </tr>       
        </tbody>
    </table>
    <?php  echo $contentCompare ?>
</body>

</html>
