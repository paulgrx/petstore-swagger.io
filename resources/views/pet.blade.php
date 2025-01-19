<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{--        <link rel="stylesheet" href="/resources/css/app.css">--}}
        @vite(['resources/css/app.css'])
        <title>Pet</title>
    </head>
    <body>
        <div class="content">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($petData as $item)
                    <tr class="table-active">
                        <td class="col-4">{{$item->pet_id}}</td>
                        <td class="col-2">{{$item->name}}</td>
                        <td class="col-2">{{$item->status}}</td>
                        <td class="col-4">
                            <a href="{{ route('pet.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('pet.delete', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this pet?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
