<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('files/bootstrap.css')}}">
</head>
<body>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('welcome')}}">Home</a>
              </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link">{{Auth::user()->name}}</a>
                </li>
            </ul>
            <form class="d-flex" method="POST" action="{{route('logout')}}">
                @csrf
              <button class="btn btn-outline-success" type="submit">Logout</button>
            </form>
          </div>
        </div>
      </nav>  
      <section class="py-5">
        <div class="row g-0">
            <div class="col-12">
              <table class="table table-bordered table-striped">
                <thead>
                  <th>#</th>
                  <th>Subject</th>
                  <th>Description</th>
                  <th>Action</th>
                  <th>User</th>
                  <th>Created_at</th>
                </thead>
                <tbody>
                  @foreach ($tickets as $key=>$ticket)
                  <tr class="ticket" data-id="{{$ticket->id}}">
                    <td>{{$key+1}}</td>
                    <td>{{$ticket->subject}}</td>
                    <td>{{$ticket->desc}}
                      @if ($ticket->response)
                      <p class="border border-2 bg-secondary text-white">{{$ticket->response->response_text}}</p>
                      @endif                      
                    </td>
                    <td>
                        <a class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticmodal" id="responsemodal">Respond</a>
                      @if ($ticket->status=='open')
                        <a class="closeticket btn btn-danger btn-sm cursor-pointer">Close</a>
                        @else
                        <a class="openticket btn btn-success btn-sm cursor-pointer">Open</a>
                    @endif
                  </td>
                  <td class="userinfo" data-id="{{$ticket->user->id}}">
                    {{$ticket->user->name}} | {{$ticket->user->email}}
                  </td>
                  <td>
                    {{$ticket->created_at->diffForHumans()}}
                  </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>    
    </section>  
<!-- Modal -->
<div class="modal fade"  id="staticmodal" data-bs-backdrop="static" data-bs-keyboard="false"
tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
    <script src="{{asset('files/jquery.min.js')}}"></script>
    <script src="{{asset('files/bootstrap5.3.3.min.js')}}"></script>
    @include('admin.script');
</body>
</html>