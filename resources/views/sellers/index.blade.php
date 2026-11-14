@extends('sellers.layout')
     
@section('content')
<div class="card mt-5">
  <h2 class="card-header">Laravel 12 CRUD with Image Upload Tutorial - ItSolutionStuff.com</h2>
  <div class="card-body">
          
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
  
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('sellers.create') }}"> <i class="fa fa-plus"></i> Create New seller</a>
        </div>
  
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Shop name</th>
                    <th>Shop location</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($sellers as $seller)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $seller->user->name }}</td>
                    <td>{{ $seller->user->email }}</td>
                    <td>{{ $seller->name }}</td>
                    <td>{{ $seller->location }}</td>
                    <td>
                        <form action="{{ route('sellers.destroy',$seller->id) }}" method="POST">
             
                            <a class="btn btn-info btn-sm" href="{{ route('sellers.show',$seller->id) }}"><i class="fa-solid fa-list"></i> Show</a>
              
                            <a class="btn btn-primary btn-sm" href="{{ route('sellers.edit',$seller->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
             
                            @csrf
                            @method('DELETE')
                
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">There are no data.</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
        
        {!! $sellers->withQueryString()->links('pagination::bootstrap-5') !!}
  
  </div>
</div>      
@endsection