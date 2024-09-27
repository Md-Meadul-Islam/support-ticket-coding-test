<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer | Dashboard</title>
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
      <section class="p-3">
       <div class="row g-0">
        <div class="col-12">
          <div class="card p-2">
            <div class="w-100">
              <h2>Open New Ticket</h2>
            </div>
            <form action="{{route('createticket')}}" method="post">
              @csrf
              @method('POST')
              <div class="py-1">
                <label for="subject">Subject</label>
              <input type="text" name="subject" id="subject" class="form-control" placeholder="Please mention subject">
              </div>
              <div class="py-1">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" class="form-control"></textarea>
              </div>
              <div class="py-1">
                <button type="submit" class="btn btn-success"value="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
       </div>
      </section>
      <section class="py-5">
        <div class="row g-0">
          <div class="col-12">
            <table class="table table-bordered table-striped">
              <thead>
                <th>#</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created_at</th>
              </thead>
              <tbody>
                @foreach ($tickets as $key=>$ticket)
                <tr class="ticket" data-id="{{$ticket->id}}">
                  <td>{{$key+1}}</td>
                  <td>{{$ticket->subject}}</td>
                  <td>{{$ticket->desc}}</td>
                  <td>
                    @if ($ticket->status=='open')
                    <a class="text-success">Opened</a>
                    @else
                    <a class="text-danger">Closed</a>
                  @endif
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
    <script src="{{asset('files/jquery.min.js')}}"></script>
    <script src="{{asset('files/bootstrap5.3.3.min.js')}}"></script>
</body>
</html>