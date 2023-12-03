<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('partner.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.partner.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="partner.name">
        <div class="validation-message">
            {{ $errors->first('partner.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.partner.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('partner.cpf') ? 'invalid' : '' }}">
        <label class="form-label required" for="cpf">{{ trans('cruds.partner.fields.cpf') }}</label>
        <input class="form-control" type="text" name="cpf" id="cpf" required wire:model.defer="partner.cpf">
        <div class="validation-message">
            {{ $errors->first('partner.cpf') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.partner.fields.cpf_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>