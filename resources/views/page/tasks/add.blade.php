<form method="post" action="/tasks">
    <div class="form-group">
        <label for="name">Имя</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Введите имя .." required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Введите Email .." required>
    </div>
    <div class="form-group">
        <label for="text">Текст</label>
        <textarea name="text" class="form-control" id="text" rows="3" placeholder="Введите текст .." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>