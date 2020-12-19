<form action="/comment/add/<?=$article->id?>" method="post" id="comment-form">
    <textarea name="comment" placeholder="Ваш комментарий" class="materialize-textarea validate <?= isset($errors['comment']) ? 'invalid' : '' ?>" ></textarea>
    <?php !empty($errors['comment']) ? printInputErrors($errors['comment']) : ''?>
    <button type="submit" class="btn waves-effect waves-light white-text">Комментировать</button>
</form>