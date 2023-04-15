<label for="role-id" class="form-label">Роль</label>
<select name="role_id"
        id="role-id"
        class="form-select">
    <option value="no">Нет роли</option>
    @foreach($roles as $role)
        @php /** @var \App\Models\Role $role */ @endphp
        <option value="{{ $role->id }}"
                @if(old('role_id', $roleId) == $role->id) selected @endif>
            {{ $role->name }}
        </option>
    @endforeach
</select>
