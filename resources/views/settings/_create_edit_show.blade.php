<x-form-group name="username" required>
    {{ html() -> text('username') -> class('form-control')
            -> value( old('username', isset($model) ? $model->username : '') )
            -> attributeIf($action == 'show', 'disabled', 'disabled')
            -> attributeIf($action == 'edit', 'readonly', 'readonly')
            -> classIf($errors->has('username'), 'is-invalid')
    }}
</x-form-group>

<x-form-group name="family_name">
    {{ html() -> text('family_name') -> class('form-control')
            -> value( old('family_name', isset($model) ? $model->family_name : '') )
            -> attributeIf($action == 'show', 'disabled', 'disabled')
            -> classIf($errors->has('family_name'), 'is-invalid')
    }}
</x-form-group>

<x-form-group name="given_name">
    {{ html() -> text('given_name') -> class('form-control')
            -> value( old('given_name', isset($model) ? $model->given_name : '') )
            -> attributeIf($action == 'show', 'disabled', 'disabled')
            -> classIf($errors->has('given_name'), 'is-invalid')
    }}
</x-form-group>

<x-form-group name="email">
    {{ html() -> text('email') -> class('form-control')
            -> value( old('email', isset($model) ? $model->email : '') )
            -> attributeIf($action == 'show', 'disabled', 'disabled')
            -> classIf($errors->has('email'), 'is-invalid')
    }}
</x-form-group>

@if( $action != 'show' )
    <div class="row">
        <div class="col-md-6">
            <x-form-group name="password">
                {{ html() -> password('password') -> class('form-control')
                        -> attributeIf($action == 'show', 'disabled', 'disabled')
                        -> classIf($errors->has('password'), 'is-invalid')
                }}
            </x-form-group>
        </div>
        <div class="col-md-6">
            <x-form-group name="password_confirm">
                {{ html() -> password('password_confirm') -> class('form-control')
                        -> attributeIf($action == 'show', 'disabled', 'disabled')
                        -> classIf($errors->has('password_confirm'), 'is-invalid')
                }}
            </x-form-group>
        </div>
    </div>
@endif

@php
    $selectors = ( $action != 'show' ) ? true : false;
@endphp

<x-form-group name="roles" required :selectors="$selectors">
    {{ html() -> multiselect('roles', $roles, old('roles', optional($model->roles)->pluck('id')))
        -> class('form-control select2 select2able')
        -> attributeIf($action == 'show', 'disabled', 'disabled')
        -> classIf($errors->has('roles'), 'is-invalid')
    }}
</x-form-group>
