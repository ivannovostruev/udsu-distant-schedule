<label for="commentary" class="form-label">Ваш комментарий</label>
<textarea name="commentary"
          id="commentary"
          rows="5"
          class="form-control">{{ old('commentary', $commentary) }}</textarea>
<div id="commentary-help"
     class="form-text">Информация, которую на Ваш взгляд полезно сообщить администраторам</div>
