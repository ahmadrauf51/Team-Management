<!DOCTYPE html>
<html>
<head>
    <title>Task Schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Task Allocations</h1>

        <h2>Tasks</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Duration (hours)</th>
                    <th>Difficulty</th>
                    <th>Developers</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->duration }}</td>
                        <td>{{ $task->difficulty }}</td>
                        <td>
                            @foreach($task->developers as $developer)
                                {{ $developer->name }} ({{ $developer->pivot->hours }} hours)<br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Developers</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Developer Name</th>
                    <th>Capacity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($developers as $developer)
                    <tr>
                        <td>{{ $developer->name }}</td>
                        <td>{{ $developer->capacity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
