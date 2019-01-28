<nav class="nav">
    <ul class="nav__list container">
        <li class="nav__item">
            <a href="all-lots.html">Доски и лыжи</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Крепления</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Ботинки</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Одежда</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Инструменты</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Разное</a>
        </li>
    </ul>
</nav>
<?php $classname = isset($errors) ? 'form--invalid' : ''; ?>
<form class="form form--add-lot container <?=$classname; ?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <?php $classname = isset($errors['name']) ? 'form__item--invalid' : ''; ?>
        <div class="form__item <?=$classname; ?>"> <!-- form__item--invalid -->
            <?php $value = htmlspecialchars(trim($lot['name'])) ?? ''; ?>
            <label for="lot-name">Наименование</label>
            <input id="lot-name" type="text" name="name" placeholder="Введите наименование лота" value="<?=$value; ?>" required>
            <span class="form__error"><?=$errors['name'] ?? ''; ?></span>
        </div>
        <div class="form__item">
            <?php $classname = isset($errors['category']) ? 'form__item--invalid' : ''; ?>
            <label for="category">Категория</label>
            <select class="<?=$classname; ?> id="category" name="category" required>
                <option>Выберите категорию</option>
                <?php foreach ($categories as $category): ?>
                    <?php if ($category == $lot['category']): ?>
                        <option selected><?=$category; ?></option>
                        <?php continue; ?>
                    <?php endif; ?>
                    <option><?=$category; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="form__error"><?=$errors['category'] ?? ''; ?></span>
        </div>
    </div>
    <div class="form__item form__item--wide">
        <?php $classname = isset($errors['description']) ? 'form__item--invalid' : ''; ?>
        <?php $placeholder = htmlspecialchars(trim($lot['description'])) ?? ''; ?>
        <label for="message">Описание</label>
        <textarea id="message" name="description" placeholder="Напишите описание лота" required><?=$placeholder; ?></textarea>
        <span class="form__error"><?=$errors['description'] ?? ''; ?></span>
    </div>
    <?php $classname = isset($errors['url']) ? 'form__item--uploaded' : ''; ?>
    <div class="form__item form__item--file <?=$classname; ?>"> <!-- form__item--uploaded -->
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <?php $src = $lot['url'] ?? ''; ?>
                <img src="<?=$src; ?>" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="photo2" name="url">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
            <span class="form__error"><?=$errors['url'] ?? ''; ?></span>
        </div>
    </div>
    <div class="form__container-three">
        <?php $classname = isset($errors['price']) ? 'form__item--invalid' : ''; ?>
        <div class="form__item form__item--small <?=$classname; ?>">
        <?php $value = htmlspecialchars(trim($lot['price'])) ?? ''; ?>
            <label for="lot-rate">Начальная цена</label>
            <input id="lot-rate" type="number" name="price" placeholder="0" value="<?=$value; ?>" required>
            <span class="form__error"><?=$errors['price'] ?? ''; ?></span>
        </div>
        <?php $classname = isset($errors['step']) ? 'form__item--invalid' : ''; ?>
        <div class="form__item form__item--small <?=$classname; ?>">
        <?php $value = htmlspecialchars(trim($lot['step'])) ?? ''; ?>
            <label for="lot-step">Шаг ставки</label>
            <input id="lot-step" type="number" name="step" placeholder="0" value="<?=$value; ?>" required>
            <span class="form__error"><?=$errors['step'] ?? ''; ?></span>
        </div>
        <?php $classname = isset($errors['date']) ? 'form__item--invalid' : ''; ?>
        <div class="form__item <?=$classname; ?>">
        <?php $value = htmlspecialchars(trim($lot['date'])) ?? ''; ?>
            <label for="lot-date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot-date" type="date" name="date" value="<?=$value; ?>" required>
            <span class="form__error"><?=$errors['date'] ?? ''; ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>