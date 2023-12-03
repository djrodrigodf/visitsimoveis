@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.schedule.title_singular') }}:
                    {{ trans('cruds.schedule.fields.id') }}
                    {{ $schedule->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.id') }}
                            </th>
                            <td>
                                {{ $schedule->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.broker') }}
                            </th>
                            <td>
                                {{ $schedule->broker }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.boker_mail') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $schedule->boker_mail }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $schedule->boker_mail }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.buyer') }}
                            </th>
                            <td>
                                {{ $schedule->buyer }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.buyer_mail') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $schedule->buyer_mail }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $schedule->buyer_mail }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.schedule') }}
                            </th>
                            <td>
                                {{ $schedule->schedule }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.address') }}
                            </th>
                            <td>
                                {{ $schedule->address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.buyer_signature') }}
                            </th>
                            <td>
                                {{ $schedule->buyer_signature }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.broker_signature') }}
                            </th>
                            <td>
                                {{ $schedule->broker_signature }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.file') }}
                            </th>
                            <td>
                                {{ $schedule->file }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.time_stamp') }}
                            </th>
                            <td>
                                {{ $schedule->time_stamp }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.schedule.fields.partners') }}
                            </th>
                            <td>
                                @foreach($schedule->partners as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('schedule_edit')
                    <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection