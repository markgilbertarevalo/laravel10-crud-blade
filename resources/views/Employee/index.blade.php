<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
 
<div class="container mt-2">
 
    <div class="row">
        
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD</h2>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="pull-right mb-2">
                <a class="btn btn-primary" href="{{ route('employee.create') }}"> Create Employee</a>
            </div>
        </div>
    </div> 
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($employees as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->first_name }}</td>
            <td>{{ $employee->last_name }}</td>
            <td>{{ $employee->position }}</td>
            <td>
                <form action="{{ route('employee.destroy', $employee->id) }}" method="Post">
     
                    <a class="btn btn-warning" href="{{ route('employee.edit', $employee->id) }}">Edit</a>
    
                    @csrf
                    @method('DELETE')
       
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Employee?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
   
    {{ $employees->links('pagination::bootstrap-5') }}
 
</body>
</html>