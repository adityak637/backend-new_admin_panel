@extends('Admin.layout.master')
@section('content')
<div class="row mt-5 mx-auto">
        <div class="col-12 card">
            <div class="mt-2">
            <h3 class="" style="font-family: cursive;">User Profile</h3>
            <a href="{{url('/user')}}" class="btn btn-sm float-right btn-dark ">Back</a>
            </div>
            <div class="pt-4">
                <div class="row">
                    <div class="col-9" >
                    <table class="table table-responsive-lg">
                        <tbody>
                            <tr>
                                <td>First_name</td>
                                <td>{{$User->firstname}}</td>
                            </tr>
                            <tr>
                                <td>Last_name</td>
                                <td>{{$User->lastname}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$User->email}}</td>
                            </tr>
                            <tr>
                                <td>D.O.B</td>
                                <td>{{$User->dob}}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{$User->mobile}}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$User->city}}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>{{$User->country}}</td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td>{{$User->pin_code}}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="col-2" style="border:2px solid black; height:200px;">
                        <div class="">
                        <img src="{{asset('User')}}/{{$User->profile}}" style="height: 190px;" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 card p-3 mt-5">
            <h4 class="p-3" style="font-family: initial;">Details Search</h4>
            <form  method="post" action="{{url('/user_details_serach').'/'.$User->id}}" >
           @csrf
            <div class="row mx-auto">
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="trip_id" class="form-control" placeholder="Trip id"  value="{{$trip_id ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="transaction_status" class="form-control" placeholder="transaction_status"  value="{{$transaction_status ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="Transaction_id" class="form-control" placeholder="Transaction_id"  value="{{$Transaction_id ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="total_cost" class="form-control" placeholder="total_cost"  value="{{$total_cost ?? ''}}">
            </div><!-- //form-group -->  
        </div>
              
        <div class="col-lg-3 col-11">
            <div class="row">
                <div class="col-6">
           <div class="form-group">
               <button class="btn btn-sm btn-danger"  type="submit">Search</button>
            </div><!-- //form-group -->  </div>
           <div class="col-6">
           <div class="form-group">
               <a class="btn btn-sm btn-dark" href="{{url('/user_view').'/'.$User->id}}" type="submit">Reset</a>
            </div><!-- //form-group -->  </div>
        </div>
        </div>
        </div>
        </form>
        </div>
        <div class="col-12 card  mb-5">
            
            <h4 class="p-3">User Transaction</h4>
            <table class="table table-responsive-lg">
                <thead>
                    <tr>
                        <th>Trip_id</th>
                        <th>Transaction Status</th>
                        <th>Transaction_id</th>
                        <th>Total Cost</th>
                        <th>Discount Price</th>
                        <th>Refunds</th>
                        <th>Trip_users</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Booking as $item)
                         <tr>
                            <th>{{$item->tripdetails->trip_id}}</th>
                            <th>{{$item->transaction_status}}</th>
                            <th>{{$item->transaction_id}}</th>
                            <th>{{$item->total_cost}}</th>
                            <th>{{$item->discount_price}}</th>
                            <th>-</th>
                            <th>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="show_user_booking_details('{{$item->id}}');">
  {{count($item->trip)}}
</button>
                            </th>
                    </tr>
                    @endforeach
                   
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                {{$Booking->links()}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

{{-- model --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Users Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="">
          <table class="table table-responsive-lg">
              <tr>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Price</th>
              </tr>
              <tbody class="" id="modalbodys" >
                
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    function show_user_booking_details(id){
        $("#exampleModal").modal('show');
         
        $.ajax({
            'url':"{{url('user_booking_fetch')}}",
            'type':"get",
            'data':{id},
            success: function(data) {
              var datas=data.data.length;
            $("#modalbodys").empty();
             for(i=0; i<datas; i++){
                 
            $('#modalbodys').append("<tr><td>" + data.data[i].name + "</td><td>" + data.data[i].age + "</td><td>" + data.data[i].price + "</td></tr>");
            }
            
            
          }


        });
       
    }
</script>

</div>
@endsection