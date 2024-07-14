<?php



/* @var $this \yii\web\View */
/* @var $selfId  */

?>

<div class="answer" id="answer">
    <textarea class="disagree__text" name="text" id="comment_text" cols="30" rows="1" placeholder="Напишите комментарий"></textarea>

    <div class="comments__img-miniatures" id="file_list" data-userid="<?=$self->id?>" style="display: block"></div>

    <div class="disagree__button">
        <button class="disagree__btn btn__shadow" id="send_comment">Отправить</button>
    </div>

    <input name="file" type="file" id="files_input" class="field field__file" multiple accept="image/jpeg,image/png">
    <label class="comments__img-wrapper" for="files_input">
        <img class="comments__img-button" src="/img/papel-logo.png" alt="attach" width="15">
    </label>
</div>
