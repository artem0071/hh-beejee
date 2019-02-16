<form method="post" action="/tasks/{{ isset($task) ? $task->id : '' }}">

    <div class="form-group">
        <label for="name">Имя</label>
        <input id="name"
               name="name"
               value="{{ isset($task) ? $task->name : '' }}"
               type="text"
               class="form-control"
               placeholder="Введите имя .."
               required {{ isset($task) ? 'readonly' : 'false' }}>
    </div>

    <div class="form-group">
        <label for="email">Email адрес</label>
        <input id="email"
               name="email"
               value="{{ isset($task) ? $task->email : '' }}"
               type="email"
               class="form-control"
               placeholder="Введите Email .."
               required {{ isset($task) ? 'readonly' : '' }}>
    </div>

    <div class="form-group">
        <label for="text">Текст</label>
        <textarea id="text"
                  name="text"
                  class="form-control"
                  rows="3"
                  placeholder="Введите текст .."
                  required>{{ isset($task) ? $task->text : '' }}</textarea>
    </div>

    @if(isset($task))
        <div class="form-group">
            <div class="form-check">
                <input name="marked" class="form-check-input" type="checkbox" {{ $task->marked_at ? 'checked' : '' }} id="marked">
                <label class="form-check-label" for="marked">
                    Задание выполнено
                </label>
            </div>
        </div>
    @endif


    <button type="submit" class="btn btn-primary">
        {{ isset($task) ? 'Обновить' : 'Добавить' }}
    </button>
</form>