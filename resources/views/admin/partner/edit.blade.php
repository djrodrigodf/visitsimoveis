@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.partner.title_singular') }}:
                    {{ trans('cruds.partner.fields.id') }}
                    {{ $partner->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('partner.edit', [$partner])
        </div>
    </div>
</div>
@endsection