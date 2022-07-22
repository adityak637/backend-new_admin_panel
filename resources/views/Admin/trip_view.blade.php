@extends('Admin.layout.master')
@section('content')
<div class="row mt-5">
    <div class="col-12">
    <div class="">
        <a class="btn  btn-sm btn-dark float-right" href="{{url('trip')}}">back</a>
        </div>
        </div>
    <div class="col-10 mx-auto card mb-2" >
        
        <table class="table table-responsive-lg">
            <tbody>
                <tr>
                    <td>Trveller Name</td>
                    <td> @if(!empty($Createtrip->traveller_id)){{$Createtrip->user->First_Name}} {{$Createtrip->user->Last_Name}} @endif</td>
                </tr>
                <tr>
                    <td>Trip Id</td>
                    <td> {{$Createtrip->trip_id}}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td> {{$Createtrip->name}}</td>
                </tr>
                <tr>
                    <td>Intro</td>
                    <td> {{$Createtrip->intro}}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td> {{$Createtrip->status}}</td>
                </tr>
                <tr>
                    <td>Trip Status</td>
                    <td> {{$Createtrip->trip_status}}</td>
                </tr>
                <tr>
                    <td>Type of Trip</td>
                    <td> {{$Createtrip->type_of_trip}}</td>
                </tr>
                <tr>
                    <td> Start Location</td>
                    <td> {{$Createtrip->start_location}}</td>
                </tr>
                <tr>
                    <td> End Location</td>
                    <td> {{$Createtrip->end_location}}</td>
                </tr>
                <tr>
                    <td> Start Date</td>
                    <td> {{$Createtrip->start_date}}</td>
                </tr>
                <tr>
                    <td> End Date</td>
                    <td> {{$Createtrip->end_date}}</td>
                </tr>
                <tr>
                    <td> Start Time</td>
                    <td> {{$Createtrip->start_time}}</td>
                </tr>
                <tr>
                    <td> End Time</td>
                    <td> {{$Createtrip->end_time}}</td>
                </tr>
                <tr>
                    <td> Duration</td>
                    <td> {{$Createtrip->duration}}</td>
                </tr>
                <tr>
                    <td> Advises</td>
                    <td> {{$Createtrip->advises}}</td>
                </tr>
                <tr>
                    <td> B Number</td>
                    <td> {{$Createtrip->B_number}}</td>
                </tr>
                <tr>
                    <td>Guidelines</td>
                    <td> {{$Createtrip->guidelines}}</td>
                </tr>
                <tr>
                    <td>Promo Code</td>
                    <td> {{$Createtrip->promo_code}}</td>
                </tr>
                <tr>
                    <td>Term and Conditions</td>
                    <td> {{$Createtrip->term_and_condition}}</td>
                </tr>
                <tr>
                    <td>Booking Close</td>
                    <td> {{$Createtrip->booking_close}}</td>
                </tr>
                <tr>
                    <td>Cost</td>
                    <td> {{$Createtrip->cost}}</td>
                </tr>
                <tr>
                    <td>Cover Photo</td>
                    <td> <img class="w-50" src="{{asset('cover_photo').'/'.$Createtrip->cover_photo}}" ></td>
                </tr>
                <tr>
                    <td>Thumbnail</td>
                    <td> <img class="w-50" src="{{asset('thumbnail_photo').'/'.$Createtrip->thumbnail_photo}}" ></td>
                </tr>
                @if(!@empty($Createtrip->locationImage->image))
                <tr>
                    <td>Location Image</td>
                    <td> <img class="w-50" src="{{asset('location_image').'/'.$Createtrip->locationImage->image}}" ></td>
                </tr>
                @endif
            </tbody>
        </table>

        
    </div>
    <div class="col-11 mx-auto card p-3 mt-5">
            <h4 class="p-3" style="font-family: initial;">Details Search</h4>
            <form  method="post" action="{{url('/trip_details_serach').'/'.$Createtrip->id}}" >
           @csrf
            <div class="row mx-auto">
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="uname" class="form-control" placeholder="Username"  value="{{$uname ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="email"  value="{{$email ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="mobile" class="form-control" placeholder="mobile"  value="{{$mobile ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
               <select class="form-control" name="booking_status" >
                   @php
                       $booking_status=$booking_status ?? '';
                   @endphp
                   <option value="" @if($booking_status=='') selected @endif>Booking Status</option>
                   <option value="pending" @if($booking_status=='pending') selected @endif>Pending</option>
                   <option value="1" @if($booking_status==1) selected @endif>Success</option>
                   <option value="2" @if($booking_status==2) selected @endif>Cancel</option>
               </select>
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="transaction" class="form-control" placeholder="transaction"  value="{{$transaction ?? ''}}">
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
               <a class="btn btn-sm btn-dark" href="{{url('/trip_view').'/'.$Createtrip->id}}" type="submit">Reset</a>
            </div><!-- //form-group -->  </div>
        </div>
        </div>
        </div>
        </form>
        </div>
    <div class="col-11 mx-auto card mb-2" >
        <h3 class="p-3">User Booking Details</h3>
        <table class="table table-responsive-lg">
            <tr>
                <th>User_Name</th>
                <th>User_Email</th>
                <th>User_Mobile</th>
                <th>Booking_Status</th>
                <th>transaction_id</th>
                <th>Refunds</th>
                <th>Count</th>
            </tr>
            <tbody>
                @foreach ($Booking as $item)
                    <tr>
                        <td>{{$item->users->firstname}} {{$item->users->firstname}}</td>
                        <td>{{$item->users->email}}</td>
                        <td>{{$item->users->mobile}}</td>
                        <td>{{$item->transaction_status}}</td>
                        <td>@if (!empty($item->transaction_id))
                            {{$item->transaction_id}}
                            @else
                            Null
                        @endif</td>
                        <td>-</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" onclick="show_user_booking_details('{{$item->id}}');">
  {{count($item->trip)}}
</button>
                        </td>
                        
                  </tr>
                @endforeach
                
                  <tfoot>
                      <tr>
                          <td colspan="8">
                              {{$Booking->links()}}
                          </td>
                      </tr>
                  </tfoot>
            </tbody>
        </table>

        
    </div>
    <!-- Button trigger modal -->


<!-- Modal -->
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
@endsection