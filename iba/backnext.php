<div class="back_next_container">
    <input type="submit" name="next" value="次へ" class="next_button"/>
    <?php if($_SESSION['went_to_confirmation']):?>
    <input type="submit" name="back" value="戻る" class="back_button"/>
    <?php endif ;?>
</div>