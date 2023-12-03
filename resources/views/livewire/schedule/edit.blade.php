<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('schedule.broker') ? 'invalid' : '' }}">
        <label class="form-label required" for="broker">{{ trans('cruds.schedule.fields.broker') }}</label>
        <input class="form-control" type="text" name="broker" id="broker" required wire:model.defer="schedule.broker">
        <div class="validation-message">
            {{ $errors->first('schedule.broker') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.broker_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('schedule.boker_mail') ? 'invalid' : '' }}">
        <label class="form-label required" for="boker_mail">{{ trans('cruds.schedule.fields.boker_mail') }}</label>
        <input class="form-control" type="email" name="boker_mail" id="boker_mail" required wire:model.defer="schedule.boker_mail">
        <div class="validation-message">
            {{ $errors->first('schedule.boker_mail') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.boker_mail_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('schedule.buyer') ? 'invalid' : '' }}">
        <label class="form-label required" for="buyer">{{ trans('cruds.schedule.fields.buyer') }}</label>
        <input class="form-control" type="text" name="buyer" id="buyer" required wire:model.defer="schedule.buyer">
        <div class="validation-message">
            {{ $errors->first('schedule.buyer') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.buyer_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('schedule.buyer_mail') ? 'invalid' : '' }}">
        <label class="form-label required" for="buyer_mail">{{ trans('cruds.schedule.fields.buyer_mail') }}</label>
        <input class="form-control" type="email" name="buyer_mail" id="buyer_mail" required wire:model.defer="schedule.buyer_mail">
        <div class="validation-message">
            {{ $errors->first('schedule.buyer_mail') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.buyer_mail_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('schedule.schedule') ? 'invalid' : '' }}">
        <label class="form-label required" for="schedule">{{ trans('cruds.schedule.fields.schedule') }}</label>
        <x-date-picker class="form-control" required wire:model="schedule.schedule" id="schedule" name="schedule" />
        <div class="validation-message">
            {{ $errors->first('schedule.schedule') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.schedule_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('schedule.address') ? 'invalid' : '' }}">
        <label class="form-label required" for="address">{{ trans('cruds.schedule.fields.address') }}</label>
        <input class="form-control" type="text" name="address" id="address" required wire:model.defer="schedule.address">
        <div class="validation-message">
            {{ $errors->first('schedule.address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.address_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('schedule.buyer_signature') ? 'invalid' : '' }}">
        <label class="form-label" for="buyer_signature">{{ trans('cruds.schedule.fields.buyer_signature') }}</label>
        <input class="form-control" type="text" name="buyer_signature" id="buyer_signature" wire:model.defer="schedule.buyer_signature">
        <div class="validation-message">
            {{ $errors->first('schedule.buyer_signature') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.buyer_signature_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('schedule.broker_signature') ? 'invalid' : '' }}">
        <label class="form-label" for="broker_signature">{{ trans('cruds.schedule.fields.broker_signature') }}</label>
        <input class="form-control" type="text" name="broker_signature" id="broker_signature" wire:model.defer="schedule.broker_signature">
        <div class="validation-message">
            {{ $errors->first('schedule.broker_signature') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.broker_signature_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('schedule.file') ? 'invalid' : '' }}">
        <label class="form-label" for="file">{{ trans('cruds.schedule.fields.file') }}</label>
        <input class="form-control" type="text" name="file" id="file" wire:model.defer="schedule.file">
        <div class="validation-message">
            {{ $errors->first('schedule.file') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.file_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('schedule.time_stamp') ? 'invalid' : '' }}">
        <label class="form-label" for="time_stamp">{{ trans('cruds.schedule.fields.time_stamp') }}</label>
        <textarea class="form-control" name="time_stamp" id="time_stamp" wire:model.defer="schedule.time_stamp" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('schedule.time_stamp') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.time_stamp_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('partners') ? 'invalid' : '' }}">
        <label class="form-label" for="partners">{{ trans('cruds.schedule.fields.partners') }}</label>
        <x-select-list class="form-control" id="partners" name="partners" wire:model="partners" :options="$this->listsForFields['partners']" multiple />
        <div class="validation-message">
            {{ $errors->first('partners') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.schedule.fields.partners_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>