<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">
                <a href="/?page={{ $meta['current_page'] }}&orderBy=id&direction={{ $meta['orderBy'] == 'id' ? $meta['direction'] ==  'asc' ? 'desc' : 'asc' : 'asc' }}" style="color: white">#</a>
            </th>
            <th scope="col">
                <a href="/?page={{ $meta['current_page'] }}&orderBy=name&direction={{ $meta['orderBy'] == 'name' ? $meta['direction'] ==  'asc' ? 'desc' : 'asc' : 'asc' }}" style="color: white">Имя</a>
            </th>
            <th scope="col">
                <a href="/?page={{ $meta['current_page'] }}&orderBy=email&direction={{ $meta['orderBy'] == 'email' ? $meta['direction'] ==  'asc' ? 'desc' : 'asc' : 'asc' }}" style="color: white">Email</a>
            </th>
            <th scope="col">
                Текст
            </th>
            <th scope="col">
                Marked
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <th scope="row">
                    <a href="/tasks/{{ $task->id }}">
                        {{ $task->id }}
                    </a>
                </th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->email }}</td>
                <td>{{ $task->text }}</td>
                <td>{{ $task->marked_at ? DateTime::createFromFormat('Y-m-d H:i:s', $task->marked_at)->format('d.m H:i') : '' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>