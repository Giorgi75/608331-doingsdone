<div class="modal">
  <button class="modal__close" type="button" name="button">Закрыть</button>

  <h2 class="modal__heading">Вход на сайт</h2>

  <form class="form" action="login.php" method="post">
    <div class="form__row">
      <label class="form__label" for="email">E-mail <sup>*</sup></label>

      <input class="form__input<?= (isset($errors['email'])) ? ' form__input--error' : ''; ?>" type="text" name="email" id="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" placeholder="Введите e-mail">

      <?php if (isset($errors['email'])): ?>
        <p class="form__message"><?= $errors['email']; ?></p>
      <?php endif; ?>
    </div>

    <div class="form__row">
      <label class="form__label" for="password">Пароль <sup>*</sup></label>

      <input class="form__input<?= (isset($errors['password'])) ? ' form__input--error' : ''; ?>" type="password" name="password" id="password" value="" placeholder="Введите пароль">

      <?php if (isset($errors['password'])): ?>
        <p class="form__message"><?= $errors['password']; ?></p>
      <?php endif; ?>
    </div>

    <div class="form__row form__row--controls">
      <input class="button" type="submit" name="" value="Войти">
    </div>
  </form>
</div>
